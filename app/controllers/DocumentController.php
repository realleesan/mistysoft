<?php
declare(strict_types=1);

// Force deploy sync
class DocumentController extends Controller
{
  private const DOCS = [
    'proposal' => 'PROPOSAL_LMS_KOREAN_MS_B_2026_V1.0.pdf',
    'srs' => 'SRS_LMS_KOREAN_MS_B_2026_V6.0.pdf',
    'qna' => 'QNA_LMS_KOREAN_MS_B_2026_V5.0.pdf',
    'ats' => 'ATS_LMS_KOREAN_MS_B_2026_V6.0.pdf',
    'payment' => 'PAYMENT_LMS_KOREAN_MS_B_2026_V2.0.pdf',
    'contract' => 'CONTRACT_LMS_KOREAN_MS_B_2026_V6.0.pdf',
    'config' => 'CONFIG_LMS_KOREAN_MS_B_2026_V1.0.pdf',
    'email' => 'EMAIL_LMS_KOREAN_MS_B_2026_V1.3.pdf',
    'cr-01' => 'CR-01_LMS_KOREAN_MS_B_2026_V1.0.pdf',
  ];

  private function getBlockedDevicesPath(): string
  {
    return STORAGE_PATH . '/logs/blocked_devices.json';
  }

  private function isBlocked(): bool
  {
    $ip = $this->getClientIp();
    $path = $this->getBlockedDevicesPath();
    if (!file_exists($path)) {
      return false;
    }
    $blocked = json_decode(file_get_contents($path), true) ?: [];
    if (isset($blocked[$ip])) {
      $info = $blocked[$ip];
      if (isset($info['blocked_until']) && $info['blocked_until'] > time()) {
        return true;
      }
    }
    return false;
  }

  private function getBlockRemainingTime(): int
  {
    $ip = $this->getClientIp();
    $path = $this->getBlockedDevicesPath();
    if (!file_exists($path)) {
      return 0;
    }
    $blocked = json_decode(file_get_contents($path), true) ?: [];
    if (isset($blocked[$ip])) {
      $info = $blocked[$ip];
      if (isset($info['blocked_until'])) {
        $remaining = $info['blocked_until'] - time();
        return $remaining > 0 ? $remaining : 0;
      }
    }
    return 0;
  }

  public function index(): void
  {
    if ($this->isBlocked()) {
      $remaining = $this->getBlockRemainingTime();
      $this->view('document/blocked', [
        'title' => 'Truy cập bị hạn chế - MistySoft',
        'remaining' => $remaining,
        'ip' => $this->getClientIp()
      ], null);
      return;
    }

    $this->view('document/index', [
      'title' => 'Tài liệu dự án - MistySoft',
      'ip' => $this->getClientIp()
    ], null);
  }

  public function stream(): void
  {
    if ($this->isBlocked()) {
      http_response_code(403);
      echo 'Access Denied: Screen capture violation active.';
      exit;
    }

    $docKey = $_GET['doc'] ?? '';
    if (!array_key_exists($docKey, self::DOCS)) {
      http_response_code(404);
      echo 'Document not found.';
      exit;
    }

    $fileName = self::DOCS[$docKey];
    $filePath = APP_PATH . '/views/document/' . $fileName;

    if (!file_exists($filePath)) {
      http_response_code(404);
      echo 'Document file not found.';
      exit;
    }

    // Stream the file with security headers
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . $fileName . '"');
    header('Content-Length: ' . filesize($filePath));
    header('Cache-Control: private, no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    // Prevent iframe embedding elsewhere (optional security measure, standard is DENY or SAMEORIGIN)
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');

    readfile($filePath);
    exit;
  }

  public function reportViolation(): void
  {
    $ip = $this->getClientIp();
    $path = $this->getBlockedDevicesPath();
    $dir = dirname($path);
    if (!is_dir($dir)) {
      @mkdir($dir, 0755, true);
    }

    $blocked = [];
    if (file_exists($path)) {
      $blocked = json_decode(file_get_contents($path), true) ?: [];
    }

    $now = time();
    if (!isset($blocked[$ip])) {
      $blocked[$ip] = [
        'violations' => 0,
        'last_violation_time' => $now,
        'blocked_until' => 0
      ];
    }

    // Reset violations if the last violation was more than 2 hours ago
    if ($now - $blocked[$ip]['last_violation_time'] > 7200) {
      $blocked[$ip]['violations'] = 0;
    }

    $blocked[$ip]['violations'] += 1;
    $blocked[$ip]['last_violation_time'] = $now;

    $isBlocked = false;
    if ($blocked[$ip]['violations'] >= 5) {
      $blocked[$ip]['blocked_until'] = $now + 1800; // 30 minutes block
      $isBlocked = true;
    }

    file_put_contents($path, json_encode($blocked, JSON_PRETTY_PRINT));

    // Also clear session just to make it harder
    if ($isBlocked) {
      $_SESSION['blocked_until'] = $blocked[$ip]['blocked_until'];
    }

    json_response([
      'success' => true,
      'violations' => $blocked[$ip]['violations'],
      'blocked' => $isBlocked,
      'blocked_until' => $blocked[$ip]['blocked_until'],
      'remaining' => $isBlocked ? 1800 : 0
    ]);
  }
}

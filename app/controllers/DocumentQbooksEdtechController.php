<?php
declare(strict_types=1);

class DocumentQbooksEdtechController extends Controller
{
  private const DOCS = [
    'qna' => 'QNA_LMS_QBOOKS_MS_B_2026_V1.0 .pdf',
  ];

  private function getBlockedDevicesPath(): string
  {
    return STORAGE_PATH . '/logs/blocked_devices_qbooks_edtech.json';
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
      $this->view('document-qbooks-edtech/blocked', [
        'title' => 'Truy cập bị hạn chế - MistySoft',
        'remaining' => $remaining,
        'ip' => $this->getClientIp()
      ], null);
      return;
    }

    $this->view('document-qbooks-edtech/index', [
      'title' => 'Tài liệu dự án QBooks EdTech - MistySoft',
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
    $filePath = APP_PATH . '/views/document-qbooks-edtech/' . $fileName;

    if (!file_exists($filePath)) {
      http_response_code(404);
      echo 'Document file not found.';
      exit;
    }

    // Clear any active output buffers to prevent memory issues or headers mismatch
    while (ob_get_level() > 0) {
      ob_end_clean();
    }

    $content = @file_get_contents($filePath);
    if ($content === false) {
      http_response_code(500);
      echo 'Failed to read document file.';
      exit;
    }

    $base64 = base64_encode($content);

    // Stream the base64 content as plain text to bypass InfinityFree security blocks on PDF binaries
    header('Content-Type: text/plain; charset=utf-8');
    header('Cache-Control: private, no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    header('Expires: 0');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');

    echo $base64;
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

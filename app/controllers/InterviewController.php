<?php
declare(strict_types=1);

class InterviewController extends Controller
{
  private function getBlockedDevicesPath(): string
  {
    return STORAGE_PATH . '/logs/blocked_interview_devices.json';
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
      $this->view('interview/blocked', [
        'title' => 'Truy cập bị hạn chế - Phỏng vấn logic',
        'remaining' => $remaining,
        'ip' => $this->getClientIp()
      ], null);
      return;
    }

    if (empty($_SESSION['interview_session'])) {
      $this->view('interview/enter', [
        'title' => 'Nhập mã truy cập phỏng vấn - MistySoft',
        'ip' => $this->getClientIp()
      ], null);
      return;
    }

    $session = $_SESSION['interview_session'];
    $remainingTime = $session['end_time'] - time();

    if ($remainingTime <= 0) {
      // Session has expired, clear and notify
      unset($_SESSION['interview_session']);
      flash('error', 'Thời gian làm bài phỏng vấn đã hết (10 phút).');
      $this->redirect('/interview');
      return;
    }

    $this->view('interview/workspace', [
      'title' => 'Trang phỏng vấn logic - MistySoft',
      'session' => $session,
      'remaining_time' => $remainingTime,
      'ip' => $this->getClientIp()
    ], null);
  }

  public function enter(): void
  {
    if ($this->isBlocked()) {
      $this->redirect('/interview');
      return;
    }

    $tenantId = trim($_POST['tenant_id'] ?? '');
    if ($tenantId === '') {
      flash('error', 'Vui lòng nhập mã truy cập.');
      $this->redirect('/interview');
      return;
    }

    // Load tenants
    $tenantsPath = STORAGE_PATH . '/data/interview_tenants.json';
    if (!file_exists($tenantsPath)) {
      flash('error', 'Hệ thống phỏng vấn chưa được cấu hình.');
      $this->redirect('/interview');
      return;
    }

    $tenants = json_decode(file_get_contents($tenantsPath), true) ?: [];
    $foundIndex = -1;
    foreach ($tenants as $index => $t) {
      if ($t['tenant_id'] === $tenantId) {
        $foundIndex = $index;
        break;
      }
    }

    if ($foundIndex === -1) {
      flash('error', 'Mã truy cập không hợp lệ.');
      $this->redirect('/interview');
      return;
    }

    $tenant = $tenants[$foundIndex];
    if ($tenant['is_used']) {
      flash('error', 'Mã truy cập này đã được sử dụng trước đó.');
      $this->redirect('/interview');
      return;
    }

    // Mark as used immediately
    $tenants[$foundIndex]['is_used'] = true;
    $tenants[$foundIndex]['used_at'] = time();
    file_put_contents($tenantsPath, json_encode($tenants, JSON_PRETTY_PRINT));

    // Load questions
    $questionsPath = STORAGE_PATH . '/data/interview_questions.json';
    $questions = file_exists($questionsPath) ? (json_decode(file_get_contents($questionsPath), true) ?: []) : [];
    
    $question = null;
    foreach ($questions as $q) {
      if ($q['id'] === $tenant['question_id']) {
        $question = $q;
        break;
      }
    }

    if (!$question) {
      flash('error', 'Không tìm thấy câu hỏi tương ứng với mã truy cập này.');
      $this->redirect('/interview');
      return;
    }

    // Initialize session
    $_SESSION['interview_session'] = [
      'tenant_id' => $tenantId,
      'question_id' => $question['id'],
      'title' => $question['title'],
      'description' => $question['description'],
      'start_time' => time(),
      'end_time' => time() + 600 // 10 minutes
    ];

    $this->redirect('/interview');
  }

  public function submit(): void
  {
    if ($this->isBlocked()) {
      $this->redirect('/interview');
      return;
    }

    if (empty($_SESSION['interview_session'])) {
      $this->redirect('/interview');
      return;
    }

    $session = $_SESSION['interview_session'];
    $answer = trim($_POST['answer'] ?? '');
    
    if ($answer === '') {
      flash('error', 'Nội dung trả lời không được để trống.');
      $this->redirect('/interview');
      return;
    }

    // Calculate time spent
    $timeSpent = time() - $session['start_time'];
    $minutes = (int)floor($timeSpent / 60);
    $seconds = $timeSpent % 60;
    $timeSpentText = "{$minutes} phút {$seconds} giây";

    // Always save submission to JSON file first (reliable on shared hosting)
    $submissionsPath = STORAGE_PATH . '/data/interview_submissions.json';
    $submissions = file_exists($submissionsPath) ? (json_decode(file_get_contents($submissionsPath), true) ?: []) : [];

    $submission = [
      'tenant_id' => $session['tenant_id'],
      'question_id' => $session['question_id'],
      'question_title' => $session['title'],
      'ip' => $this->getClientIp(),
      'time_spent' => $timeSpentText,
      'submitted_at' => date('Y-m-d H:i:s'),
      'answer' => $answer
    ];

    $submissions[] = $submission;
    file_put_contents($submissionsPath, json_encode($submissions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Attempt Zalo delivery (optional — may not work on shared hosting)
    $zaloSent = false;
    if (function_exists('shell_exec')) {
      $message = "========================================\n";
      $message .= "KẾT QUẢ PHỎNG VẤN TƯ DUY LOGIC CANDIDATE\n";
      $message .= "========================================\n";
      $message .= "Mã truy cập (Tenant ID): " . $session['tenant_id'] . "\n";
      $message .= "IP Người làm bài: " . $this->getClientIp() . "\n";
      $message .= "Mã câu hỏi: " . $session['question_id'] . "\n";
      $message .= "Đề bài: " . $session['title'] . "\n";
      $message .= "Thời gian làm bài: " . $timeSpentText . "\n";
      $message .= "Thời điểm nộp: " . date('Y-m-d H:i:s') . "\n";
      $message .= "----------------------------------------\n";
      $message .= "NỘI DUNG BÀI LÀM:\n\n";
      $message .= $answer . "\n";
      $message .= "========================================";

      $nodeScript = BASE_PATH . '/modules/zalo_send.mjs';
      $command = "node " . escapeshellarg($nodeScript) . " " . escapeshellarg($message);
      
      $output = @shell_exec($command);
      $response = json_decode($output ?? '', true);
      $zaloSent = ($response && isset($response['success']) && $response['success'] === true);

      if (!$zaloSent) {
        $errorMsg = $response['error'] ?? ($output ?? 'shell_exec returned null');
        $logDir = STORAGE_PATH . '/logs';
        @file_put_contents($logDir . '/zalo_errors.log', date('c') . " - Send failed: " . $errorMsg . "\n\n", FILE_APPEND);
      }
    }

    // Clear session
    unset($_SESSION['interview_session']);

    $this->view('interview/success', [
      'title' => 'Nộp bài thành công - MistySoft',
      'message' => 'Bài làm của bạn đã được ghi nhận thành công. Cảm ơn bạn đã tham gia phỏng vấn.'
    ], null);
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
    if ($blocked[$ip]['violations'] >= 3) {
      $blocked[$ip]['blocked_until'] = $now + 1800; // 30 minutes block
      $isBlocked = true;
      // Clear session when blocked
      unset($_SESSION['interview_session']);
    }

    file_put_contents($path, json_encode($blocked, JSON_PRETTY_PRINT));

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

  public function admin(): void
  {
    $questionsPath = STORAGE_PATH . '/data/interview_questions.json';
    $questions = file_exists($questionsPath) ? (json_decode(file_get_contents($questionsPath), true) ?: []) : [];

    $tenantsPath = STORAGE_PATH . '/data/interview_tenants.json';
    $tenants = file_exists($tenantsPath) ? (json_decode(file_get_contents($tenantsPath), true) ?: []) : [];

    // Load submissions for review
    $submissionsPath = STORAGE_PATH . '/data/interview_submissions.json';
    $submissions = file_exists($submissionsPath) ? (json_decode(file_get_contents($submissionsPath), true) ?: []) : [];

    $this->view('interview/admin', [
      'title' => 'Quản trị phòng phỏng vấn - MistySoft',
      'questions' => $questions,
      'tenants' => $tenants,
      'submissions' => $submissions
    ], null);
  }

  public function createQuestion(): void
  {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($title === '' || $description === '') {
      flash('error', 'Tiêu đề và nội dung đề bài không được để trống.');
      $this->redirect('/interview/admin');
      return;
    }

    // Generate unique question ID
    $id = 'q_' . substr(md5(uniqid((string)mt_rand(), true)), 0, 8);

    $questionsPath = STORAGE_PATH . '/data/interview_questions.json';
    $questions = file_exists($questionsPath) ? (json_decode(file_get_contents($questionsPath), true) ?: []) : [];

    $questions[] = [
      'id' => $id,
      'title' => $title,
      'description' => $description
    ];

    file_put_contents($questionsPath, json_encode($questions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    flash('success', 'Đã tạo đề bài mới: ' . $title);
    $this->redirect('/interview/admin');
  }

  public function deleteQuestion(): void
  {
    $questionId = trim($_POST['question_id'] ?? '');
    if ($questionId === '') {
      flash('error', 'Thiếu thông tin câu hỏi cần xoá.');
      $this->redirect('/interview/admin');
      return;
    }

    $questionsPath = STORAGE_PATH . '/data/interview_questions.json';
    $questions = file_exists($questionsPath) ? (json_decode(file_get_contents($questionsPath), true) ?: []) : [];

    $questions = array_values(array_filter($questions, fn($q) => $q['id'] !== $questionId));
    file_put_contents($questionsPath, json_encode($questions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Also remove related tenants
    $tenantsPath = STORAGE_PATH . '/data/interview_tenants.json';
    $tenants = file_exists($tenantsPath) ? (json_decode(file_get_contents($tenantsPath), true) ?: []) : [];
    $tenants = array_values(array_filter($tenants, fn($t) => $t['question_id'] !== $questionId));
    file_put_contents($tenantsPath, json_encode($tenants, JSON_PRETTY_PRINT));

    flash('success', 'Đã xoá đề bài và các mã truy cập liên quan.');
    $this->redirect('/interview/admin');
  }

  public function updateQuestion(): void
  {
    $questionId = trim($_POST['question_id'] ?? '');
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($questionId === '' || $title === '' || $description === '') {
      flash('error', 'Thiếu thông tin cần cập nhật.');
      $this->redirect('/interview/admin');
      return;
    }

    $questionsPath = STORAGE_PATH . '/data/interview_questions.json';
    $questions = file_exists($questionsPath) ? (json_decode(file_get_contents($questionsPath), true) ?: []) : [];

    $found = false;
    foreach ($questions as &$q) {
      if ($q['id'] === $questionId) {
        $q['title'] = $title;
        $q['description'] = $description;
        $found = true;
        break;
      }
    }

    if (!$found) {
      flash('error', 'Không tìm thấy đề bài cần cập nhật.');
      $this->redirect('/interview/admin');
      return;
    }

    file_put_contents($questionsPath, json_encode($questions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    flash('success', 'Đã cập nhật đề bài: ' . $title);
    $this->redirect('/interview/admin');
  }

  public function generateTenantId(): void
  {
    $questionId = trim($_POST['question_id'] ?? '');
    $quantity = max(1, min(50, (int)($_POST['quantity'] ?? 1)));

    if ($questionId === '') {
      flash('error', 'Vui lòng chọn một câu hỏi.');
      $this->redirect('/interview/admin');
      return;
    }

    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $tenantsPath = STORAGE_PATH . '/data/interview_tenants.json';
    $tenants = file_exists($tenantsPath) ? (json_decode(file_get_contents($tenantsPath), true) ?: []) : [];

    $newIds = [];
    for ($n = 0; $n < $quantity; $n++) {
      $tenantId = 'tnt_';
      for ($i = 0; $i < 12; $i++) {
        $tenantId .= $chars[rand(0, strlen($chars) - 1)];
      }

      $tenants[] = [
        'tenant_id' => $tenantId,
        'question_id' => $questionId,
        'is_used' => false,
        'created_at' => time(),
        'used_at' => null
      ];
      $newIds[] = $tenantId;
    }

    file_put_contents($tenantsPath, json_encode($tenants, JSON_PRETTY_PRINT));
    flash('success', 'Đã tạo ' . $quantity . ' mã truy cập mới cho đề bài này.');
    $this->redirect('/interview/admin');
  }

  public function deleteTenantId(): void
  {
    $tenantId = trim($_POST['tenant_id'] ?? '');
    if ($tenantId === '') {
      flash('error', 'Thiếu thông tin mã truy cập cần xoá.');
      $this->redirect('/interview/admin');
      return;
    }

    $tenantsPath = STORAGE_PATH . '/data/interview_tenants.json';
    $tenants = file_exists($tenantsPath) ? (json_decode(file_get_contents($tenantsPath), true) ?: []) : [];
    $tenants = array_values(array_filter($tenants, fn($t) => $t['tenant_id'] !== $tenantId));
    file_put_contents($tenantsPath, json_encode($tenants, JSON_PRETTY_PRINT));

    flash('success', 'Đã xoá mã truy cập: ' . $tenantId);
    $this->redirect('/interview/admin');
  }
}

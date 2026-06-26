<?php
declare(strict_types=1);

class ContactController extends Controller
{
  public function store(): void
  {
    $this->handleSubmit(false);
  }

  public function apiStore(): void
  {
    header('Access-Control-Allow-Origin: *');
    $this->handleSubmit(true);
  }

  private function handleSubmit(bool $isApi): void
  {
    if (!$this->checkRateLimit()) {
      $message = 'Vui lòng đợi 60 giây trước khi gửi lại.';
      if ($isApi) {
        json_response(['success' => false, 'message' => $message], 429);
      }
      flash('error', $message);
      $this->redirect('/#contact');
    }

    if (!verify_csrf($_POST['csrf_token'] ?? '')) {
      $message = 'Phiên làm việc không hợp lệ. Vui lòng thử lại.';
      if ($isApi) {
        json_response(['success' => false, 'message' => $message], 403);
      }
      flash('error', $message);
      $this->redirect('/#contact');
    }

    $data = $this->validate($_POST, $_FILES);

    if (isset($data['errors'])) {
      if ($isApi) {
        json_response(['success' => false, 'message' => 'Validation failed', 'errors' => $data['errors']], 422);
      }
      flash('error', implode(' ', $data['errors']));
      $this->redirect('/#contact');
    }

    $data['source'] = $this->getSource();
    $data['ip_address'] = $this->getClientIp();

    try {
      Contact::create($data);
      MailService::sendNotification($data);
      $_SESSION['last_contact_submit'] = time();

      if ($isApi) {
        json_response(['success' => true, 'message' => 'Gửi liên hệ thành công!']);
      }

      flash('success', 'Cảm ơn bạn! Chúng tôi sẽ liên hệ sớm nhất.');
      $this->redirect('/#contact');
    } catch (Throwable $e) {
      $logFile = STORAGE_PATH . '/logs/app.log';
      @file_put_contents($logFile, date('Y-m-d H:i:s') . ' - ' . $e->getMessage() . PHP_EOL, FILE_APPEND);

      $message = 'Có lỗi xảy ra. Vui lòng thử lại hoặc liên hệ qua Messenger/Zalo.';
      if ($isApi) {
        json_response(['success' => false, 'message' => $message], 500);
      }
      flash('error', $message);
      $this->redirect('/#contact');
    }
  }

  private function validate(array $input, array $files = []): array
  {
    $errors = [];
    $name = trim($input['name'] ?? '');
    $phone = trim($input['phone'] ?? '');
    $email = trim($input['email'] ?? '');
    $package = trim($input['package'] ?? '');
    $hosting = trim($input['hosting'] ?? '');
    $websiteType = trim($input['website_type'] ?? '');
    $websiteTypeOther = trim($input['website_type_other'] ?? '');
    $industry = trim($input['industry'] ?? '');
    $industryOther = trim($input['industry_other'] ?? '');
    $purpose = trim($input['purpose'] ?? '');
    $purposeOther = trim($input['purpose_other'] ?? '');
    $message = trim($input['message'] ?? '');

    if ($name === '' || mb_strlen($name) < 2) {
      $errors[] = 'Vui lòng nhập họ tên (ít nhất 2 ký tự).';
    }

    if ($phone === '' || !preg_match('/^[0-9+\-\s]{8,15}$/', $phone)) {
      $errors[] = 'Vui lòng nhập số điện thoại hợp lệ.';
    }

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Email không hợp lệ.';
    }

    if ($package === '') {
      $errors[] = 'Vui lòng chọn gói dịch vụ.';
    }

    if ($hosting === '') {
      $errors[] = 'Vui lòng chọn tình trạng miền và hosting.';
    }

    if ($websiteType === '') {
      $errors[] = 'Vui lòng chọn loại website.';
    }

    if ($websiteType === 'other' && $websiteTypeOther === '') {
      $errors[] = 'Vui lòng cụ thể loại website.';
    }

    if ($industry === '') {
      $errors[] = 'Vui lòng chọn lĩnh vực hoạt động.';
    }

    if ($industry === 'other' && $industryOther === '') {
      $errors[] = 'Vui lòng cụ thể lĩnh vực.';
    }

    if ($purpose === '') {
      $errors[] = 'Vui lòng chọn mục đích website.';
    }

    if ($purpose === 'other' && $purposeOther === '') {
      $errors[] = 'Vui lòng cụ thể mục đích.';
    }

    // Handle file upload
    $attachmentPath = null;
    if (isset($files['attachment']) && $files['attachment']['error'] === UPLOAD_ERR_OK) {
      $file = $files['attachment'];
      $allowedTypes = ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf', 'text/markdown', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
      $allowedExtensions = ['docx', 'pdf', 'md', 'xlsx'];
      $maxSize = 10 * 1024 * 1024; // 10MB

      $fileInfo = pathinfo($file['name']);
      $extension = strtolower($fileInfo['extension'] ?? '');

      if ($file['size'] > $maxSize) {
        $errors[] = 'File tải lên không được vượt quá 10MB.';
      }

      if (!in_array($extension, $allowedExtensions)) {
        $errors[] = 'Chỉ chấp nhận file: .docx, .pdf, .md, .xlsx';
      }

      if (empty($errors)) {
        $uploadDir = STORAGE_PATH . '/uploads/contacts/';
        if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0755, true);
        }

        $fileName = uniqid('contact_', true) . '.' . $extension;
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $filePath)) {
          $attachmentPath = 'storage/uploads/contacts/' . $fileName;
        } else {
          $errors[] = 'Không thể tải file lên. Vui lòng thử lại.';
        }
      }
    }

    if (!empty($errors)) {
      return ['errors' => $errors];
    }

    return [
      'name' => $name,
      'phone' => $phone,
      'email' => $email ?: null,
      'package' => $package,
      'hosting' => $hosting,
      'website_type' => $websiteType,
      'website_type_other' => $websiteType === 'other' ? $websiteTypeOther : null,
      'industry' => $industry,
      'industry_other' => $industry === 'other' ? $industryOther : null,
      'purpose' => $purpose,
      'purpose_other' => $purpose === 'other' ? $purposeOther : null,
      'message' => $message ?: null,
      'attachment_path' => $attachmentPath,
    ];
  }

  private function checkRateLimit(): bool
  {
    $lastSubmit = $_SESSION['last_contact_submit'] ?? 0;
    return (time() - $lastSubmit) >= 60;
  }
}

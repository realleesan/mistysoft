<?php
declare(strict_types=1);

class MailService
{
  public static function sendNotification(array $data): bool
  {
    $config = config('mail');
    $to = $config['to_email'];
    $subject = '[MistySoft] Liên hệ mới từ ' . $data['name'];

    $body = "Bạn có liên hệ mới từ website MistySoft:\n\n";
    $body .= "Họ tên: {$data['name']}\n";
    $body .= "SĐT: " . ($data['phone'] ?? 'N/A') . "\n";
    $body .= "Email: " . ($data['email'] ?? 'N/A') . "\n";
    $body .= "Nguồn: " . ($data['source'] ?? 'landing') . "\n";
    $body .= "Nội dung:\n" . ($data['message'] ?? '') . "\n";

    if (!empty($config['use_smtp']) && !empty($config['smtp_host'])) {
      return self::sendViaSmtp($to, $subject, $body, $config);
    }

    $headers = [
      'From: ' . $config['from_name'] . ' <' . $config['from_email'] . '>',
      'Reply-To: ' . ($data['email'] ?? $config['from_email']),
      'Content-Type: text/plain; charset=UTF-8',
    ];

    return @mail($to, $subject, $body, implode("\r\n", $headers));
  }

  private static function sendViaSmtp(string $to, string $subject, string $body, array $config): bool
  {
    try {
      $socket = @fsockopen(
        $config['smtp_host'],
        $config['smtp_port'],
        $errno,
        $errstr,
        10
      );

      if (!$socket) {
        self::logError("SMTP connect failed: {$errstr}");
        return false;
      }

      self::smtpRead($socket);
      fwrite($socket, "EHLO mistysoft.vn\r\n");
      self::smtpRead($socket);

      if (!empty($config['smtp_user'])) {
        fwrite($socket, "AUTH LOGIN\r\n");
        self::smtpRead($socket);
        fwrite($socket, base64_encode($config['smtp_user']) . "\r\n");
        self::smtpRead($socket);
        fwrite($socket, base64_encode($config['smtp_pass']) . "\r\n");
        self::smtpRead($socket);
      }

      fwrite($socket, "MAIL FROM:<{$config['from_email']}>\r\n");
      self::smtpRead($socket);
      fwrite($socket, "RCPT TO:<{$to}>\r\n");
      self::smtpRead($socket);
      fwrite($socket, "DATA\r\n");
      self::smtpRead($socket);

      $message = "From: {$config['from_name']} <{$config['from_email']}>\r\n";
      $message .= "To: {$to}\r\n";
      $message .= "Subject: {$subject}\r\n";
      $message .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
      $message .= $body . "\r\n.\r\n";

      fwrite($socket, $message);
      self::smtpRead($socket);
      fwrite($socket, "QUIT\r\n");
      fclose($socket);

      return true;
    } catch (Throwable $e) {
      self::logError('SMTP error: ' . $e->getMessage());
      return false;
    }
  }

  private static function smtpRead($socket): string
  {
    $response = '';
    while ($line = fgets($socket, 515)) {
      $response .= $line;
      if (isset($line[3]) && $line[3] === ' ') {
        break;
      }
    }
    return $response;
  }

  private static function logError(string $message): void
  {
    $logFile = STORAGE_PATH . '/logs/mail.log';
    $line = date('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL;
    @file_put_contents($logFile, $line, FILE_APPEND);
  }
}

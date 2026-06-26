<?php
declare(strict_types=1);

// Use $_ENV (loaded from .env), then fall back to defaults
// Note: putenv() may be disabled on some shared hosting, so we only use $_ENV
return [
  'from_email' => $_ENV['MAIL_FROM'] ?? 'noreply@mistysoft.vn',
  'from_name' => $_ENV['MAIL_FROM_NAME'] ?? 'MistySoft',
  'to_email' => $_ENV['MAIL_TO'] ?? 'contact@mistysoft.vn',
  'smtp_host' => $_ENV['MAIL_HOST'] ?? '',
  'smtp_port' => (int) ($_ENV['MAIL_PORT'] ?? 587),
  'smtp_user' => $_ENV['MAIL_USERNAME'] ?? '',
  'smtp_pass' => $_ENV['MAIL_PASSWORD'] ?? '',
  'use_smtp' => (bool) ($_ENV['MAIL_USE_SMTP'] ?? false),
];

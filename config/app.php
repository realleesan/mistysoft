<?php
declare(strict_types=1);

// Use $_ENV (loaded from .env), then fall back to defaults
// Note: putenv() may be disabled on some shared hosting, so we only use $_ENV
return [
  'name' => 'MistySoft',
  'base_url' => $_ENV['APP_URL'] ?? '',
  'env' => $_ENV['APP_ENV'] ?? 'production',
  'fb_pixel_id' => $_ENV['FB_PIXEL_ID'] ?? '',
  'messenger_url' => $_ENV['MESSENGER_URL'] ?? 'https://m.me/mistysoft',
  'zalo_url' => $_ENV['ZALO_URL'] ?? 'https://zalo.me/0900000000',
  'zalo_phone' => $_ENV['ZALO_PHONE'] ?? '0900000000',
];

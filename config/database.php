<?php
declare(strict_types=1);

// Use $_ENV first (loaded from .env), then fall back to getenv(), then defaults
// Note: putenv() may be disabled on some shared hosting, so prioritize $_ENV
return [
  'host' => $_ENV['DB_HOST'] ?? 'localhost',
  'port' => $_ENV['DB_PORT'] ?? '3306',
  'database' => $_ENV['DB_DATABASE'] ?? 'mistysoft',
  'username' => $_ENV['DB_USERNAME'] ?? 'root',
  'password' => $_ENV['DB_PASSWORD'] ?? '',
];

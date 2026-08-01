<?php
declare(strict_types=1);

// Enable error display
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');
define('CORE_PATH', BASE_PATH . '/core');
define('CONFIG_PATH', BASE_PATH . '/config');
define('STORAGE_PATH', BASE_PATH . '/storage');
define('PUBLIC_PATH', BASE_PATH . '/public');

require CORE_PATH . '/Database.php';
require CORE_PATH . '/Router.php';
require CORE_PATH . '/Controller.php';
require CORE_PATH . '/View.php';

// Auto-load app classes
spl_autoload_register(function (string $class): void {
    $paths = [
        APP_PATH . '/controllers/' . $class . '.php',
        APP_PATH . '/controllers/Api/V1/' . $class . '.php',
        APP_PATH . '/models/' . $class . '.php',
        APP_PATH . '/services/' . $class . '.php',
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Load Env and Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$envFile = BASE_PATH . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) continue;
        if (!str_contains($line, '=')) continue;
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value, " \t\n\r\0\x0B\"'");
        $_ENV[$key] = $value;
    }
}

// Load configurations
$appConfig = require CONFIG_PATH . '/app.php';
$dbConfig = require CONFIG_PATH . '/database.php';
$mailConfig = require CONFIG_PATH . '/mail.php';
$domainPricesConfig = require CONFIG_PATH . '/domain-prices.php';

$GLOBALS['config'] = [
    'app' => $appConfig,
    'database' => $dbConfig,
    'mail' => $mailConfig,
    'domain_prices' => $domainPricesConfig,
];

echo "<h2>Testing DocumentController::index()</h2>";

try {
    $controller = new DocumentController();
    $controller->index();
    echo "<p style='color: green;'>Success! Controller index executed without throwing exceptions.</p>";
} catch (\Throwable $e) {
    echo "<h3 style='color: red;'>Exception Caught:</h3>";
    echo "<pre>";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString();
    echo "</pre>";
}

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

echo "<h2>System Diagnostic & PDF File Checks</h2>";

// Check files in app/views/document/
$docDir = APP_PATH . '/views/document';
echo "<h3>Checking Directory: $docDir</h3>";
if (!is_dir($docDir)) {
    echo "<p style='color: red;'>Directory does not exist!</p>";
} else {
    echo "<p style='color: green;'>Directory exists.</p>";
    $files = scandir($docDir);
    echo "<ul>";
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = $docDir . '/' . $file;
        $isPDF = str_ends_with(strtolower($file), '.pdf');
        $size = filesize($path);
        $readable = is_readable($path) ? "Yes" : "No";
        $color = $isPDF ? "blue" : "black";
        echo "<li><strong style='color: $color;'>$file</strong> - Size: $size bytes, Readable: $readable</li>";
    }
    echo "</ul>";
}

// Test DocumentController::DOCS mapping
echo "<h3>Checking DocumentController::DOCS Mapping</h3>";
try {
    $reflection = new ReflectionClass('DocumentController');
    $docs = $reflection->getConstant('DOCS');
    echo "<ul>";
    foreach ($docs as $key => $fileName) {
        $path = $docDir . '/' . $fileName;
        if (file_exists($path)) {
            echo "<li><span style='color: green;'>✔</span> <strong>$key</strong> maps to <strong>$fileName</strong> (Exists, Size: " . filesize($path) . " bytes)</li>";
        } else {
            echo "<li><span style='color: red;'>✘</span> <strong>$key</strong> maps to <strong>$fileName</strong> (DOES NOT EXIST AT PATH: $path)</li>";
        }
    }
    echo "</ul>";
} catch (\Throwable $e) {
    echo "<p style='color: red;'>Failed to check constant DOCS: " . $e->getMessage() . "</p>";
}

// Test Stream Action
echo "<h3>Simulating stream() call for 'proposal'</h3>";
try {
    $_GET['doc'] = 'proposal';
    $controller = new DocumentController();
    
    // Capture headers and output
    ob_start();
    // Temporarily disable exit in controller or wrap it
    // Since readfile writes to output, let's see if we can read first 100 bytes of proposal
    $proposalFile = $docDir . '/' . $docs['proposal'];
    if (file_exists($proposalFile)) {
        $handle = fopen($proposalFile, 'rb');
        $chunk = fread($handle, 100);
        fclose($handle);
        echo "<p style='color: green;'>Successfully read first 100 bytes of proposal PDF.</p>";
        echo "<pre>Header bytes: " . bin2hex($chunk) . "</pre>";
    } else {
        echo "<p style='color: red;'>Proposal file does not exist, cannot read.</p>";
    }
} catch (\Throwable $e) {
    echo "<p style='color: red;'>Error simulating stream: " . $e->getMessage() . "</p>";
}

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

if (isset($_GET['test_stream']) && $_GET['test_stream'] === '1') {
    header('Content-Type: text/plain; charset=utf-8');
    try {
        $_GET['doc'] = 'proposal';
        $controller = new DocumentController();
        $controller->stream();
    } catch (\Throwable $e) {
        echo "Exception caught: " . $e->getMessage() . "\n" . $e->getTraceAsString();
    }
    exit;
}

// Check if simulation mode is requested
if (isset($_GET['simulate']) && $_GET['simulate'] === '1') {
    ob_start();
    register_shutdown_function(function() {
        $output = ob_get_clean();
        header_remove();
        header('Content-Type: text/html; charset=utf-8');
        $len = strlen($output);
        $firstBytes = substr($output, 0, 300);
        $headers = headers_list();
        
        echo "<h2>Simulated Stream Route Output</h2>";
        echo "<p>Response length: $len bytes</p>";
        echo "<p>Response headers:</p><pre>" . htmlspecialchars(print_r($headers, true)) . "</pre>";
        echo "<p>First 300 bytes (Hex): " . bin2hex($firstBytes) . "</p>";
        echo "<p>First 300 bytes (Text representation):</p><pre>" . htmlspecialchars($firstBytes) . "</pre>";
    });

    $_SERVER['REQUEST_METHOD'] = 'GET';
    $_SERVER['REQUEST_URI'] = '/api/v1/document/stream';
    $_GET['doc'] = 'proposal';

    require CORE_PATH . '/App.php';
    $app = new App();
    $app->run();
    exit;
}

echo "<h2>System Diagnostic & PDF File Checks</h2>";
echo "<p><a href='?simulate=1' style='font-size: 16px; font-weight: bold; color: blue;'>👉 Click here to simulate internal /api/v1/document/stream route</a></p>";

echo "<h3>System Error Logs</h3>";
$logDir = STORAGE_PATH . '/logs';
if (is_dir($logDir)) {
    $logFiles = glob($logDir . '/*.log');
    if (empty($logFiles)) {
        echo "<p style='color: green;'>No log files found.</p>";
    } else {
        foreach ($logFiles as $lfPath) {
            $lf = basename($lfPath);
            echo "<p><strong>$lf</strong> (" . filesize($lfPath) . " bytes):</p>";
            echo "<pre style='background: #eee; padding: 10px; border: 1px solid #ccc; max-height: 400px; overflow: auto; text-align: left;'>" . htmlspecialchars(file_get_contents($lfPath)) . "</pre>";
        }
    }
} else {
    echo "<p style='color: red;'>Log directory does not exist: $logDir</p>";
}

// Check if .env exists
$envFile = BASE_PATH . '/.env';
echo "<h3>Checking .env file</h3>";
if (file_exists($envFile)) {
    echo "<p style='color: green;'>.env file exists!</p>";
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    echo "<ul>";
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) continue;
        if (!str_contains($line, '=')) continue;
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $displayVal = (str_contains(strtolower($key), 'password') || str_contains(strtolower($key), 'key')) ? '********' : $value;
        echo "<li><strong>$key</strong>: $displayVal</li>";
    }
    echo "</ul>";
} else {
    echo "<p style='color: red;'>.env file does NOT exist in " . BASE_PATH . "!</p>";
}

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

// Check for BOM/leading whitespace in all included PHP files
echo "<h3>Checking for BOM or leading whitespace in PHP files</h3>";
$includedFiles = get_included_files();
// Proactively check DocumentController since it is the target but might not be included yet
$targetControllerFile = APP_PATH . '/controllers/DocumentController.php';
if (file_exists($targetControllerFile) && !in_array($targetControllerFile, $includedFiles)) {
    $includedFiles[] = $targetControllerFile;
}
// Also check index.php (entry points)
$entryPoints = [BASE_PATH . '/index.php', PUBLIC_PATH . '/index.php'];
foreach ($entryPoints as $ep) {
    if (file_exists($ep) && !in_array($ep, $includedFiles)) {
        $includedFiles[] = $ep;
    }
}

$hasIssue = false;
echo "<ul>";
foreach ($includedFiles as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    $displayFile = str_replace(BASE_PATH, "", $file);
    
    // Check BOM
    if (str_starts_with($content, "\xef\xbb\xbf")) {
        echo "<li style='color: red;'>✘ <strong>$displayFile</strong> has UTF-8 BOM!</li>";
        $hasIssue = true;
    }
    
    // Check if there is anything before <?php
    $parts = explode('<?php', $content, 2);
    if (count($parts) > 1 && $parts[0] !== '') {
        $pre = str_replace("\xef\xbb\xbf", "", $parts[0]);
        if ($pre !== '') {
            echo "<li style='color: red;'>✘ <strong>$displayFile</strong> has characters before &lt;?php (Hex: " . bin2hex($pre) . ")</li>";
            $hasIssue = true;
        }
    }
}
if (!$hasIssue) {
    echo "<li style='color: green;'>✔ No BOM or leading whitespace issues found in loaded files!</li>";
}
echo "</ul>";

// Test Stream Action
echo "<h3>Simulating stream() call for 'proposal'</h3>";
try {
    $_GET['doc'] = 'proposal';
    $controller = new DocumentController();
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

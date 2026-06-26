<?php
/**
 * Debug Test File for MistySoft
 * Upload this file to server and access: https://www.mistydev.id.vn/test_debug.php
 * DELETE AFTER USE!
 */

echo "<h1>MistySoft Debug Test</h1>";
echo "<style>body{font-family:monospace;padding:20px;}.pass{color:green}.fail{color:red}.info{color:blue}</style>";

// Test 1: PHP Version
echo "<h2>1. PHP Version</h2>";
$phpVersion = PHP_VERSION;
echo "PHP Version: {$phpVersion}<br>";
if (version_compare($phpVersion, '8.0.0', '>=')) {
    echo "<span class='pass'>✓ PHP 8.0+ supported</span><br>";
} else {
    echo "<span class='fail'>✗ PHP 8.0+ required (current: {$phpVersion})</span><br>";
}

// Test 2: Required Extensions
echo "<h2>2. PHP Extensions</h2>";
$required = ['pdo', 'pdo_mysql', 'json', 'mbstring'];
foreach ($required as $ext) {
    if (extension_loaded($ext)) {
        echo "<span class='pass'>✓ {$ext} loaded</span><br>";
    } else {
        echo "<span class='fail'>✗ {$ext} NOT loaded</span><br>";
    }
}

// Test 3: .env File
echo "<h2>3. .env File</h2>";
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    echo "<span class='pass'>✓ .env file exists</span><br>";
    echo "<span class='info'>Path: {$envFile}</span><br>";
} else {
    echo "<span class='fail'>✗ .env file NOT found</span><br>";
    echo "<span class='info'>Expected: {$envFile}</span><br>";
}

// Test 4: Load .env
echo "<h2>4. .env Variables</h2>";
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $envVars = [];
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) continue;
        if (!str_contains($line, '=')) continue;
        [$key, $value] = explode('=', $line, 2);
        $envVars[trim($key)] = trim($value, " \t\n\r\0\x0B\"'");
    }
    
    $requiredEnv = ['APP_URL', 'APP_ENV', 'DB_HOST', 'DB_DATABASE', 'DB_USERNAME'];
    foreach ($requiredEnv as $key) {
        if (isset($envVars[$key]) && $envVars[$key] !== '') {
            $display = $key === 'DB_PASSWORD' ? '***HIDDEN***' : $envVars[$key];
            echo "<span class='pass'>✓ {$key}: {$display}</span><br>";
        } else {
            echo "<span class='fail'>✗ {$key} NOT set or empty</span><br>";
        }
    }
}

// Test 5: Database Connection
echo "<h2>5. Database Connection</h2>";
try {
    $dbHost = $envVars['DB_HOST'] ?? 'localhost';
    $dbName = $envVars['DB_DATABASE'] ?? '';
    $dbUser = $envVars['DB_USERNAME'] ?? '';
    $dbPass = $envVars['DB_PASSWORD'] ?? '';
    $dbPort = $envVars['DB_PORT'] ?? '3306';
    
    $dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "<span class='pass'>✓ Database connection successful</span><br>";
    echo "<span class='info'>Host: {$dbHost}</span><br>";
    echo "<span class='info'>Database: {$dbName}</span><br>";
} catch (PDOException $e) {
    echo "<span class='fail'>✗ Database connection FAILED</span><br>";
    echo "<span class='fail'>Error: {$e->getMessage()}</span><br>";
}

// Test 6: Database Tables
echo "<h2>6. Database Tables</h2>";
if (isset($pdo)) {
    $requiredTables = ['content_blocks', 'projects', 'pricing_plans', 'contacts'];
    try {
        $stmt = $pdo->query("SHOW TABLES");
        $existingTables = [];
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $existingTables[] = $row[0];
        }
        
        foreach ($requiredTables as $table) {
            if (in_array($table, $existingTables)) {
                echo "<span class='pass'>✓ Table '{$table}' exists</span><br>";
            } else {
                echo "<span class='fail'>✗ Table '{$table}' NOT found</span><br>";
            }
        }
    } catch (PDOException $e) {
        echo "<span class='fail'>✗ Could not check tables: {$e->getMessage()}</span><br>";
    }
}

// Test 7: Core Files
echo "<h2>7. Core Files</h2>";
$coreFiles = [
    __DIR__ . '/core/App.php',
    __DIR__ . '/core/Database.php',
    __DIR__ . '/core/Router.php',
    __DIR__ . '/core/Controller.php',
    __DIR__ . '/core/View.php',
];
foreach ($coreFiles as $file) {
    if (file_exists($file)) {
        echo "<span class='pass'>✓ " . basename($file) . "</span><br>";
    } else {
        echo "<span class='fail'>✗ " . basename($file) . " NOT found</span><br>";
    }
}

// Test 8: Storage Directory
echo "<h2>8. Storage Directory</h2>";
$storageDir = __DIR__ . '/storage/logs';
if (is_dir($storageDir)) {
    echo "<span class='pass'>✓ storage/logs exists</span><br>";
    if (is_writable($storageDir)) {
        echo "<span class='pass'>✓ storage/logs is writable</span><br>";
    } else {
        echo "<span class='fail'>✗ storage/logs is NOT writable</span><br>";
    }
} else {
    echo "<span class='fail'>✗ storage/logs NOT found</span><br>";
}

// Test 9: Try to run App
echo "<h2>9. App Bootstrap Test</h2>";
try {
    define('BASE_PATH', __DIR__);
    define('APP_PATH', BASE_PATH . '/app');
    define('CORE_PATH', BASE_PATH . '/core');
    define('CONFIG_PATH', BASE_PATH . '/config');
    define('STORAGE_PATH', BASE_PATH . '/storage');
    define('PUBLIC_PATH', BASE_PATH . '/public');
    
    require CORE_PATH . '/App.php';
    echo "<span class='pass'>✓ Core files loaded successfully</span><br>";
} catch (Throwable $e) {
    echo "<span class='fail'>✗ App bootstrap FAILED</span><br>";
    echo "<span class='fail'>Error: {$e->getMessage()}</span><br>";
    echo "<span class='fail'>File: {$e->getFile()} Line: {$e->getLine()}</span><br>";
}

echo "<h2>10. Server Info</h2>";
echo "<span class='info'>Document Root: {$_SERVER['DOCUMENT_ROOT']}</span><br>";
echo "<span class='info'>Script Name: {$_SERVER['SCRIPT_NAME']}</span><br>";
echo "<span class='info'>Request URI: {$_SERVER['REQUEST_URI']}</span><br>";

echo "<hr>";
echo "<p style='color:red;font-weight:bold;'>DELETE THIS FILE AFTER DEBUGGING!</p>";

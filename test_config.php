<?php
/**
 * Test Config Loading
 * Check if App.php loads .env and config correctly
 */

echo "<h1>Config Loading Test</h1>";
echo "<style>body{font-family:monospace;padding:20px;}.pass{color:green}.fail{color:red}.info{color:blue}pre{background:#f5f5f5;padding:10px;overflow:auto;}</style>";

define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');
define('CORE_PATH', BASE_PATH . '/core');
define('CONFIG_PATH', BASE_PATH . '/config');
define('STORAGE_PATH', BASE_PATH . '/storage');
define('PUBLIC_PATH', BASE_PATH . '/public');

echo "<h2>1. Direct .env parse (same as App.php)</h2>";
$envFile = BASE_PATH . '/.env';
$lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$envVars = [];
foreach ($lines as $line) {
    $line = trim($line);
    if ($line === '' || str_starts_with($line, '#')) continue;
    if (!str_contains($line, '=')) continue;
    [$key, $value] = explode('=', $line, 2);
    $key = trim($key);
    $value = trim($value, " \t\n\r\0\x0B\"'");
    $envVars[$key] = $value;
    if ($key !== '' && getenv($key) === false) {
        putenv("{$key}={$value}");
        $_ENV[$key] = $value;
    }
}

echo "DB_HOST from parsed .env: " . ($envVars['DB_HOST'] ?? 'NOT FOUND') . "<br>";
echo "DB_DATABASE from parsed .env: " . ($envVars['DB_DATABASE'] ?? 'NOT FOUND') . "<br>";

echo "<h2>2. After putenv() - check getenv()</h2>";
echo "getenv('DB_HOST'): " . (getenv('DB_HOST') ?? 'NOT FOUND') . "<br>";
echo "getenv('DB_DATABASE'): " . (getenv('DB_DATABASE') ?? 'NOT FOUND') . "<br>";

echo "<h2>3. After putenv() - check \$_ENV</h2>";
echo "\$_ENV['DB_HOST']: " . ($_ENV['DB_HOST'] ?? 'NOT FOUND') . "<br>";
echo "\$_ENV['DB_DATABASE']: " . ($_ENV['DB_DATABASE'] ?? 'NOT FOUND') . "<br>";

echo "<h2>4. Load config/database.php</h2>";
$dbConfig = require CONFIG_PATH . '/database.php';
echo "config['database']['host']: " . ($dbConfig['host'] ?? 'NOT FOUND') . "<br>";
echo "config['database']['database']: " . ($dbConfig['database'] ?? 'NOT FOUND') . "<br>";

echo "<h2>5. Now load App.php (which does the same thing)</h2>";
// Clear previous env
$_ENV = [];
putenv('DB_HOST');
putenv('DB_DATABASE');
putenv('DB_USERNAME');
putenv('DB_PASSWORD');
putenv('DB_PORT');

require CORE_PATH . '/App.php';

echo "<h2>6. After App.php load - check config()</h2>";
echo "config('database.host'): " . (config('database.host') ?? 'NOT FOUND') . "<br>";
echo "config('database.database'): " . (config('database.database') ?? 'NOT FOUND') . "<br>";
echo "config('database.username'): " . (config('database.username') ?? 'NOT FOUND') . "<br>";

echo "<h2>7. Check \$_ENV after App.php</h2>";
echo "\$_ENV['DB_HOST']: " . ($_ENV['DB_HOST'] ?? 'NOT FOUND') . "<br>";
echo "\$_ENV['DB_DATABASE']: " . ($_ENV['DB_DATABASE'] ?? 'NOT FOUND') . "<br>";

echo "<h2>8. Try Database connection with config()</h2>";
try {
    $config = config('database');
    echo "Config array:<br>";
    echo "<pre>" . print_r($config, true) . "</pre>";
    
    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        $config['host'],
        $config['port'],
        $config['database']
    );
    echo "DSN: {$dsn}<br>";
    
    $pdo = new PDO($dsn, $config['username'], $config['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "<span class='pass'>✓ Connection successful!</span><br>";
} catch (Throwable $e) {
    echo "<span class='fail'>✗ Connection failed: {$e->getMessage()}</span><br>";
}

echo "<hr>";
echo "<p style='color:red;font-weight:bold;'>DELETE THIS FILE AFTER DEBUGGING!</p>";

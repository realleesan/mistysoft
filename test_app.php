<?php
/**
 * Test script to diagnose MistySoft application issues
 * Run: php test_app.php
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');

define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');
define('CORE_PATH', BASE_PATH . '/core');
define('CONFIG_PATH', BASE_PATH . '/config');
define('STORAGE_PATH', BASE_PATH . '/storage');
define('PUBLIC_PATH', BASE_PATH . '/public');

echo "=== MistySoft Application Diagnostic Test ===\n\n";

// Test 1: Check PHP version
echo "[1] PHP Version: " . phpversion() . "\n";
echo "    Required: >= 7.4\n";
echo "    Status: " . (version_compare(phpversion(), '7.4', '>=') ? "✓ OK" : "✗ FAIL") . "\n\n";

// Test 2: Check required PHP extensions
$required_extensions = ['pdo', 'pdo_mysql', 'json', 'mbstring'];
echo "[2] Required PHP Extensions:\n";
foreach ($required_extensions as $ext) {
    $status = extension_loaded($ext) ? "✓" : "✗";
    echo "    $status $ext\n";
}
echo "\n";

// Test 3: Check file paths
echo "[3] Required Directories:\n";
$dirs = [
    'core' => CORE_PATH,
    'app' => APP_PATH,
    'config' => CONFIG_PATH,
    'storage' => STORAGE_PATH,
    'public' => PUBLIC_PATH,
];
foreach ($dirs as $name => $path) {
    $exists = is_dir($path) ? "✓" : "✗";
    echo "    $exists $name: $path\n";
}
echo "\n";

// Test 4: Check core files
echo "[4] Core Files:\n";
$core_files = ['App.php', 'Router.php', 'Controller.php', 'View.php', 'Database.php'];
foreach ($core_files as $file) {
    $path = CORE_PATH . '/' . $file;
    $exists = file_exists($path) ? "✓" : "✗";
    echo "    $exists $file\n";
}
echo "\n";

// Test 5: Check config files
echo "[5] Config Files:\n";
$config_files = ['app.php', 'database.php', 'mail.php'];
foreach ($config_files as $file) {
    $path = CONFIG_PATH . '/' . $file;
    $exists = file_exists($path) ? "✓" : "✗";
    echo "    $exists $file\n";
}
echo "\n";

// Test 6a: Check .env file
echo "[6a] Environment File (.env):\n";
$env_file = BASE_PATH . '/.env';
if (file_exists($env_file)) {
    echo "    ✓ .env file exists\n";
    echo "    ✓ File size: " . filesize($env_file) . " bytes\n";
    $lines = count(file($env_file));
    echo "    ✓ Lines: $lines\n";
    echo "    First 5 lines:\n";
    $content = file_get_contents($env_file);
    $preview_lines = array_slice(explode("\n", $content), 0, 5);
    foreach ($preview_lines as $line) {
        if (trim($line) !== '' && !str_starts_with($line, '#')) {
            echo "      " . substr($line, 0, 50) . (strlen($line) > 50 ? '...' : '') . "\n";
        }
    }
} else {
    echo "    ✗ .env file NOT FOUND at: $env_file\n";
}
echo "\n";

// Test 6b: Load .env variables (simulating App::loadEnv())
echo "[6b] Loading .env Variables:\n";
$envFile = BASE_PATH . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $loaded_count = 0;
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        if (!str_contains($line, '=')) {
            continue;
        }
        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value, " \t\n\r\0\x0B\"'");
        if ($key !== '' && getenv($key) === false) {
            putenv("{$key}={$value}");
            $_ENV[$key] = $value;
            $loaded_count++;
        }
    }
    echo "    ✓ Loaded $loaded_count variables from .env\n\n";
} else {
    echo "    ✗ .env file not found\n\n";
}

// Test 6: Load configuration
echo "[6] Loading Configuration:\n";
try {
    $GLOBALS['config'] = [
        'app' => require CONFIG_PATH . '/app.php',
        'database' => require CONFIG_PATH . '/database.php',
        'mail' => require CONFIG_PATH . '/mail.php',
    ];
    echo "    ✓ Configuration loaded\n\n";
} catch (Exception $e) {
    echo "    ✗ Configuration load failed: " . $e->getMessage() . "\n\n";
    exit(1);
}

// Test 7: Check environment variables
echo "[7] Environment Variables (from getenv):\n";
$env_vars = ['APP_ENV', 'APP_URL', 'DB_HOST', 'DB_DATABASE', 'DB_USERNAME'];
foreach ($env_vars as $var) {
    $value = getenv($var) ?: 'NOT SET';
    echo "    $var = " . $value . "\n";
}
echo "\n";

// Test 7b: Check $_ENV directly
echo "[7b] Environment Variables (from \$_ENV):\n";
foreach ($env_vars as $var) {
    $value = $_ENV[$var] ?? 'NOT SET';
    echo "    $var = " . $value . "\n";
}
echo "\n";

// Test 7c: Show all loaded .env keys
echo "[7c] All variables loaded from .env:\n";
if (!empty($_ENV)) {
    $env_keys = array_keys($_ENV);
    echo "    Total keys in \$_ENV: " . count($env_keys) . "\n";
    echo "    Keys: " . implode(', ', array_slice($env_keys, 0, 10)) . (count($env_keys) > 10 ? ', ...' : '') . "\n";
} else {
    echo "    \$_ENV is empty\n";
}
echo "\n";

// Test 8: Database connection
echo "[8] Database Connection:\n";
try {
    // Use $_ENV values (since getenv might not work in all contexts)
    $db_host = $_ENV['DB_HOST'] ?? $GLOBALS['config']['database']['host'];
    $db_port = $_ENV['DB_PORT'] ?? $GLOBALS['config']['database']['port'];
    $db_name = $_ENV['DB_DATABASE'] ?? $GLOBALS['config']['database']['database'];
    $db_user = $_ENV['DB_USERNAME'] ?? $GLOBALS['config']['database']['username'];
    $db_pass = $_ENV['DB_PASSWORD'] ?? $GLOBALS['config']['database']['password'];
    
    echo "    Attempting to connect to: $db_host:$db_port/$db_name\n";
    echo "    Using username: $db_user\n";
    
    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
        $db_host,
        $db_port,
        $db_name
    );
    
    $pdo = new PDO($dsn, $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    
    echo "    ✓ Database connection successful\n";
    
    // Check tables
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = ?");
    $stmt->bindValue(1, $db_name, PDO::PARAM_STR);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "    ✓ Tables found: " . $result['count'] . "\n\n";
} catch (PDOException $e) {
    echo "    ✗ Database connection failed:\n";
    echo "      Error: " . $e->getMessage() . "\n\n";
}

// Test 9: Check view files
echo "[9] View Files:\n";
$view_files = [
    'home/index.php',
    'layouts/main.php',
    'errors/404.php',
    'errors/500.php',
    'partials/hero.php',
    'partials/problems.php',
    'partials/solutions.php',
    'partials/portfolio.php',
    'partials/pricing.php',
    'partials/contact.php',
];
$missing_views = [];
foreach ($view_files as $file) {
    $path = APP_PATH . '/views/' . $file;
    $exists = file_exists($path) ? "✓" : "✗";
    echo "    $exists $file\n";
    if (!file_exists($path)) {
        $missing_views[] = $file;
    }
}
if (!empty($missing_views)) {
    echo "    ✗ Missing views: " . implode(', ', $missing_views) . "\n";
}
echo "\n";

// Test 10: Check controller files
echo "[10] Controller Files:\n";
$controllers = ['HomeController.php', 'ProjectController.php', 'ContactController.php'];
foreach ($controllers as $file) {
    $path = APP_PATH . '/controllers/' . $file;
    $exists = file_exists($path) ? "✓" : "✗";
    echo "    $exists $file\n";
}
echo "\n";

// Test 11: Check model files
echo "[11] Model Files:\n";
$models = ['BaseModel.php', 'Contact.php', 'ContentBlock.php', 'PricingPlan.php', 'Project.php'];
foreach ($models as $file) {
    $path = APP_PATH . '/models/' . $file;
    $exists = file_exists($path) ? "✓" : "✗";
    echo "    $exists $file\n";
}
echo "\n";

// Test 12: Test autoloading (require core files first)
echo "[12] Class Autoloading:\n";

// Require core classes first
require_once CORE_PATH . '/Database.php';
require_once CORE_PATH . '/Router.php';
require_once CORE_PATH . '/Controller.php';
require_once CORE_PATH . '/View.php';

// Register autoloader
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

$test_classes = ['HomeController', 'Project', 'ContentBlock', 'PricingPlan'];
foreach ($test_classes as $class) {
    try {
        if (class_exists($class)) {
            echo "    ✓ $class loaded\n";
        } else {
            echo "    ✗ $class not found\n";
        }
    } catch (Exception $e) {
        echo "    ✗ $class error: " . $e->getMessage() . "\n";
    }
}
echo "\n";

// Test 13: Try to instantiate and call HomeController
echo "[13] Testing HomeController::index():\n";
try {
    if (!class_exists('HomeController')) {
        require_once APP_PATH . '/controllers/HomeController.php';
    }
    
    $controller = new HomeController();
    echo "    ✓ HomeController instantiated\n";
    
    // Check if index method exists
    if (method_exists($controller, 'index')) {
        echo "    ✓ index() method exists\n";
    } else {
        echo "    ✗ index() method not found\n";
    }
} catch (Exception $e) {
    echo "    ✗ Error: " . $e->getMessage() . "\n";
    echo "    ✗ Trace: " . $e->getTraceAsString() . "\n";
}
echo "\n";

// Test 14: Storage directory writable
echo "[15] Error Log:\n";
$log_file = STORAGE_PATH . '/logs/error-' . date('Y-m-d') . '.log';
if (file_exists($log_file)) {
    echo "    ✓ Log file found: $log_file\n";
    $content = file_get_contents($log_file);
    $lines = explode("\n", $content);
    echo "    Last 30 lines:\n";
    $last_lines = array_slice($lines, -30);
    foreach ($last_lines as $line) {
        if (trim($line) !== '') {
            echo "      " . $line . "\n";
        }
    }
} else {
    echo "    ✗ No log file found at: $log_file\n";
}
echo "\n";

echo "=== Test Complete ===\n";

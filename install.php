<?php
declare(strict_types=1);

/**
 * One-time database installer for InfinityFree.
 * Visit: https://mistydev.id.vn/install.php?key=YOUR_SETUP_KEY
 * Delete this file after successful install.
 */

define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');
define('CORE_PATH', BASE_PATH . '/core');
define('CONFIG_PATH', BASE_PATH . '/config');
define('STORAGE_PATH', BASE_PATH . '/storage');

require CORE_PATH . '/App.php';
new App();

header('Content-Type: text/plain; charset=utf-8');

$lockFile = STORAGE_PATH . '/installed.lock';
if (file_exists($lockFile)) {
    http_response_code(403);
    echo "Already installed. Delete storage/installed.lock only if you need to reinstall.\n";
    exit;
}

$key = $_GET['key'] ?? '';
$expected = getenv('SETUP_KEY') ?: '';

if ($expected === '' || !hash_equals($expected, $key)) {
    http_response_code(403);
    echo "Forbidden. Invalid setup key.\n";
    exit;
}

try {
    $pdo = Database::getInstance();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $schema = file_get_contents(BASE_PATH . '/database/schema_infinityfree.sql');
    $seed = file_get_contents(BASE_PATH . '/database/seeds/initial_data_infinityfree.sql');

    if ($schema === false || $seed === false) {
        throw new RuntimeException('SQL files not found.');
    }

    foreach (explode(';', $schema) as $statement) {
        $statement = trim($statement);
        if ($statement === '' || str_starts_with($statement, '--')) {
            continue;
        }
        $pdo->exec($statement);
    }

    foreach (explode(';', $seed) as $statement) {
        $statement = trim($statement);
        if ($statement === '' || str_starts_with($statement, '--')) {
            continue;
        }
        $pdo->exec($statement);
    }

    file_put_contents($lockFile, date('c'));

    echo "OK - Database installed successfully.\n";
    echo "Next steps:\n";
    echo "1. Delete install.php from server\n";
    echo "2. Open https://mistydev.id.vn\n";
} catch (Throwable $e) {
    http_response_code(500);
    echo "ERROR: " . $e->getMessage() . "\n";
}

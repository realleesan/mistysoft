<?php
declare(strict_types=1);

/**
 * Entry point for InfinityFree / shared hosting (document root = project root).
 * Local dev: cd public && php -S localhost:8000
 */
define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');
define('CORE_PATH', BASE_PATH . '/core');
define('CONFIG_PATH', BASE_PATH . '/config');
define('STORAGE_PATH', BASE_PATH . '/storage');
define('PUBLIC_PATH', BASE_PATH . '/public');

require CORE_PATH . '/App.php';

$app = new App();
$app->run();

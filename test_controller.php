<?php
/**
 * Deep Debug Test - Test actual Controller execution
 * Upload and access: https://www.mistydev.id.vn/test_controller.php
 * DELETE AFTER USE!
 */

echo "<h1>Deep Controller Debug Test</h1>";
echo "<style>body{font-family:monospace;padding:20px;}.pass{color:green}.fail{color:red}.info{color:blue}pre{background:#f5f5f5;padding:10px;overflow:auto;}</style>";

// Bootstrap
define('BASE_PATH', __DIR__);
define('APP_PATH', BASE_PATH . '/app');
define('CORE_PATH', BASE_PATH . '/core');
define('CONFIG_PATH', BASE_PATH . '/config');
define('STORAGE_PATH', BASE_PATH . '/storage');
define('PUBLIC_PATH', BASE_PATH . '/public');

// Load App.php first (this loads config() function and all core classes)
require CORE_PATH . '/App.php';

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

echo "<h2>Test 1: Database Query - ContentBlock::getActiveBlocks()</h2>";
try {
    $blocks = ContentBlock::getActiveBlocks();
    echo "<span class='pass'>✓ Query successful</span><br>";
    echo "<span class='info'>Found " . count($blocks) . " blocks</span><br>";
    echo "<pre>" . print_r($blocks, true) . "</pre>";
} catch (Throwable $e) {
    echo "<span class='fail'>✗ Query FAILED</span><br>";
    echo "<span class='fail'>Error: {$e->getMessage()}</span><br>";
    echo "<span class='fail'>File: {$e->getFile()} Line: {$e->getLine()}</span><br>";
    echo "<pre>{$e->getTraceAsString()}</pre>";
}

echo "<h2>Test 2: Database Query - Project::getFeatured(6)</h2>";
try {
    $projects = Project::getFeatured(6);
    echo "<span class='pass'>✓ Query successful</span><br>";
    echo "<span class='info'>Found " . count($projects) . " projects</span><br>";
    echo "<pre>" . print_r($projects, true) . "</pre>";
} catch (Throwable $e) {
    echo "<span class='fail'>✗ Query FAILED</span><br>";
    echo "<span class='fail'>Error: {$e->getMessage()}</span><br>";
    echo "<span class='fail'>File: {$e->getFile()} Line: {$e->getLine()}</span><br>";
    echo "<pre>{$e->getTraceAsString()}</pre>";
}

echo "<h2>Test 3: Database Query - PricingPlan::getActive()</h2>";
try {
    $pricing = PricingPlan::getActive();
    echo "<span class='pass'>✓ Query successful</span><br>";
    echo "<span class='info'>Found " . count($pricing) . " pricing plans</span><br>";
    echo "<pre>" . print_r($pricing, true) . "</pre>";
} catch (Throwable $e) {
    echo "<span class='fail'>✗ Query FAILED</span><br>";
    echo "<span class='fail'>Error: {$e->getMessage()}</span><br>";
    echo "<span class='fail'>File: {$e->getFile()} Line: {$e->getLine()}</span><br>";
    echo "<pre>{$e->getTraceAsString()}</pre>";
}

echo "<h2>Test 4: View Files Check</h2>";
$viewFiles = [
    'home/index.php',
    'layouts/main.php',
    'partials/hero.php',
    'partials/problems.php',
    'partials/solutions.php',
    'partials/portfolio.php',
    'partials/pricing.php',
    'partials/contact.php',
];
foreach ($viewFiles as $view) {
    $path = APP_PATH . '/views/' . $view;
    if (file_exists($path)) {
        echo "<span class='pass'>✓ views/{$view}</span><br>";
    } else {
        echo "<span class='fail'>✗ views/{$view} NOT found</span><br>";
    }
}

echo "<h2>Test 5: HomeController Data Preparation (same as index())</h2>";
try {
    $content = ContentBlock::getActiveBlocks();
    $projects = Project::getFeatured(6);
    $pricing = PricingPlan::getActive();
    
    echo "<span class='pass'>✓ All data queries successful</span><br>";
    echo "<span class='info'>Content blocks: " . count($content) . "</span><br>";
    echo "<span class='info'>Projects: " . count($projects) . "</span><br>";
    echo "<span class='info'>Pricing plans: " . count($pricing) . "</span><br>";
    
    // Check if hero block exists
    if (isset($content['hero'])) {
        echo "<span class='pass'>✓ Hero content block exists</span><br>";
    } else {
        echo "<span class='fail'>✗ Hero content block MISSING</span><br>";
        echo "<span class='info'>Available blocks: " . implode(', ', array_keys($content)) . "</span><br>";
    }
} catch (Throwable $e) {
    echo "<span class='fail'>✗ Data preparation FAILED</span><br>";
    echo "<span class='fail'>Error: {$e->getMessage()}</span><br>";
    echo "<span class='fail'>File: {$e->getFile()} Line: {$e->getLine()}</span><br>";
    echo "<pre>{$e->getTraceAsString()}</pre>";
}

echo "<h2>Test 6: Static Assets Check</h2>";
$assets = [
    '/css/main.css',
    '/assets/images/logo.svg',
    '/js/main.js',
    '/js/tracking.js',
];
foreach ($assets as $asset) {
    $path = PUBLIC_PATH . $asset;
    if (file_exists($path)) {
        echo "<span class='pass'>✓ public{$asset}</span><br>";
    } else {
        echo "<span class='fail'>✗ public{$asset} NOT found</span><br>";
    }
}

echo "<hr>";
echo "<p style='color:red;font-weight:bold;'>DELETE THIS FILE AFTER DEBUGGING!</p>";

<?php
declare(strict_types=1);

// Require core classes first (before autoload)
require_once CORE_PATH . '/Database.php';
require_once CORE_PATH . '/Router.php';
require_once CORE_PATH . '/Controller.php';
require_once CORE_PATH . '/View.php';

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

class App
{
  private Router $router;

  public function __construct()
  {
    $this->loadEnv();
    $this->startSession();
    $this->loadConfig();
    $this->router = new Router();
    $this->registerRoutes();
  }

  private function loadEnv(): void
  {
    $envFile = BASE_PATH . '/.env';
    if (!file_exists($envFile)) {
      return;
    }

    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
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
      }
    }
  }

  private function loadConfig(): void
  {
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
  }

  private function startSession(): void
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
  }

  private function registerRoutes(): void
  {
    $this->router->get('/', 'HomeController@index');
    $this->router->get('/ecosystem', 'HomeController@ecosystem');
    $this->router->get('/coming-soon', 'HomeController@comingSoon');
    $this->router->get('/projects/{slug}', 'ProjectController@show');
    $this->router->post('/contact', 'ContactController@store');
    $this->router->get('/check-domain', 'DomainController@index');
    $this->router->get('/api/v1/check-domain', 'DomainController@check');

    $this->router->get('/api/v1/projects', 'ProjectController@apiIndex');
    $this->router->get('/api/v1/projects/{slug}', 'ProjectController@apiShow');
    $this->router->post('/api/v1/contact', 'ContactController@apiStore');
  }

  public function run(): void
  {
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    $uri = $this->getRequestUri();

    try {
      $this->router->dispatch($method, $uri);
    } catch (\Throwable $e) {
      $this->handleException($e);
    }
  }

  private function handleException(\Throwable $e): void
  {
    $logDir = STORAGE_PATH . '/logs';
    if (!is_dir($logDir)) {
      @mkdir($logDir, 0755, true);
    }

    $logFile = $logDir . '/error-' . date('Y-m-d') . '.log';
    $message = sprintf("[%s] %s in %s:%d\nStack trace:\n%s\n\n",
      date('c'), $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString()
    );

    @file_put_contents($logFile, $message, FILE_APPEND);

    http_response_code(500);

    $env = config('app.env', 'production');
    $show = $env !== 'production';

    try {
      View::render('errors/500', [
        'message' => $show ? $e->getMessage() : null,
      ], 'main');
    } catch (\Throwable $ex) {
      echo '<h1>500 - Internal Server Error</h1>';
      if ($show) {
        echo '<pre>' . htmlspecialchars($e->getMessage() . "\n\n" . $e->getTraceAsString(), ENT_QUOTES, 'UTF-8') . '</pre>';
      }
    }
  }

  private function getRequestUri(): string
  {
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $uri = parse_url($uri, PHP_URL_PATH) ?: '/';
    $uri = rtrim($uri, '/') ?: '/';

    $scriptName = dirname($_SERVER['SCRIPT_NAME'] ?? '');
    if ($scriptName !== '/' && $scriptName !== '\\' && str_starts_with($uri, $scriptName)) {
      $uri = substr($uri, strlen($scriptName)) ?: '/';
    }

    return $uri;
  }
}

function config(string $key, mixed $default = null): mixed
{
  $keys = explode('.', $key);
  $value = $GLOBALS['config'] ?? [];

  foreach ($keys as $k) {
    if (!is_array($value) || !array_key_exists($k, $value)) {
      return $default;
    }
    $value = $value[$k];
  }

  return $value;
}

function e(?string $value): string
{
  return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function url(string $path = ''): string
{
  $base = rtrim(config('app.base_url', ''), '/');
  $path = '/' . ltrim($path, '/');
  return $base . ($path === '/' ? '' : $path);
}

function asset(string $path): string
{
  return url($path);
}

function csrf_token(): string
{
  if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
  }
  return $_SESSION['csrf_token'];
}

function verify_csrf(?string $token): bool
{
  return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token ?? '');
}

function flash(string $key, ?string $value = null): ?string
{
  if ($value !== null) {
    $_SESSION['flash'][$key] = $value;
    return null;
  }

  $message = $_SESSION['flash'][$key] ?? null;
  unset($_SESSION['flash'][$key]);
  return $message;
}

function json_response(array $data, int $status = 200): void
{
  http_response_code($status);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($data, JSON_UNESCAPED_UNICODE);
  exit;
}

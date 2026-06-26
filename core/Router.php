<?php
declare(strict_types=1);

class Router
{
  private array $routes = [];

  public function get(string $uri, string $action): void
  {
    $this->add('GET', $uri, $action);
  }

  public function post(string $uri, string $action): void
  {
    $this->add('POST', $uri, $action);
  }

  private function add(string $method, string $uri, string $action): void
  {
    $this->routes[] = compact('method', 'uri', 'action');
  }

  public function dispatch(string $method, string $uri): void
  {
    foreach ($this->routes as $route) {
      $pattern = preg_replace('/\{([a-zA-Z_]+)\}/', '([^/]+)', $route['uri']);
      $pattern = '#^' . $pattern . '$#';

      if ($route['method'] === $method && preg_match($pattern, $uri, $matches)) {
        array_shift($matches);
        [$class, $methodName] = explode('@', $route['action']);

        if (!class_exists($class)) {
          $this->notFound();
          return;
        }

        $controller = new $class();

        if (!method_exists($controller, $methodName)) {
          $this->notFound();
          return;
        }

        call_user_func_array([$controller, $methodName], $matches);
        return;
      }
    }

    $this->notFound();
  }

  private function notFound(): void
  {
    http_response_code(404);
    View::render('errors/404', [
      'title' => 'Không tìm thấy trang',
    ], 'main');
  }
}

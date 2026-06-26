<?php
declare(strict_types=1);

class Controller
{
  protected function view(string $template, array $data = [], ?string $layout = 'main'): void
  {
    View::render($template, $data, $layout);
  }

  protected function redirect(string $path): void
  {
    header('Location: ' . url($path));
    exit;
  }

  protected function getClientIp(): string
  {
    return $_SERVER['HTTP_X_FORWARDED_FOR']
      ?? $_SERVER['REMOTE_ADDR']
      ?? '0.0.0.0';
  }

  protected function getSource(): string
  {
    return $_GET['utm_source']
      ?? $_POST['source']
      ?? $_SESSION['utm_source']
      ?? 'landing';
  }
}

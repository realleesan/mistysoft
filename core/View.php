<?php
declare(strict_types=1);

class View
{
  public static function render(string $template, array $data = [], ?string $layout = 'main'): void
  {
    extract($data, EXTR_SKIP);

    $viewPath = APP_PATH . '/views/' . $template . '.php';

    if (!file_exists($viewPath)) {
      throw new RuntimeException("View not found: {$template}");
    }

    ob_start();
    require $viewPath;
    $content = ob_get_clean();

    if ($layout) {
      $layoutPath = APP_PATH . '/views/layouts/' . $layout . '.php';
      if (!file_exists($layoutPath)) {
        throw new RuntimeException("Layout not found: {$layout}");
      }
      require $layoutPath;
      return;
    }

    echo $content;
  }
}

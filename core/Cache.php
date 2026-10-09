<?php
declare(strict_types=1);

class Cache
{
  private static array $memoryCache = [];

  private static function getCacheDir(): string
  {
    $dir = STORAGE_PATH . '/cache';
    if (!is_dir($dir)) {
      @mkdir($dir, 0755, true);
    }
    return $dir;
  }

  private static function getFilePath(string $key): string
  {
    return self::getCacheDir() . '/' . md5($key) . '.cache';
  }

  public static function get(string $key, mixed $default = null): mixed
  {
    // Bypass cache if explicitly requested via query param
    if (isset($_GET['refresh_cache']) && $_GET['refresh_cache'] === '1') {
      return $default;
    }

    if (array_key_exists($key, self::$memoryCache)) {
      return self::$memoryCache[$key];
    }

    $file = self::getFilePath($key);
    if (!file_exists($file)) {
      return $default;
    }

    $content = @file_get_contents($file);
    if ($content === false || $content === '') {
      return $default;
    }

    try {
      $payload = @unserialize($content);
      if (!is_array($payload) || !isset($payload['expires_at'], $payload['data'])) {
        @unlink($file);
        return $default;
      }

      if ($payload['expires_at'] !== 0 && $payload['expires_at'] < time()) {
        @unlink($file);
        return $default;
      }

      self::$memoryCache[$key] = $payload['data'];
      return $payload['data'];
    } catch (\Throwable $e) {
      @unlink($file);
      return $default;
    }
  }

  public static function set(string $key, mixed $value, int $ttl = 86400): bool
  {
    self::$memoryCache[$key] = $value;
    $file = self::getFilePath($key);

    $payload = [
      'expires_at' => $ttl > 0 ? time() + $ttl : 0,
      'data' => $value,
    ];

    $serialized = serialize($payload);
    $tempFile = $file . '.' . uniqid('tmp', true);

    if (@file_put_contents($tempFile, $serialized, LOCK_EX) !== false) {
      return @rename($tempFile, $file);
    }

    return false;
  }

  public static function remember(string $key, int $ttl, callable $callback): mixed
  {
    $cached = self::get($key);
    if ($cached !== null) {
      return $cached;
    }

    $data = $callback();
    self::set($key, $data, $ttl);
    return $data;
  }

  public static function forget(string $key): bool
  {
    unset(self::$memoryCache[$key]);
    $file = self::getFilePath($key);
    if (file_exists($file)) {
      return @unlink($file);
    }
    return true;
  }

  public static function flush(): bool
  {
    self::$memoryCache = [];
    $dir = self::getCacheDir();
    $files = @glob($dir . '/*.cache');
    if ($files) {
      foreach ($files as $file) {
        @unlink($file);
      }
    }
    return true;
  }
}

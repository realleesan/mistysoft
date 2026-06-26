<?php
declare(strict_types=1);

class BaseModel
{
  protected static function db(): PDO
  {
    return Database::getInstance();
  }

  protected static function decodeJson(?string $json): mixed
  {
    if ($json === null || $json === '') {
      return null;
    }
    return json_decode($json, true);
  }
}

<?php
declare(strict_types=1);

class ContentBlock extends BaseModel
{
  public static function getActiveBlocks(): array
  {
    $stmt = self::db()->query(
      'SELECT block_key, title, content FROM content_blocks WHERE is_active = 1'
    );

    $blocks = [];
    foreach ($stmt->fetchAll() as $row) {
      $blocks[$row['block_key']] = [
        'title' => $row['title'],
        'content' => self::decodeJson($row['content']),
      ];
    }

    return $blocks;
  }

  public static function getByKey(string $key): ?array
  {
    $stmt = self::db()->prepare(
      'SELECT block_key, title, content FROM content_blocks WHERE block_key = ? AND is_active = 1 LIMIT 1'
    );
    $stmt->execute([$key]);
    $row = $stmt->fetch();

    if (!$row) {
      return null;
    }

    return [
      'title' => $row['title'],
      'content' => self::decodeJson($row['content']),
    ];
  }
}

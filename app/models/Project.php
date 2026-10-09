<?php
declare(strict_types=1);

class Project extends BaseModel
{
  public static function getFeatured(int $limit = 50): array
  {
    return Cache::remember("projects_featured_{$limit}", 86400, function () use ($limit) {
      $stmt = self::db()->prepare(
        'SELECT id, title, slug, short_description, logo, website_url
         FROM projects
         WHERE is_active = 1
         ORDER BY sort_order ASC, id DESC
         LIMIT ?'
      );
      $stmt->bindValue(1, $limit, PDO::PARAM_INT);
      $stmt->execute();

      return $stmt->fetchAll();
    });
  }

  public static function getAll(): array
  {
    return Cache::remember('projects_all', 86400, function () {
      $stmt = self::db()->query(
        'SELECT id, title, slug, short_description, logo, website_url
         FROM projects
         WHERE is_active = 1
         ORDER BY sort_order ASC, id DESC'
      );

      return $stmt->fetchAll();
    });
  }

  public static function findBySlug(string $slug): ?array
  {
    return Cache::remember("project_slug_{$slug}", 86400, function () use ($slug) {
      $stmt = self::db()->prepare(
        'SELECT * FROM projects WHERE slug = ? AND is_active = 1 LIMIT 1'
      );
      $stmt->execute([$slug]);
      $row = $stmt->fetch();

      if (!$row) {
        return null;
      }

      return $row;
    });
  }

  public static function formatForApi(array $project): array
  {
    return [
      'id' => (int) $project['id'],
      'title' => $project['title'],
      'slug' => $project['slug'],
      'short_description' => $project['short_description'],
      'description' => $project['description'] ?? null,
      'logo' => $project['logo'],
      'website_url' => $project['website_url'],
    ];
  }
}

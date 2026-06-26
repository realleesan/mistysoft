<?php
declare(strict_types=1);

class Contact extends BaseModel
{
  public static function create(array $data): int
  {
    $stmt = self::db()->prepare(
      'INSERT INTO contacts (name, phone, email, package, hosting, website_type, website_type_other, industry, industry_other, purpose, purpose_other, message, attachment_path, source, ip_address)
       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
    );

    $stmt->execute([
      $data['name'],
      $data['phone'] ?? null,
      $data['email'] ?? null,
      $data['package'] ?? null,
      $data['hosting'] ?? null,
      $data['website_type'] ?? null,
      $data['website_type_other'] ?? null,
      $data['industry'] ?? null,
      $data['industry_other'] ?? null,
      $data['purpose'] ?? null,
      $data['purpose_other'] ?? null,
      $data['message'] ?? null,
      $data['attachment_path'] ?? null,
      $data['source'] ?? 'landing',
      $data['ip_address'] ?? null,
    ]);

    return (int) self::db()->lastInsertId();
  }
}

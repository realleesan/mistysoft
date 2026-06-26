<?php
declare(strict_types=1);

class PricingPlan extends BaseModel
{
  public static function getActive(): array
  {
    $stmt = self::db()->query(
      'SELECT id, name, price, features, is_featured, is_custom
       FROM pricing_plans
       WHERE is_active = 1
       ORDER BY sort_order ASC'
    );

    $plans = [];
    foreach ($stmt->fetchAll() as $row) {
      $row['features'] = self::decodeJson($row['features']) ?? [];
      $row['price'] = $row['price'] !== null ? (float) $row['price'] : null;
      $plans[] = $row;
    }

    return $plans;
  }

  public static function formatPrice(?float $price): string
  {
    if ($price === null) {
      return 'Liên hệ';
    }
    return number_format($price, 0, ',', '.') . 'đ';
  }
}

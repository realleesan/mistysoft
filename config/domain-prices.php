<?php
declare(strict_types=1);

return [
    // Giá gốc từ nhà cung cấp (Tenten, P.A Vietnam, Mắt Bão)
    'base_prices' => [
        // Tên miền Việt Nam
        '.vn' => 450000,
        '.com.vn' => 350000,
        '.net.vn' => 30000,
        '.biz.vn' => 150000,
        '.org.vn' => 150000,
        '.info.vn' => 150000,
        '.edu.vn' => 150000,
        '.gov.vn' => 150000,
        '.pro.vn' => 150000,
        '.health.vn' => 150000,
        '.name.vn' => 150000,
        
        // Tên miền Quốc tế phổ biến
        '.com' => 248000,
        '.net' => 348000,
        '.org' => 249000,
        '.info' => 102000,
        '.biz' => 89000,
        '.xyz' => 58000,
        '.io' => 350000,
        '.co' => 280000,
        '.me' => 180000,
        '.tv' => 280000,
        '.cc' => 120000,
        '.ws' => 120000,
        '.name' => 120000,
        '.asia' => 150000,
        '.mobi' => 180000,
        '.online' => 28000,
        '.site' => 28000,
        '.tech' => 86000,
        '.shop' => 60000,
        '.store' => 28000,
        '.club' => 129000,
        '.blog' => 28000,
        '.dev' => 120000,
        '.app' => 120000,
        '.cloud' => 28000,
        '.digital' => 28000,
        '.agency' => 28000,
        '.company' => 28000,
        '.services' => 28000,
    ],
    
    // Markup theo TLD (có thể điều chỉnh)
    'markup_percent' => [
        '.vn' => 0.20,           // 20% markup cho .vn
        '.com.vn' => 0.15,       // 15% markup cho .com.vn
        '.net.vn' => 0.50,       // 50% markup cho .net.vn (giá gốc thấp)
        '.biz.vn' => 0.20,
        '.org.vn' => 0.20,
        '.info.vn' => 0.20,
        '.edu.vn' => 0.20,
        '.gov.vn' => 0.20,
        '.pro.vn' => 0.20,
        '.health.vn' => 0.20,
        '.name.vn' => 0.20,
        
        '.com' => 0.15,          // 15% markup cho .com
        '.net' => 0.15,
        '.org' => 0.15,
        '.info' => 0.20,
        '.biz' => 0.20,
        '.xyz' => 0.30,          // 30% markup cho .xyz (giá gốc rất thấp)
        '.io' => 0.15,
        '.co' => 0.15,
        '.me' => 0.20,
        '.tv' => 0.15,
        '.cc' => 0.20,
        '.ws' => 0.20,
        '.name' => 0.20,
        '.asia' => 0.20,
        '.mobi' => 0.20,
        '.online' => 0.50,       // 50% markup cho .online (giá gốc rất thấp)
        '.site' => 0.50,
        '.tech' => 0.20,
        '.shop' => 0.20,
        '.store' => 0.50,
        '.club' => 0.20,
        '.blog' => 0.50,
        '.dev' => 0.20,
        '.app' => 0.20,
        '.cloud' => 0.50,
        '.digital' => 0.50,
        '.agency' => 0.50,
        '.company' => 0.50,
        '.services' => 0.50,
    ],
    
    // Markup mặc định cho TLD không có trong danh sách
    'default_markup' => 0.15,   // 15%
    
    // TLD gợi ý khi check domain (ưu tiên hiển thị)
    'suggested_tlds' => [
        '.com', '.net', '.org', '.vn', '.com.vn', '.net.vn', '.xyz', '.io', '.co', '.me'
    ],
    
    // API Configuration
    'api' => [
        'provider' => 'whoisjson', // whoisjson hoặc whoisfreaks
        'whoisjson' => [
            'base_url' => 'https://whoisjson.com/api/v1',
            'api_key' => $_ENV['WHOISJSON_API_KEY'] ?? '',
        ],
        'whoisfreaks' => [
            'base_url' => 'https://api.whoisfreaks.com/v1.0',
            'api_key' => $_ENV['WHOISFREAKS_API_KEY'] ?? '',
        ],
    ],
];

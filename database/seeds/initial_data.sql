-- MistySoft Initial Seed Data
-- Note: Run this after selecting the correct database in phpMyAdmin
-- Do NOT include USE statement on shared hosting

INSERT INTO content_blocks (block_key, title, content) VALUES
('hero', 'Hero Section', JSON_OBJECT(
  'headline', 'Thiết kế website chuyên nghiệp',
  'subheadline', 'MistySoft giúp doanh nghiệp của bạn có mặt online ấn tượng, tối ưu chuyển đổi và tăng uy tín thương hiệu.',
  'cta_text', 'Liên hệ ngay',
  'cta_secondary', 'Xem bảng giá'
)),
('problems', 'Vấn đề khách hàng', JSON_OBJECT(
  'section_title', 'Bạn đang gặp phải vấn đề này?',
  'items', JSON_ARRAY(
    JSON_OBJECT('icon', 'old', 'title', 'Website cũ', 'description', 'Giao diện lỗi thời, không responsive, khách hàng rời đi ngay khi vào trang.'),
    JSON_OBJECT('icon', 'traffic', 'title', 'Không có khách', 'description', 'Website không xuất hiện trên Google, không thu hút được lượt truy cập.'),
    JSON_OBJECT('icon', 'trust', 'title', 'Thiếu uy tín', 'description', 'Thiếu thông tin rõ ràng, khách hàng không tin tưởng để liên hệ hay mua hàng.')
  )
)),
('solutions', 'Giải pháp MistySoft', JSON_OBJECT(
  'section_title', 'Giải pháp từ MistySoft',
  'items', JSON_ARRAY(
    JSON_OBJECT('icon', 'design', 'title', 'Thiết kế theo yêu cầu', 'description', 'Website được thiết kế riêng theo thương hiệu và mục tiêu kinh doanh của bạn.'),
    JSON_OBJECT('icon', 'conversion', 'title', 'Tối ưu chuyển đổi', 'description', 'Bố cục, CTA và nội dung được tối ưu để biến khách truy cập thành khách hàng.'),
    JSON_OBJECT('icon', 'professional', 'title', 'Giao diện chuyên nghiệp', 'description', 'Thiết kế hiện đại, sạch sẽ, tạo ấn tượng mạnh ngay từ lần đầu truy cập.')
  )
)),
('portfolio', 'Portfolio', JSON_OBJECT(
  'section_title', 'Dự án đã thực hiện',
  'section_subtitle', 'Một số dự án tiêu biểu mà MistySoft đã triển khai cho khách hàng.'
)),
('pricing', 'Bảng giá', JSON_OBJECT(
  'section_title', 'Bảng giá dịch vụ',
  'section_subtitle', 'Chọn gói phù hợp với nhu cầu của bạn. Tất cả gói đều bao gồm hosting 1 năm và hỗ trợ kỹ thuật.'
)),
('contact', 'Liên hệ', JSON_OBJECT(
  'section_title', 'Sẵn sàng bắt đầu?',
  'section_subtitle', 'Liên hệ ngay để được tư vấn miễn phí và nhận báo giá chi tiết cho dự án của bạn.'
));

INSERT INTO projects (title, slug, short_description, description, logo, images, website_url, sort_order) VALUES
(
  'GreenLife Spa',
  'greenlife-spa',
  'Website spa & wellness với booking online',
  'Thiết kế website cho chuỗi spa GreenLife với giao diện tươi mới, tích hợp form đặt lịch online và gallery dịch vụ. Website giúp tăng 40% lượt đặt lịch qua online trong 3 tháng đầu.',
  '/assets/images/projects/greenlife-logo.svg',
  JSON_ARRAY('/assets/images/projects/greenlife-1.svg', '/assets/images/projects/greenlife-2.svg'),
  'https://example.com/greenlife',
  1
),
(
  'TechNova Solutions',
  'technova-solutions',
  'Landing page công ty công nghệ B2B',
  'Xây dựng landing page cho TechNova Solutions — công ty cung cấp giải pháp phần mềm doanh nghiệp. Trang web tập trung vào lead generation với form liên hệ và case study.',
  '/assets/images/projects/technova-logo.svg',
  JSON_ARRAY('/assets/images/projects/technova-1.svg', '/assets/images/projects/technova-2.svg'),
  'https://example.com/technova',
  2
),
(
  'Bánh Mì Sài Gòn',
  'banh-mi-sai-gon',
  'Website nhà hàng với menu online',
  'Website nhà hàng Bánh Mì Sài Gòn với menu đầy đủ, hình ảnh món ăn hấp dẫn và tích hợp Google Maps. Tối ưu cho tìm kiếm địa phương.',
  '/assets/images/projects/banhmi-logo.svg',
  JSON_ARRAY('/assets/images/projects/banhmi-1.svg', '/assets/images/projects/banhmi-2.svg'),
  'https://example.com/banhmi',
  3
),
(
  'EduSmart Academy',
  'edusmart-academy',
  'Nền tảng giáo dục trực tuyến',
  'Website trung tâm đào tạo EduSmart với danh sách khóa học, lịch khai giảng và form đăng ký. Thiết kế thân thiện, dễ sử dụng cho mọi lứa tuổi.',
  '/assets/images/projects/edusmart-logo.svg',
  JSON_ARRAY('/assets/images/projects/edusmart-1.svg', '/assets/images/projects/edusmart-2.svg'),
  'https://example.com/edusmart',
  4
);

INSERT INTO pricing_plans (name, price, features, is_featured, is_custom, sort_order) VALUES
(
  'Gói Cơ Bản',
  3000000,
  JSON_ARRAY(
    'Landing page 1 trang',
    'Thiết kế responsive',
    'Form liên hệ',
    'Tối ưu SEO cơ bản',
    'Hosting 1 năm',
    'Hỗ trợ 30 ngày'
  ),
  0, 0, 1
),
(
  'Gói Tiêu Chuẩn',
  6000000,
  JSON_ARRAY(
    'Website đến 5 trang',
    'Thiết kế theo thương hiệu',
    'Tối ưu chuyển đổi',
    'Tích hợp Messenger/Zalo',
    'SEO nâng cao',
    'Hosting 1 năm',
    'Hỗ trợ 60 ngày'
  ),
  1, 0, 2
),
(
  'Gói Cao Cấp',
  9000000,
  JSON_ARRAY(
    'Website đến 10 trang',
    'Thiết kế premium',
    'Blog/Tin tức',
    'Tích hợp Google Analytics',
    'Tối ưu tốc độ',
    'Hosting 1 năm',
    'Hỗ trợ 90 ngày'
  ),
  0, 0, 3
),
(
  'Gói Custom',
  NULL,
  JSON_ARRAY(
    'Giải pháp theo yêu cầu',
    'E-commerce / Hệ thống phức tạp',
    'Tích hợp API',
    'Dashboard quản trị',
    'Bảo trì dài hạn',
    'Liên hệ để báo giá'
  ),
  0, 1, 4
);

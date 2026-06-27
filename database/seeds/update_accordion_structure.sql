-- Update Problems Section with Accordion Structure
UPDATE content_blocks 
SET content = JSON_OBJECT(
  'section_title', 'Tại sao bạn nên thiết kế website tại MistySoft?',
  'section_subtitle', 'Những lý do khiến MistySoft trở thành lựa chọn hàng đầu cho doanh nghiệp của bạn.',
  'items', JSON_ARRAY(
    JSON_OBJECT('title', 'Website chuyên nghiệp, tạo uy tín ngay từ cái nhìn đầu tiên', 'description', 'Giao diện hiện đại, tối ưu trải nghiệm người dùng, giúp khách hàng tin tưởng ngay khi truy cập.', 'answer', 'MistySoft thiết kế website không chỉ đẹp mà còn chuẩn UX/UI, giúp tăng tỷ lệ chuyển đổi và giữ chân khách hàng lâu hơn.'),
    JSON_OBJECT('title', 'Tối ưu SEO, dễ dàng tìm thấy trên Google', 'description', 'Website được tối ưu chuẩn SEO, giúp doanh nghiệp của bạn xuất hiện cao hơn trong kết quả tìm kiếm.', 'answer', 'Chúng tôi áp dụng các kỹ thuật SEO hiện đại: tối ưu tốc độ, cấu trúc HTML chuẩn, meta tags, và nội dung thân thiện với công cụ tìm kiếm.'),
    JSON_OBJECT('title', 'Tốc độ tải trang nhanh, không làm khách hàng chờ đợi', 'description', 'Website được tối ưu hóa để tải nhanh trên mọi thiết bị, từ desktop đến mobile.', 'answer', 'Tốc độ tải trang ảnh hưởng trực tiếp đến SEO và trải nghiệm người dùng. MistySoft đảm bảo website của bạn đạt điểm cao trên Google PageSpeed Insights.'),
    JSON_OBJECT('title', 'Responsive hoàn hảo trên mọi thiết bị', 'description', 'Website hiển thị đẹp và hoạt động tốt trên điện thoại, máy tính bảng, và desktop.', 'answer', 'Với xu hướng mobile-first, chúng tôi đảm bảo website của bạn hoạt động mượt mà trên mọi kích thước màn hình, mang lại trải nghiệm nhất quán.'),
    JSON_OBJECT('title', 'Hỗ trợ kỹ thuật tận tâm, dài hạn', 'description', 'Không chỉ thiết kế, MistySoft còn đồng hành cùng bạn trong quá trình vận hành và phát triển.', 'answer', 'Gói hỗ trợ bao gồm: sửa lỗi nhỏ, tư vấn nâng cấp, backup dữ liệu định kỳ, và hướng dẫn sử dụng quản trị website.')
  )
),
image = 'problems.png'
WHERE block_key = 'problems';

-- Update Solutions Section with Accordion Structure  
UPDATE content_blocks 
SET content = JSON_OBJECT(
  'section_title', 'MistySoft mang đến cho bạn',
  'section_subtitle', 'Giải pháp toàn diện giúp doanh nghiệp của bạn phát triển bền vững.',
  'items', JSON_ARRAY(
    JSON_OBJECT('title', 'Thiết kế theo yêu cầu, không dùng template có sẵn', 'description', 'Mỗi website được thiết kế riêng biệt, phản ánh đúng bản sắc thương hiệu của bạn.', 'answer', 'Chúng tôi không sử dụng template. Mỗi dự án được nghiên cứu kỹ lưỡng, từ màu sắc, typography đến layout để tạo ra website độc bản.'),
    JSON_OBJECT('title', 'Tối ưu chuyển đổi, biến khách truy cập thành khách hàng', 'description', 'Bố cục, CTA và nội dung được tối ưu để tăng tỷ lệ chuyển đổi.', 'answer', 'Dựa trên nghiên cứu hành vi người dùng, chúng tôi đặt các nút CTA chiến lược, tối ưu form liên hệ, và tạo flow dẫn dắt khách hàng đến hành động mong muốn.'),
    JSON_OBJECT('title', 'Tích hợp các công cụ marketing cần thiết', 'description', 'Website sẵn sàng để chạy quảng cáo và tracking hiệu quả.', 'answer', 'Tích hợp Facebook Pixel, Google Analytics, Google Tag Manager, và các công cụ tracking khác giúp bạn đo lường hiệu quả chiến dịch marketing.'),
    JSON_OBJECT('title', 'Bảo mật và tốc độ tối ưu', 'description', 'Website được bảo mật tốt, tải nhanh, và ổn định.', 'answer', 'Sử dụng SSL certificate, bảo mật chống DDoS, tối ưu caching, và CDN giúp website của bạn an toàn và nhanh chóng.'),
    JSON_OBJECT('title', 'Dễ dàng quản trị và mở rộng', 'description', 'Hệ thống quản trị thân thiện, dễ sử dụng, có thể mở rộng tính năng khi cần.', 'answer', 'Admin panel trực quan, cho phép bạn cập nhật nội dung, thêm sản phẩm, bài viết một cách dễ dàng. Cấu trúc code linh hoạt giúp thêm tính năng mới khi business phát triển.')
  )
),
image = 'solutions.png'
WHERE block_key = 'solutions';

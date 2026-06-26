-- Update Projects - Delete temporary projects and insert official projects
-- Run this file in phpMyAdmin after selecting your database

-- Delete all existing projects
DELETE FROM projects;

-- Insert 5 new official projects
INSERT INTO projects (title, slug, short_description, description, logo, images, website_url, sort_order, is_active) VALUES
(
  'Thư viện tranh',
  'thu-vien-tranh',
  'Website bán tranh dán tường',
  'Thư Viện Tranh là đội ngũ cung cấp kho tranh đầy đủ nhất về mẫu mã và chất lượng cho thị trường, đáp ứng mọi nhu cầu khách hàng về tranh in. Bao gồm các thể loại như: tranh dán tường, tranh treo tường, backgound, file tranh.... Và in trên mọi chất liệu như vải canvas, vải lụa, decal, bạt...',
  'assets/images/projects/logo.webp',
  JSON_ARRAY('assets/images/projects/thuvientranh.png'),
  'https://thuvientranh.com/',
  1,
  1
),
(
  'VinaLogistics',
  'vina-logistics',
  'Website giới thiệu công ty vận chuyển Việt - Trung',
  'Công ty TNHH Thương mại và Dịch vụ XNK Trường Vina là đơn vị chuyên cung cấp dịch vụ vận chuyển hàng hóa và logistics với hơn 5 năm kinh nghiệm trong lĩnh vực nhập khẩu từ Trung Quốc về Việt Nam.
Chúng tôi tự hào là đối tác đáng tin cậy của hàng ngàn doanh nghiệp và cá nhân trong việc vận chuyển hàng hóa an toàn, nhanh chóng với chi phí tối ưu nhất.
Với đội ngũ nhân viên chuyên nghiệp, giàu kinh nghiệm và hệ thống vận chuyển hiện đại, chúng tôi cam kết mang đến dịch vụ tốt nhất cho khách hàng.',
  'assets/images/projects/logo-removebg.png',
  JSON_ARRAY('assets/images/projects/vnlg.png'),
  'https://truongvinalogistics.com/',
  2,
  1
),
(
  'HappyBird''s Nest',
  'happy-birds-nest',
  'Website bán yến sào cao cấp',
  'Tự hào là thương hiệu yến sào cao cấp hàng đầu Việt Nam, Happy Bird''s Nest mang đến những sản phẩm yến sào nguyên chất 100%, đảm bảo chất lượng và an toàn cho sức khỏe người tiêu dùng.
Với hơn 10 năm kinh nghiệm trong lĩnh vực khai thác và chế biến yến sào, chúng tôi cam kết mang đến những sản phẩm chất lượng cao, đạt tiêu chuẩn vệ sinh an toàn thực phẩm, góp phần nâng cao sức khỏe cộng đồng.',
  'assets/images/projects/logo.png',
  JSON_ARRAY('assets/images/projects/bn.png'),
  'https://happybirdnest.com/',
  3,
  1
),
(
  'ThuongLo',
  'thuong-lo',
  'Website mua bán nguồn hàng logistics Việt - Trung',
  'Thương Lộ được hình thành từ khát vọng kiến tạo một con đường giao thương minh bạch, thực tế và bền vững giữa cộng đồng kinh doanh Việt Nam với thị trường thời trang Quảng Châu — trung tâm nguồn cung thời trang lớn bậc nhất Trung Quốc.
Chúng tôi không đơn thuần xây dựng một website thông tin.
Thương Lộ hướng tới trở thành nền tảng kết nối giao thương thời trang Quảng Châu, nơi người kinh doanh có thể tiếp cận trực tiếp các nhà cung ứng, xưởng sản xuất và hệ sinh thái thương mại thực tế tại Trung Quốc một cách dễ dàng, nhanh chóng và hiệu quả hơn.',
  'assets/images/projects/tlo.png',
  JSON_ARRAY('assets/images/projects/tlop.png'),
  'https://test1.web3b.com/',
  4,
  1
),
(
  'MTechJSC',
  'mtech-jsc',
  'Công ty Cổ phần Tư vấn Kỹ thuật và Thương mại MTECH',
  'Công ty Cổ phần Tư vấn Kỹ thuật và Thương mại MTECH (thành lập từ năm 2011) là một trong những đơn vị uy tín hàng đầu tại Việt Nam, chuyên cung cấp các dịch vụ khép kín từ lập quy hoạch, khảo sát, thiết kế bản vẽ thi công, đến giám sát và quản lý dự án cho các công trình công nghiệp, dân dụng và hạ tầng kỹ thuật.',
  'assets/images/projects/mtech.png',
  JSON_ARRAY('assets/images/projects/mtep.png'),
  'https://truongvinalogistics.com.vn/',
  5,
  1
);

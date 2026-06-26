# MistySoft Landing Page

Landing page PHP MVC cho thương hiệu MistySoft — tối ưu chuyển đổi Facebook Ads, sẵn sàng mở rộng thành platform.

## Tech Stack

- PHP 8.0+ (MVC tự build)
- MySQL 5.7+
- HTML / CSS / JS (vanilla)
- Shared hosting + FTP deploy

## Cấu trúc thư mục

```
public/          → Document root (trỏ hosting vào đây)
app/             → Controllers, Models, Views, Services
core/            → Router, Database, App bootstrap
config/          → Cấu hình app, database, mail
database/        → Schema + seed data
modules/         → Mount React/NextJS sau này
storage/logs/    → Log files
```

## Cài đặt local

### 1. Clone & cấu hình

```bash
cp .env.example .env
# Chỉnh sửa .env với thông tin database, mail, Messenger/Zalo
```

### 2. Tạo database

```bash
mysql -u root -p < database/schema.sql
mysql -u root -p < database/seeds/initial_data.sql
```

### 3. Chạy dev server

```bash
cd public
php -S localhost:8000
```

Truy cập: http://localhost:8000

## Deploy lên Shared Hosting (FTP)

### Cách 1: Document root trỏ vào `public/` (khuyến nghị)

1. Upload toàn bộ project lên hosting
2. Trong cPanel → Domains → Document Root → trỏ vào thư mục `public/`
3. Import `database/schema.sql` và `database/seeds/initial_data.sql` qua phpMyAdmin
4. Tạo file `.env` trên server với thông tin DB và mail
5. Set quyền ghi: `storage/logs/`, `public/assets/uploads/` (755 hoặc 775)

### Cách 2: Deploy flat vào `public_html/`

Nếu hosting không cho đổi document root:

1. Upload nội dung thư mục `public/` vào `public_html/`
2. Upload `app/`, `core/`, `config/`, `database/`, `storage/`, `modules/` lên cùng cấp với `public_html/`
3. Sửa `public/index.php` (trong public_html): `define('BASE_PATH', dirname(dirname(__FILE__)));`
4. File `.htaccess` ở thư mục cha chặn truy cập `app/`, `core/`, `config/`

### SFTP (VS Code)

Cập nhật `.vscode/sftp.json`:

```json
{
  "name": "MistySoft Production",
  "host": "your-host.com",
  "protocol": "ftp",
  "port": 21,
  "username": "your-username",
  "password": "your-password",
  "remotePath": "/public_html",
  "uploadOnSave": false
}
```

## Routes

| Method | URL | Mô tả |
|--------|-----|-------|
| GET | `/` | Landing page |
| GET | `/projects/{slug}` | Chi tiết dự án |
| POST | `/contact` | Form liên hệ |
| GET | `/api/v1/projects` | API danh sách dự án |
| GET | `/api/v1/projects/{slug}` | API chi tiết dự án |
| POST | `/api/v1/contact` | API gửi liên hệ |

## Cấu hình .env

| Biến | Mô tả |
|------|-------|
| `APP_URL` | URL website (https://mistysoft.vn) |
| `DB_*` | Thông tin MySQL |
| `MAIL_*` | Cấu hình email |
| `MESSENGER_URL` | Link Facebook Messenger |
| `ZALO_URL` | Link Zalo |
| `FB_PIXEL_ID` | Facebook Pixel ID |

## Mở rộng sau này

- **API**: Đã có skeleton tại `/api/v1/*`
- **React Admin**: Build vào `modules/admin/dist/`, route `/admin`
- **CMS**: Thêm `AdminController` CRUD cho bảng hiện có
- **Microservices**: Tách module vào `modules/` gọi API nội bộ

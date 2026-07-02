Dưới đây là **tài liệu kiến trúc & kế hoạch triển khai hệ thống SaaS QR/NFC Review** được viết lại theo hướng rõ ràng, chuyên nghiệp, có thể dùng như tài liệu nội bộ hoặc trình bày.

---

# 1. Tổng quan hệ thống

Hệ thống được xây dựng nhằm cung cấp dịch vụ tạo mã QR/NFC giúp khách hàng của các cửa hàng (chủ quán) dễ dàng truy cập và thực hiện đánh giá (review).

Mô hình vận hành kết hợp giữa:

* **SaaS platform (dashboard + API)**
* **Dịch vụ triển khai trực tiếp (done-for-you)**

Ba nhóm người dùng chính:

* **Nhà cung cấp hệ thống (bạn)**: triển khai, cấu hình, vận hành
* **Chủ quán**: sử dụng dashboard để theo dõi
* **Khách hàng của quán**: quét QR/NFC để thực hiện review

---

# 2. Kiến trúc domain

Hệ thống được tách thành các subdomain với vai trò rõ ràng:

| Subdomain             | Vai trò                            |
| --------------------- | ----------------------------------- |
| api.mistydev.id.vn    | Backend xử lý logic và dữ liệu |
| go.mistydev.id.vn     | Redirect service (runtime)          |
| app.mistydev.id.vn    | Dashboard quản lý                 |
| review.mistydev.id.vn | Landing page (marketing)            |

Nguyên tắc thiết kế:

* Mỗi subdomain chỉ đảm nhiệm một vai trò
* Không trộn logic runtime và giao diện
* API là trung tâm duy nhất xử lý dữ liệu

---

# 3. Luồng hoạt động hệ thống

## 3.1 Giai đoạn triển khai dịch vụ

1. Hệ thống được xây dựng và triển khai bởi bạn
2. Bạn tiếp thị dịch vụ tới chủ quán
3. Chủ quán đồng ý sử dụng
4. Bạn thực hiện:

   * Tạo link review
   * Sinh mã định danh (code)
   * Tạo QR/NFC tương ứng
5. QR/NFC được bàn giao và gắn tại địa điểm kinh doanh

---

## 3.2 Giai đoạn vận hành

1. Khách hàng quét QR/NFC
2. Trình duyệt truy cập:

   ```
   go.mistydev.id.vn/r/{code}
   ```
3. Hệ thống:

   * Gọi API để resolve code
   * Lấy URL đích (Google Review hoặc trang trung gian)
4. Thực hiện redirect (HTTP 302)
5. Đồng thời ghi nhận lượt truy cập (tracking)

---

## 3.3 Giai đoạn theo dõi

1. Chủ quán truy cập dashboard:

   ```
   app.mistydev.id.vn
   ```
2. Hệ thống hiển thị:

   * Số lượt quét
   * Thống kê theo thời gian
   * Danh sách link

---

# 4. Kế hoạch triển khai theo giai đoạn

## 4.1 Giai đoạn 1 – Core Runtime (ưu tiên cao nhất)

### Subdomain: go.mistydev.id.vn

**Mục tiêu**

* Xử lý redirect nhanh và ổn định
* Là điểm truy cập trực tiếp của khách hàng

**Chức năng**

* Nhận request `/r/{code}`
* Gọi API để resolve
* Redirect tới URL đích

**Yêu cầu**

* Thời gian phản hồi thấp
* Không render giao diện
* Không chứa logic phức tạp

**Công nghệ đề xuất**

* PHP thuần (phù hợp với InfinityFree)
* Không sử dụng framework nặng

---

## 4.2 Giai đoạn 2 – Backend API

### Subdomain: api.mistydev.id.vn

**Mục tiêu**

* Là trung tâm xử lý toàn bộ hệ thống

**Chức năng chính**

* Tạo link
* Resolve code
* Tracking lượt quét
* Cung cấp dữ liệu thống kê

**API tối thiểu (MVP)**

| Method | Endpoint     | Mô tả                |
| ------ | ------------ | ---------------------- |
| POST   | /create-link | Tạo link mới         |
| GET    | /resolve     | Lấy URL từ code      |
| POST   | /track-scan  | Ghi nhận lượt quét |
| GET    | /stats       | Lấy thống kê        |

**Cơ sở dữ liệu (đề xuất)**

* shops
* links
* scans

**Công nghệ**

* Node.js (Express hoặc Fastify)
* MySQL (do hosting hỗ trợ)

---

## 4.3 Giai đoạn 3 – Dashboard

### Subdomain: app.mistydev.id.vn

**Mục tiêu**

* Công cụ quản lý cho bạn và chủ quán

**Chức năng MVP**

* Tạo link
* Xem danh sách link
* Xem số lượt quét

**Giai đoạn đầu**

* Có thể chỉ phục vụ bạn (admin)
* Chưa cần hệ thống phân quyền phức tạp

**Công nghệ**

* HTML + JavaScript (đơn giản)
* Hoặc React (nếu cần mở rộng)

---

## 4.4 Giai đoạn 4 – Landing page

### Subdomain: review.mistydev.id.vn

**Mục tiêu**

* Tiếp thị và chuyển đổi khách hàng

**Nội dung**

* Giới thiệu dịch vụ
* Mô tả lợi ích
* Demo
* Form liên hệ

**Công nghệ**

* Website tĩnh (HTML/CSS)
* Có thể nâng cấp sau

---

# 5. Kiến trúc dữ liệu cơ bản

## Bảng shops

* id
* name

## Bảng links

* id
* shop_id
* code
* target_url

## Bảng scans

* id
* link_id
* timestamp
* ip_address
* user_agent

---

# 6. Nguyên tắc thiết kế quan trọng

1. **Tách biệt trách nhiệm**

   * go: runtime
   * api: xử lý
   * app: giao diện
   * review: marketing
2. **Ưu tiên hiệu năng cho redirect**

   * không xử lý logic tại go
   * mọi dữ liệu lấy từ API
3. **Triển khai theo MVP**

   * tập trung vào luồng chính:

     ```
     tạo link → quét → redirect → tracking
     ```
   * tránh xây dựng sớm các tính năng phức tạp
4. **Khả năng mở rộng**

   * dễ thêm SaaS khác sau này
   * dễ chuyển API sang hạ tầng mạnh hơn

---

# 7. Lộ trình phát triển đề xuất

| Thời gian | Công việc                                               |
| ---------- | --------------------------------------------------------- |
| Ngày 1–2 | Xây dựng API + go                                       |
| Ngày 3    | Xây dựng dashboard cơ bản                             |
| Ngày 4    | Kiểm thử toàn bộ flow                                 |
| Ngày 5    | Hoàn thiện landing và bắt đầu triển khai thực tế |

---

# 8. Định hướng mở rộng

Trong giai đoạn tiếp theo, hệ thống có thể bổ sung:

* Xác thực người dùng (authentication)
* Multi-tenant (mỗi quán một workspace)
* Thống kê nâng cao (theo thiết bị, địa lý)
* Hệ thống thanh toán (subscription)
* Tối ưu redirect (cache, CDN)

---

Tài liệu này đủ để bạn:

* triển khai hệ thống từ đầu
* hoặc đưa cho người khác (dev khác) đọc và hiểu ngay kiến trúc

Nếu cần, có thể viết tiếp:

* tài liệu API chi tiết (request/response)
* hoặc thiết kế database nâng cao cho multi-tenant và billing

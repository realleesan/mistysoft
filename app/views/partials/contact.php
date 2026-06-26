<?php
$contactSection = $content['contact']['content'] ?? [];
$success = flash('success');
$error = flash('error');
?>

<section class="section section--contact" id="contact" style="background-image: url('<?= asset('assets/images/resources/contact.png') ?>');">
  <div class="container">
    <div class="contact__grid">
      <div class="contact__spacer"></div>

      <div class="contact__form-wrap">
        <h2 class="contact__title" style="text-align: center;">LIÊN HỆ VỚI CHÚNG TÔI</h2>

        <?php if ($success): ?>
          <div class="alert alert--success" role="alert"><?= e($success) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
          <div class="alert alert--error" role="alert"><?= e($error) ?></div>
        <?php endif; ?>

        <form class="contact__form" id="contactForm" action="<?= url('/contact') ?>" method="POST" enctype="multipart/form-data" novalidate>
          <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
          <input type="hidden" name="source" value="<?= e($_SESSION['utm_source'] ?? 'landing') ?>">

          <!-- Form 1: Basic Info -->
          <div class="form-question form-question--active" data-question="1">
            <div class="form-group">
              <label for="name">Họ tên <span class="required">*</span></label>
              <input type="text" id="name" name="name" required minlength="2" placeholder="Nguyễn Văn A">
            </div>
            <div class="form-group">
              <label for="phone">Số điện thoại <span class="required">*</span></label>
              <input type="tel" id="phone" name="phone" required pattern="[0-9+\-\s]{8,15}" placeholder="0901234567">
            </div>
            <div class="form-group">
              <label for="email">Email <span class="required">*</span></label>
              <input type="email" id="email" name="email" required placeholder="email@example.com">
            </div>
            <div class="form-group">
              <label for="package">Chọn gói <span class="required">*</span></label>
              <select id="package" name="package" required>
                <option value="">-- Chọn gói dịch vụ --</option>
                <option value="basic">Gói Cơ bản</option>
                <option value="standard">Gói Tiêu chuẩn</option>
                <option value="premium">Gói Nâng cao</option>
                <option value="custom">Gói Tùy chỉnh</option>
              </select>
            </div>
            <div class="form-navigation">
              <button type="button" class="btn btn--primary btn--lg btn--block form-next-btn">Tiếp tục</button>
            </div>
          </div>

          <!-- Form 2: Hosting -->
          <div class="form-question" data-question="2">
            <div class="form-group">
              <label>Bạn đã có miền và hosting chưa? <span class="required">*</span></label>
              <div class="radio-group">
                <label class="radio-label">
                  <input type="radio" name="hosting" value="yes" required>
                  <span>Có rồi</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="hosting" value="no">
                  <span>Chưa có</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="hosting" value="need_help">
                  <span>Cần tư vấn</span>
                </label>
              </div>
            </div>
            <div class="form-navigation">
              <button type="button" class="btn btn--outline form-prev-btn">Quay lại</button>
              <button type="button" class="btn btn--primary form-next-btn">Tiếp tục</button>
            </div>
          </div>

          <!-- Form 3: Website Type -->
          <div class="form-question" data-question="3">
            <div class="form-group">
              <label>Loại website bạn cần? <span class="required">*</span></label>
              <div class="radio-group">
                <label class="radio-label">
                  <input type="radio" name="website_type" value="landing" required>
                  <span>Landing page</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="website_type" value="corporate">
                  <span>Website công ty</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="website_type" value="ecommerce">
                  <span>Website bán hàng</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="website_type" value="blog">
                  <span>Blog/Tin tức</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="website_type" value="other">
                  <span>Khác</span>
                </label>
              </div>
              <div class="conditional-field" id="website_type_other_field" style="display: none;">
                <input type="text" name="website_type_other" placeholder="Vui lòng cụ thể loại website">
              </div>
            </div>
            <div class="form-navigation">
              <button type="button" class="btn btn--outline form-prev-btn">Quay lại</button>
              <button type="button" class="btn btn--primary form-next-btn">Tiếp tục</button>
            </div>
          </div>

          <!-- Form 4: Industry -->
          <div class="form-question" data-question="4">
            <div class="form-group">
              <label>Lĩnh vực hoạt động của bạn? <span class="required">*</span></label>
              <div class="radio-group">
                <label class="radio-label">
                  <input type="radio" name="industry" value="education" required>
                  <span>Giáo dục</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="industry" value="healthcare">
                  <span>Y tế/Sức khỏe</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="industry" value="retail">
                  <span>Bán lẻ</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="industry" value="technology">
                  <span>Công nghệ</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="industry" value="services">
                  <span>Dịch vụ</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="industry" value="other">
                  <span>Khác</span>
                </label>
              </div>
              <div class="conditional-field" id="industry_other_field" style="display: none;">
                <input type="text" name="industry_other" placeholder="Vui lòng cụ thể lĩnh vực">
              </div>
            </div>
            <div class="form-navigation">
              <button type="button" class="btn btn--outline form-prev-btn">Quay lại</button>
              <button type="button" class="btn btn--primary form-next-btn">Tiếp tục</button>
            </div>
          </div>

          <!-- Form 5: Purpose -->
          <div class="form-question" data-question="5">
            <div class="form-group">
              <label>Mục đích chính của website? <span class="required">*</span></label>
              <div class="radio-group">
                <label class="radio-label">
                  <input type="radio" name="purpose" value="branding" required>
                  <span>Xây dựng thương hiệu</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="purpose" value="sales">
                  <span>Bán hàng trực tuyến</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="purpose" value="information">
                  <span>Cung cấp thông tin</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="purpose" value="booking">
                  <span>Đặt lịch/hẹn</span>
                </label>
                <label class="radio-label">
                  <input type="radio" name="purpose" value="other">
                  <span>Khác</span>
                </label>
              </div>
              <div class="conditional-field" id="purpose_other_field" style="display: none;">
                <input type="text" name="purpose_other" placeholder="Vui lòng cụ thể mục đích">
              </div>
            </div>
            <div class="form-navigation">
              <button type="button" class="btn btn--outline form-prev-btn">Quay lại</button>
              <button type="button" class="btn btn--primary form-next-btn">Tiếp tục</button>
            </div>
          </div>

          <!-- Form 6: Content -->
          <div class="form-question" data-question="6">
            <div class="form-group">
              <label for="message">Nội dung chi tiết</label>
              <textarea id="message" name="message" rows="6" placeholder="Mô tả chi tiết nhu cầu website của bạn..."></textarea>
            </div>
            <div class="form-group">
              <label>Hoặc tải file tài liệu (DOCX, PDF, MD, XLSX)</label>
              <input type="file" id="attachment" name="attachment" accept=".docx,.pdf,.md,.xlsx" class="form-file">
              <small class="form-help">Chấp nhận file: .docx, .pdf, .md, .xlsx (Tối đa 10MB)</small>
            </div>
            <div class="form-navigation">
              <button type="button" class="btn btn--outline form-prev-btn">Quay lại</button>
              <button type="submit" class="btn btn--primary">Gửi yêu cầu tư vấn</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

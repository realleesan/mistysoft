<section class="hero hero--ecosystem" style="background-image: url('<?= asset('assets/images/resources/ecosystem/hero.png') ?>');">
  <div class="container hero__inner">
    <div class="hero__content">
      <h1 class="hero__title">Digital Solutions for Your Business</h1>
      <p class="hero__subtitle">Website, App, Tool, SaaS - Mọi thứ bạn cần để digital hóa doanh nghiệp</p>
      <div class="hero__actions">
        <a href="<?= url('/coming-soon') ?>" class="btn btn--primary btn--lg">Khám phá dịch vụ</a>
        <a href="<?= url('/projects') ?>" class="btn btn--outline btn--lg">Xem dự án</a>
      </div>
    </div>
  </div>
</section>

<section class="section section--services">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title">DỊCH VỤ CỦA CHÚNG TÔI</h2>
      
    </div>
    <div class="services-grid">
      <div class="service-card">
        <div class="service-card__icon">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2"/>
            <path d="M3 9h18"/>
            <path d="M9 21V9"/>
          </svg>
        </div>
        <h3 class="service-card__title">Web Development</h3>
        <p class="service-card__description">Thiết kế website chuyên nghiệp, responsive, tối ưu SEO cho mọi loại hình doanh nghiệp</p>
        <a href="<?= url('/coming-soon') ?>" class="service-card__link">Tìm hiểu thêm →</a>
      </div>
      <div class="service-card">
        <div class="service-card__icon">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="5" y="2" width="14" height="20" rx="2"/>
            <path d="M12 18h.01"/>
          </svg>
        </div>
        <h3 class="service-card__title">App Development</h3>
        <p class="service-card__description">Phát triển ứng dụng mobile và desktop theo yêu cầu, trải nghiệm người dùng tối ưu</p>
        <a href="<?= url('/coming-soon') ?>" class="service-card__link">Tìm hiểu thêm →</a>
      </div>
      <div class="service-card">
        <div class="service-card__icon">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
          </svg>
        </div>
        <h3 class="service-card__title">SaaS Products</h3>
        <p class="service-card__description">Sản phẩm SaaS sẵn dùng, giải pháp nhanh chóng và hiệu quả cho doanh nghiệp</p>
        <a href="https://saas.mistysoft.com" target="_blank" rel="noopener" class="service-card__link">Khám phá SaaS →</a>
      </div>
      <div class="service-card">
        <div class="service-card__icon">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 6h18"/>
            <path d="M3 12h18"/>
            <path d="M3 18h18"/>
          </svg>
        </div>
        <h3 class="service-card__title">Website Rental</h3>
        <p class="service-card__description">Thuê website có sẵn hoặc build từ đầu, giải pháp linh hoạt cho mọi ngân sách</p>
        <a href="<?= url('/coming-soon') ?>" class="service-card__link">Tìm hiểu thêm →</a>
      </div>
    </div>

    <!-- Additional Services (hidden by default) -->
    <div class="services-grid services-grid--hidden" id="servicesAdditional">
      <div class="service-card">
        <div class="service-card__icon">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
          </svg>
        </div>
        <h3 class="service-card__title">Tool Development</h3>
        <p class="service-card__description">Phát triển công cụ tự động hóa, tiện ích theo yêu cầu để tối ưu quy trình làm việc</p>
        <a href="<?= url('/coming-soon') ?>" class="service-card__link">Tìm hiểu thêm →</a>
      </div>
      <div class="service-card">
        <div class="service-card__icon">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
            <line x1="8" y1="21" x2="16" y2="21"/>
            <line x1="12" y1="17" x2="12" y2="21"/>
          </svg>
        </div>
        <h3 class="service-card__title">Software Development</h3>
        <p class="service-card__description">Phát triển phần mềm quản lý, hệ thống doanh nghiệp theo yêu cầu chuyên sâu</p>
        <a href="<?= url('/coming-soon') ?>" class="service-card__link">Tìm hiểu thêm →</a>
      </div>
      <div class="service-card">
        <div class="service-card__icon">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <h3 class="service-card__title">Bảo trì Website</h3>
        <p class="service-card__description">Dịch vụ bảo trì, cập nhật, bảo mật website định kỳ để đảm bảo hoạt động ổn định</p>
        <a href="<?= url('/coming-soon') ?>" class="service-card__link">Tìm hiểu thêm →</a>
      </div>
      <div class="service-card">
        <div class="service-card__icon">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
          </svg>
        </div>
        <h3 class="service-card__title">Thiết kế lại Website</h3>
        <p class="service-card__description">Redesign website hiện tại với giao diện hiện đại, tối ưu trải nghiệm người dùng</p>
        <a href="<?= url('/coming-soon') ?>" class="service-card__link">Tìm hiểu thêm →</a>
      </div>
      <div class="service-card">
        <div class="service-card__icon">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
        </div>
        <h3 class="service-card__title">SEO Website</h3>
        <p class="service-card__description">Tối ưu hóa công cụ tìm kiếm, tăng thứ hạng website trên Google để thu hút khách hàng</p>
        <a href="<?= url('/coming-soon') ?>" class="service-card__link">Tìm hiểu thêm →</a>
      </div>
      <div class="service-card">
        <div class="service-card__icon">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
          </svg>
        </div>
        <h3 class="service-card__title">Đăng ký Bộ Công Thương</h3>
        <p class="service-card__description">Hỗ trợ đăng ký website với Bộ Công Thương, đảm bảo pháp lý cho website thương mại</p>
        <a href="<?= url('/coming-soon') ?>" class="service-card__link">Tìm hiểu thêm →</a>
      </div>
      <div class="service-card">
        <div class="service-card__icon">
          <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <path d="M2 12h20"/>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
          </svg>
        </div>
        <h3 class="service-card__title">Domain & Hosting</h3>
        <p class="service-card__description">Cung cấp dịch vụ đăng ký tên miền, hosting, SSL certificate với giá cạnh tranh</p>
        <a href="<?= url('/check-domain') ?>" class="service-card__link">Kiểm tra tên miền →</a>
      </div>
    </div>

    <!-- Toggle Button -->
    <div class="services-toggle">
      <button class="services-toggle-btn" id="toggleServices" aria-label="Xem thêm dịch vụ">
        <svg class="chevron" viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
      </button>
    </div>
  </div>
</section>

<section class="section section--industries">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title">GIẢI PHÁP THEO NGÀNH NGHỀ</h2>
    </div>

    <div class="industries-slider">
      <div class="industries-slider__track" id="industriesTrack">
        <!-- Slide 1 -->
        <div class="industries-slide">
          <div class="industries-grid-2x2">
            <a href="<?= url('/coming-soon') ?>" class="industry-item">
              <div class="industry-item__image" style="background-image: url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=800&q=80');"></div>
              <div class="industry-item__content">
                <h3 class="industry-item__name">Logistics</h3>
                <span class="industry-item__link">Tìm hiểu thêm →</span>
              </div>
            </a>
            <a href="<?= url('/coming-soon') ?>" class="industry-item">
              <div class="industry-item__image" style="background-image: url('https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800&q=80');"></div>
              <div class="industry-item__content">
                <h3 class="industry-item__name">Spa & Beauty</h3>
                <span class="industry-item__link">Tìm hiểu thêm →</span>
              </div>
            </a>
            <a href="<?= url('/coming-soon') ?>" class="industry-item">
              <div class="industry-item__image" style="background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&q=80');"></div>
              <div class="industry-item__content">
                <h3 class="industry-item__name">Nhà hàng</h3>
                <span class="industry-item__link">Tìm hiểu thêm →</span>
              </div>
            </a>
            <a href="<?= url('/coming-soon') ?>" class="industry-item">
              <div class="industry-item__image" style="background-image: url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=800&q=80');"></div>
              <div class="industry-item__content">
                <h3 class="industry-item__name">E-commerce</h3>
                <span class="industry-item__link">Tìm hiểu thêm →</span>
              </div>
            </a>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="industries-slide">
          <div class="industries-grid-2x2">
            <a href="<?= url('/coming-soon') ?>" class="industry-item">
              <div class="industry-item__image" style="background-image: url('https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&q=80');"></div>
              <div class="industry-item__content">
                <h3 class="industry-item__name">Giáo dục</h3>
                <span class="industry-item__link">Tìm hiểu thêm →</span>
              </div>
            </a>
            <a href="<?= url('/coming-soon') ?>" class="industry-item">
              <div class="industry-item__image" style="background-image: url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800&q=80');"></div>
              <div class="industry-item__content">
                <h3 class="industry-item__name">Y tế</h3>
                <span class="industry-item__link">Tìm hiểu thêm →</span>
              </div>
            </a>
            <a href="<?= url('/coming-soon') ?>" class="industry-item">
              <div class="industry-item__image" style="background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&q=80');"></div>
              <div class="industry-item__content">
                <h3 class="industry-item__name">Bất động sản</h3>
                <span class="industry-item__link">Tìm hiểu thêm →</span>
              </div>
            </a>
            <a href="<?= url('/coming-soon') ?>" class="industry-item">
              <div class="industry-item__image" style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&q=80');"></div>
              <div class="industry-item__content">
                <h3 class="industry-item__name">Tài chính</h3>
                <span class="industry-item__link">Tìm hiểu thêm →</span>
              </div>
            </a>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="industries-pagination" id="industriesPagination">
        <button class="industries-pagination__bullet industries-pagination__bullet--active" data-slide="0" aria-label="Slide 1"></button>
        <button class="industries-pagination__bullet" data-slide="1" aria-label="Slide 2"></button>
      </div>
    </div>
  </div>
</section>

<section class="section section--featured" style="background-image: url('<?= asset('assets/images/resources/ecosystem/form.png') ?>');">
  <div class="container">
    <div class="featured-saas">
      <div class="featured-saas__content">
        <span class="featured-saas__badge">Featured Product</span>
        <h2 class="featured-saas__title">Google Form Tool</h2>
        <p class="featured-saas__description">Tạo form chuyên nghiệp, thu thập dữ liệu hiệu quả, tích hợp với Google Sheets. Giải pháp hoàn hảo cho khảo sát, đăng ký, feedback.</p>
        <ul class="featured-saas__features">
          <li>✓ Drag & drop builder</li>
          <li>✓ Real-time analytics</li>
          <li>✓ Custom branding</li>
          <li>✓ Free tier available</li>
        </ul>
        <div class="featured-saas__actions">
          <a href="https://saas.mistysoft.com" target="_blank" rel="noopener" class="btn btn--primary btn--lg">Try Free</a>
          <a href="<?= url('/coming-soon') ?>" class="btn btn--outline btn--lg">Learn More</a>
        </div>
      </div>
      
    </div>
  </div>
</section>

<section class="section section--why-us">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title">Tại sao chọn MistySoft?</h2>
      <p class="section__description">Chúng tôi không chỉ làm sản phẩm, chúng tôi tạo giải pháp</p>
    </div>
    <div class="benefits-grid">
      <div class="benefit-card">
        <div class="benefit-card__icon">
          <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
          </svg>
        </div>
        <h3 class="benefit-card__title">Kinh nghiệm sâu rộng</h3>
        <p class="benefit-card__description">Nhiều năm kinh nghiệm trong digital solutions, phục vụ hàng trăm khách hàng</p>
      </div>
      <div class="benefit-card">
        <div class="benefit-card__icon">
          <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <h3 class="benefit-card__title">Quy trình chuyên nghiệp</h3>
        <p class="benefit-card__description">Tư vấn, thiết kế, phát triển, bảo trì - quy trình chuẩn hóa, minh bạch</p>
      </div>
      <div class="benefit-card">
        <div class="benefit-card__icon">
          <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
            <path d="M22 4L12 14.01l-3-3"/>
          </svg>
        </div>
        <h3 class="benefit-card__title">Hỗ trợ tận tâm</h3>
        <p class="benefit-card__description">Đội ngũ support chuyên nghiệp, sẵn sàng hỗ trợ 24/7 qua nhiều kênh</p>
      </div>
      <div class="benefit-card">
        <div class="benefit-card__icon">
          <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
          </svg>
        </div>
        <h3 class="benefit-card__title">Giá cả hợp lý</h3>
        <p class="benefit-card__description">Giá cả cạnh tranh, hỗ trợ trả góp, nhiều gói linh hoạt cho mọi ngân sách</p>
      </div>
    </div>
  </div>
</section>

<section class="section section--cta">
  <div class="container">
    <div class="cta-section">
      <h2 class="cta-section__title">Sẵn sàng digital hóa doanh nghiệp của bạn?</h2>
      <p class="cta-section__subtitle">Liên hệ ngay để nhận tư vấn miễn phí từ đội ngũ chuyên gia của chúng tôi</p>
      <div class="cta-section__actions">
        <a href="<?= url('/contact') ?>" class="btn btn--primary btn--lg">Nhận tư vấn miễn phí</a>
        <a href="<?= e(config('app.messenger_url')) ?>" target="_blank" rel="noopener" class="btn btn--messenger btn--lg">Chat Messenger</a>
      </div>
    </div>
  </div>
</section>

<script>
document.getElementById('toggleServices').addEventListener('click', function() {
  const additionalSection = document.getElementById('servicesAdditional');
  const chevron = this.querySelector('.chevron');
  const isHidden = additionalSection.style.display === 'none' || additionalSection.style.display === '';

  if (isHidden) {
    additionalSection.style.display = 'grid';
    chevron.style.transform = 'rotate(180deg)';
  } else {
    additionalSection.style.display = 'none';
    chevron.style.transform = 'rotate(0deg)';
  }
});

// Hide additional services by default
document.getElementById('servicesAdditional').style.display = 'none';

// Industries Slider
const industriesTrack = document.getElementById('industriesTrack');
const industriesPagination = document.getElementById('industriesPagination');
const bullets = industriesPagination.querySelectorAll('.industries-pagination__bullet');
let currentSlide = 0;
let autoSlideInterval;

function goToSlide(index) {
  currentSlide = index;
  industriesTrack.style.transform = `translateX(-${index * 100}%)`;
  
  bullets.forEach((bullet, i) => {
    if (i === index) {
      bullet.classList.add('industries-pagination__bullet--active');
    } else {
      bullet.classList.remove('industries-pagination__bullet--active');
    }
  });
}

function nextSlide() {
  const nextIndex = (currentSlide + 1) % bullets.length;
  goToSlide(nextIndex);
}

function startAutoSlide() {
  autoSlideInterval = setInterval(nextSlide, 3000);
}

function stopAutoSlide() {
  clearInterval(autoSlideInterval);
}

// Bullet click handlers
bullets.forEach((bullet, index) => {
  bullet.addEventListener('click', () => {
    stopAutoSlide();
    goToSlide(index);
    startAutoSlide();
  });
});

// Start auto-slide
startAutoSlide();

// Pause on hover
industriesTrack.addEventListener('mouseenter', stopAutoSlide);
industriesTrack.addEventListener('mouseleave', startAutoSlide);
</script>

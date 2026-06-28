<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($title ?? 'MistySoft') ?></title>
  <meta name="description" content="<?= e($description ?? 'MistySoft - Thiết kế website chuyên nghiệp') ?>">
  <link rel="canonical" href="<?= e(url($_SERVER['REQUEST_URI'] ?? '/')) ?>">

  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= e($title ?? 'MistySoft') ?>">
  <meta property="og:description" content="<?= e($description ?? '') ?>">
  <meta property="og:url" content="<?= e(url($_SERVER['REQUEST_URI'] ?? '/')) ?>">
  <meta property="og:site_name" content="MistySoft">
  <meta property="og:locale" content="vi_VN">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= e($title ?? 'MistySoft') ?>">
  <meta name="twitter:description" content="<?= e($description ?? '') ?>">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= asset('/css/main.css') ?>">
  <link rel="icon" type="image/svg+xml" href="<?= asset('/assets/images/resources/favicon.svg') ?>">
</head>
<body>
  <header class="header" id="header">
    <div class="container header__inner">
      <a href="<?= url('/') ?>" class="logo">
        <img src="<?= asset('/assets/images/resources/logo_1_.svg') ?>" alt="MistySoft" width="140" height="36">
        <div class="logo__text">
          <span class="logo__name">MISTYSOFT</span>
          <span class="logo__tagline">SMART SYSTEMS - SEAMLESS SOLUTIONS</span>
        </div>
      </a>
      <nav class="nav" id="nav">
        <a href="<?= url('/') ?>" class="nav__link">Trang chủ</a>

        <div class="nav__dropdown">
          <a href="<?= url('/coming-soon') ?>" class="nav__link nav__link--dropdown">
            Dịch vụ
            <svg class="nav__arrow" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M6 9l6 6 6-6"/>
            </svg>
          </a>
          <div class="nav__mega-menu">
            <div class="nav__mega-column">
              <h4 class="nav__mega-heading">Custom Development</h4>
              <ul class="nav__mega-list">
                <li><a href="<?= url('/coming-soon') ?>">Thiết kế Website</a></li>
                <li><a href="<?= url('/coming-soon') ?>">Thiết kế App</a></li>
                <li><a href="<?= url('/coming-soon') ?>">Thiết kế Tool</a></li>
                <li><a href="<?= url('/coming-soon') ?>">Thiết kế Phần mềm</a></li>
              </ul>
            </div>
            <div class="nav__mega-column">
              <h4 class="nav__mega-heading">Dịch vụ khác</h4>
              <ul class="nav__mega-list">
                <li><a href="<?= url('/coming-soon') ?>">Thuê Website</a></li>
                <li><a href="<?= url('/coming-soon') ?>">Bảo trì & SEO</a></li>
                <li><a href="<?= url('/coming-soon') ?>">Domain & Hosting</a></li>
                <li><a href="<?= url('/check-domain') ?>">Kiểm tra tên miền</a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="nav__dropdown">
          <a href="<?= url('/coming-soon') ?>" class="nav__link nav__link--dropdown">
            SaaS
            <svg class="nav__arrow" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M6 9l6 6 6-6"/>
            </svg>
          </a>
          <div class="nav__dropdown-menu">
            <a href="<?= url('/coming-soon') ?>">Tất cả SaaS</a>
            <a href="https://saas.mistysoft.com" target="_blank" rel="noopener">Google Form Tool ↗</a>
          </div>
        </div>

        <a href="<?= url('/projects') ?>" class="nav__link">Dự án</a>
        <a href="<?= url('/contact') ?>" class="nav__link nav__link--cta">Liên hệ</a>
      </nav>
      <button class="nav-toggle" id="navToggle" aria-label="Mở menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>

  <main>
    <?= $content ?>
  </main>

  <footer class="footer">
    <div class="container">
      <div class="footer__inner">
        <div class="footer__brand">
          <div class="footer__logo-wrap">
            <img src="<?= asset('/assets/images/resources/logo_1_.svg') ?>" alt="MistySoft" width="160" height="40">
            <div class="footer__logo-text">
              <span class="footer__logo-name">MISTYSOFT</span>
              <span class="footer__logo-tagline">SMART SYSTEMS - SEAMLESS SOLUTIONS</span>
            </div>
          </div>
          <div class="footer__contact">
            <p><strong>Hotline:</strong> <?= e(config('app.zalo_phone') ?? '0901234567') ?></p>
            <p><strong>Email:</strong> realleesan@gmail.com</p>
            <p><strong>Địa chỉ:</strong> Phú Diễn, Hà Nội, Việt Nam</p>
          </div>
          <div class="footer__social">
            <a href="<?= e(config('app.messenger_url')) ?>" target="_blank" rel="noopener" aria-label="Messenger" class="footer__social-icon footer__social-icon--messenger">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="#fff"><path d="M12 2C6.48 2 2 6.48 2 12c0 2.04.54 3.93 1.48 5.59L2 22l4.54-1.36A9.95 9.95 0 0012 22c5.52 0 10-4.48 10-10S17.52 2 12 2zm0 18c-1.85 0-3.55-.63-4.9-1.69l-.35-.27-3.62 1.09 1.09-3.52-.28-.35A7.95 7.95 0 014 12c0-4.41 3.59-8 8-8s8 3.59 8 8-3.59 8-8 8z"/></svg>
            </a>
            <a href="<?= e(config('app.zalo_url')) ?>" target="_blank" rel="noopener" aria-label="Zalo" class="footer__social-icon footer__social-icon--zalo">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="#fff"><path d="M12 2C6.48 2 2 6.25 2 11.5c0 2.89 1.45 5.46 3.72 7.13L5 22l3.78-1.96C9.73 20.65 10.84 21 12 21c5.52 0 10-4.25 10-9.5S17.52 2 12 2z"/></svg>
            </a>
            <a href="https://facebook.com/mistysoft" target="_blank" rel="noopener" aria-label="Facebook" class="footer__social-icon footer__social-icon--facebook">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="#fff"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
          </div>
        </div>
        <div class="footer__links">
          <h4 class="footer__heading">Dịch vụ</h4>
          <ul class="footer__list">
            <li><a href="<?= url('/coming-soon') ?>">Thiết kế Website</a></li>
            <li><a href="<?= url('/coming-soon') ?>">Thiết kế App</a></li>
            <li><a href="<?= url('/coming-soon') ?>">Thiết kế Tool</a></li>
            <li><a href="<?= url('/coming-soon') ?>">Thuê Website</a></li>
            <li><a href="<?= url('/coming-soon') ?>">Bảo trì & SEO</a></li>
          </ul>
        </div>
        <div class="footer__links">
          <h4 class="footer__heading">SaaS & Products</h4>
          <ul class="footer__list">
            <li><a href="https://saas.mistysoft.com" target="_blank" rel="noopener">Google Form Tool ↗</a></li>
            <li><a href="<?= url('/coming-soon') ?>">Cửa hàng số</a></li>
            <li><a href="<?= url('/coming-soon') ?>">App Showcase</a></li>
          </ul>
        </div>
        <div class="footer__links">
          <h4 class="footer__heading">Thông tin</h4>
          <ul class="footer__list">
            <li><a href="<?= url('/projects') ?>">Dự án</a></li>
            <li><a href="<?= url('/coming-soon') ?>">Ngành nghề</a></li>
            <li><a href="<?= url('/coming-soon') ?>">Blog</a></li>
            <li><a href="<?= url('/coming-soon') ?>">Về chúng tôi</a></li>
            <li><a href="<?= url('/contact') ?>">Liên hệ</a></li>
          </ul>
        </div>
      </div>
      <div class="footer__bottom">
        <p class="footer__copy">&copy; <?= date('Y') ?> MistySoft. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <a href="<?= e(config('app.zalo_url')) ?>" class="float-btn float-btn--zalo" target="_blank" rel="noopener" aria-label="Chat Zalo">
    <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C6.48 2 2 6.25 2 11.5c0 2.89 1.45 5.46 3.72 7.13L5 22l3.78-1.96C9.73 20.65 10.84 21 12 21c5.52 0 10-4.25 10-9.5S17.52 2 12 2z"/></svg>
  </a>

  <script>
    window.MISTY_CONFIG = {
      fbPixelId: <?= json_encode(config('app.fb_pixel_id', '')) ?>,
      baseUrl: <?= json_encode(url('/')) ?>
    };
  </script>
  <script src="<?= asset('/js/main.js') ?>" defer></script>
  <script src="<?= asset('/js/tracking.js') ?>" defer></script>
</body>
</html>

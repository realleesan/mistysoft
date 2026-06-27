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
        <a href="<?= url('/#problems') ?>" class="nav__link">Vấn đề</a>
        <a href="<?= url('/#solutions') ?>" class="nav__link">Giải pháp</a>
        <a href="<?= url('/#portfolio') ?>" class="nav__link">Dự án</a>
        <a href="<?= url('/#pricing') ?>" class="nav__link">Bảng giá</a>
        <a href="<?= url('/check-domain') ?>" class="nav__link">Kiểm tra tên miền</a>
        <a href="<?= url('/#contact') ?>" class="nav__link nav__link--cta">Liên hệ</a>
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
        </div>
        <div class="footer__links">
          <h4 class="footer__heading">Liên kết nhanh</h4>
          <ul class="footer__list">
            <li><a href="#hero">Trang chủ</a></li>
            <li><a href="#services">Dịch vụ</a></li>
            <li><a href="#portfolio">Dự án</a></li>
            <li><a href="#pricing">Bảng giá</a></li>
            <li><a href="<?= url('/check-domain') ?>">Kiểm tra tên miền</a></li>
            <li><a href="#contact">Liên hệ</a></li>
          </ul>
        </div>
        <div class="footer__links">
          <h4 class="footer__heading">Kết nối</h4>
          <ul class="footer__list">
            <li><a href="<?= e(config('app.messenger_url')) ?>" target="_blank" rel="noopener">Messenger</a></li>
            <li><a href="<?= e(config('app.zalo_url')) ?>" target="_blank" rel="noopener">Zalo</a></li>
            <li><a href="https://facebook.com/mistysoft" target="_blank" rel="noopener">Facebook</a></li>
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

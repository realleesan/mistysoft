<?php
$hero = $content['hero']['content'] ?? [];
?>

<section class="hero" id="hero" style="background-image: url('<?= asset('assets/images/resources/hero.png') ?>');">
  <div class="hero__overlay"></div>
  <div class="container hero__inner">
    <div class="hero__content">
      <h1 class="hero__title"><?= e($hero['headline'] ?? 'Thiết kế website chuyên nghiệp') ?></h1>
      <p class="hero__subtitle"><?= e($hero['subheadline'] ?? '') ?></p>
      <div class="hero__actions">
        <a href="#contact" class="btn btn--primary btn--lg"><?= e($hero['cta_text'] ?? 'Liên hệ ngay') ?></a>
        <a href="#pricing" class="btn btn--outline btn--lg"><?= e($hero['cta_secondary'] ?? 'Xem bảng giá') ?></a>
      </div>
    </div>
  </div>
</section>

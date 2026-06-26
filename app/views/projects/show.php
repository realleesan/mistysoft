<section class="section section--page-top">
  <div class="container">
    <a href="<?= url('/') ?>" class="back-link">&larr; Quay lại trang chủ</a>

    <div class="project-detail">
      <div class="project-detail__header">
        <div class="project-detail__logo">
          <img src="<?= asset($project['logo']) ?>" alt="<?= e($project['title']) ?>" width="100" height="100">
        </div>
        <div>
          <h1 class="project-detail__title"><?= e($project['title']) ?></h1>
          <p class="project-detail__subtitle"><?= e($project['short_description'] ?? '') ?></p>
          <?php if (!empty($project['website_url'])): ?>
            <a href="<?= e($project['website_url']) ?>" class="btn btn--primary" target="_blank" rel="noopener">
              Xem website
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
          <?php endif; ?>
        </div>
      </div>

      <div class="project-detail__description">
        <h2>Mô tả dự án</h2>
        <p><?= nl2br(e($project['description'] ?? '')) ?></p>
      </div>

      <?php if (!empty($project['images'])): ?>
        <div class="project-detail__gallery">
          <h2>Hình ảnh dự án</h2>
          <div class="gallery">
            <?php foreach ($project['images'] as $image): ?>
              <div class="gallery__item">
                <img src="<?= asset($image) ?>" alt="<?= e($project['title']) ?>" loading="lazy">
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>

      <div class="project-detail__cta">
        <h2>Bạn cũng muốn có website như thế này?</h2>
        <p>Liên hệ MistySoft để được tư vấn miễn phí.</p>
        <a href="<?= url('/#contact') ?>" class="btn btn--primary btn--lg">Liên hệ ngay</a>
      </div>
    </div>
  </div>
</section>

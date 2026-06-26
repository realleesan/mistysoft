<?php
$portfolio = $content['portfolio']['content'] ?? [];
?>

<section class="section section--alt" id="portfolio">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title"><?= e($portfolio['section_title'] ?? 'DỰ ÁN ĐÃ THỰC HIỆN') ?></h2>
      <?php if (!empty($portfolio['section_subtitle'])): ?>
        <p class="section__subtitle"><?= e($portfolio['section_subtitle']) ?></p>
      <?php endif; ?>
    </div>
    <div class="portfolio-carousel">
      <div class="portfolio-carousel__track">
        <?php foreach ($projects as $project): ?>
          <?php 
            $projectImages = $project['images'] ?? [];
            $projectImage = !empty($projectImages) && is_array($projectImages) ? $projectImages[0] : $project['logo'];
          ?>
          <a href="<?= url('/projects/' . $project['slug']) ?>" class="portfolio-item">
            <div class="portfolio-item__image">
              <img src="<?= asset($projectImage) ?>" alt="<?= e($project['title']) ?>" loading="lazy">
              <div class="portfolio-item__overlay">
                <span class="portfolio-item__name"><?= e($project['title']) ?></span>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

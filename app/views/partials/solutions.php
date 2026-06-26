<?php
$solutions = $content['solutions']['content'] ?? [];
$items = $solutions['items'] ?? [];
$iconMap = [
  'design' => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 013 3L7 19l-4 1 1-4z"/></svg>',
  'conversion' => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>',
  'professional' => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
];
?>

<section class="section" id="solutions">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title"><?= e($solutions['section_title'] ?? 'Giải pháp từ MistySoft') ?></h2>
    </div>
    <div class="grid grid--3">
      <?php foreach ($items as $item): ?>
        <article class="card card--solution">
          <div class="card__icon card__icon--solution">
            <?= $iconMap[$item['icon'] ?? ''] ?? $iconMap['design'] ?>
          </div>
          <h3 class="card__title"><?= e($item['title'] ?? '') ?></h3>
          <p class="card__text"><?= e($item['description'] ?? '') ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

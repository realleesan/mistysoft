<?php
$problems = $content['problems']['content'] ?? [];
$items = $problems['items'] ?? [];
$iconMap = [
  'old' => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>',
  'traffic' => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M7 16l4-8 4 5 5-9"/></svg>',
  'trust' => '<svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',
];
?>

<section class="section section--alt" id="problems">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title"><?= e($problems['section_title'] ?? 'Bạn đang gặp phải vấn đề này?') ?></h2>
    </div>
    <div class="grid grid--3">
      <?php foreach ($items as $item): ?>
        <article class="card card--problem">
          <div class="card__icon card__icon--problem">
            <?= $iconMap[$item['icon'] ?? ''] ?? $iconMap['old'] ?>
          </div>
          <h3 class="card__title"><?= e($item['title'] ?? '') ?></h3>
          <p class="card__text"><?= e($item['description'] ?? '') ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

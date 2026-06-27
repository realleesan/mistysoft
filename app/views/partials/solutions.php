<?php
$solutions = $content['solutions']['content'] ?? [];
$items = $solutions['items'] ?? [];
$image = $content['solutions']['image'] ?? '';
?>

<section class="section" id="solutions">
  <div class="container">
    <div class="section__header">
      <h2 class="section__title"><?= e($solutions['section_title'] ?? 'MistySoft mang đến cho bạn') ?></h2>
      <?php if (!empty($solutions['section_subtitle'])): ?>
        <p class="section__subtitle"><?= e($solutions['section_subtitle']) ?></p>
      <?php endif; ?>
    </div>
    <div class="split-section split-section--image-right">
      <div class="split-section__content">
        <div class="accordion">
          <?php foreach ($items as $index => $item): ?>
            <div class="accordion__item">
              <button class="accordion__header" aria-expanded="false" data-accordion="solution-<?= $index ?>">
                <span class="accordion__title"><?= e($item['title'] ?? '') ?></span>
                <svg class="accordion__icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
              </button>
              <div class="accordion__content" id="solution-<?= $index ?>">
                <div class="accordion__body">
                  <?php if (!empty($item['answer'])): ?>
                    <p class="accordion__answer"><?= e($item['answer']) ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="split-section__image">
        <?php if (!empty($image)): ?>
          <img src="<?= asset('assets/images/resources/' . $image) ?>" alt="<?= e($solutions['section_title'] ?? '') ?>" loading="lazy">
        <?php else: ?>
          <div class="split-section__placeholder">
            <svg viewBox="0 0 24 24" width="64" height="64" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<script>
(function() {
  const solutionsSection = document.getElementById('solutions');
  if (!solutionsSection) return;
  
  solutionsSection.querySelectorAll('[data-accordion]').forEach(button => {
    button.addEventListener('click', function() {
      const targetId = this.getAttribute('data-accordion');
      const content = document.getElementById(targetId);
      const isExpanded = this.getAttribute('aria-expanded') === 'true';
      
      // Close all other accordions in this section
      solutionsSection.querySelectorAll('[data-accordion]').forEach(otherBtn => {
        if (otherBtn !== this) {
          otherBtn.setAttribute('aria-expanded', 'false');
          const otherContent = document.getElementById(otherBtn.getAttribute('data-accordion'));
          otherContent.style.maxHeight = null;
        }
      });
      
      // Toggle current accordion
      this.setAttribute('aria-expanded', !isExpanded);
      content.style.maxHeight = !isExpanded ? content.scrollHeight + 'px' : null;
    });
  });
})();
</script>

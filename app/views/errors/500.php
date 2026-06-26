<section class="section section--page-top">
  <div class="container" style="text-align:center; padding: 80px 0;">
    <h1>500</h1>
    <p>Đã xảy ra lỗi máy chủ. Chúng tôi đang xử lý.</p>
    <?php if (!empty($message)): ?>
      <pre style="text-align:left; max-width:800px; margin:20px auto; background:#f8f8f8; padding:10px; border-radius:4px;"><?= e($message) ?></pre>
    <?php endif; ?>
    <a href="<?= url('/') ?>" class="btn btn--primary">Về trang chủ</a>
  </div>
</section>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($title) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-color: #0b0f19;
      --text-color: #f3f4f6;
      --accent-blue: #3b82f6;
      --accent-glow: rgba(59, 130, 246, 0.15);
      --card-bg: rgba(17, 24, 39, 0.7);
      --card-border: rgba(255, 255, 255, 0.08);
      --error-color: #ef4444;
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Outfit', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      background-color: var(--bg-color);
      color: var(--text-color);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      overflow: hidden;
      position: relative;
    }

    /* Cosmic Background Glows */
    body::before {
      content: '';
      position: absolute;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, var(--accent-glow) 0%, rgba(0,0,0,0) 70%);
      top: 30%;
      left: 70%;
      transform: translate(-50%, -50%);
      z-index: 0;
    }

    body::after {
      content: '';
      position: absolute;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(147, 51, 234, 0.1) 0%, rgba(0,0,0,0) 70%);
      top: 70%;
      left: 20%;
      transform: translate(-50%, -50%);
      z-index: 0;
    }

    .container {
      max-width: 460px;
      width: 100%;
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-radius: 28px;
      padding: 45px 35px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.05);
      z-index: 1;
      position: relative;
      animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .logo-section {
      text-align: center;
      margin-bottom: 35px;
    }

    .logo-section h2 {
      font-size: 28px;
      font-weight: 800;
      background: linear-gradient(135deg, #fff 0%, #a5b4fc 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 8px;
    }

    .logo-section p {
      font-size: 14px;
      color: #9ca3af;
    }

    .form-group {
      margin-bottom: 24px;
      position: relative;
    }

    .form-group label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: #9ca3af;
      margin-bottom: 8px;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .input-wrapper {
      position: relative;
    }

    .input-wrapper input {
      width: 100%;
      background: rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 14px;
      padding: 15px 20px;
      color: #fff;
      font-size: 16px;
      font-family: inherit;
      transition: all 0.3s ease;
    }

    .input-wrapper input:focus {
      outline: none;
      border-color: var(--accent-blue);
      box-shadow: 0 0 15px rgba(59, 130, 246, 0.25);
      background: rgba(0, 0, 0, 0.4);
    }

    .btn-submit {
      width: 100%;
      background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
      color: #fff;
      border: none;
      border-radius: 14px;
      padding: 16px;
      font-size: 16px;
      font-weight: 600;
      font-family: inherit;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }

    .btn-submit:active {
      transform: translateY(0);
    }

    .alert-error {
      background: rgba(239, 68, 68, 0.1);
      border: 1px solid rgba(239, 68, 68, 0.2);
      border-radius: 14px;
      padding: 15px;
      color: #fca5a5;
      font-size: 14px;
      margin-bottom: 24px;
      display: flex;
      align-items: center;
      gap: 10px;
      animation: shake 0.5s ease;
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-6px); }
      75% { transform: translateX(6px); }
    }

    .security-notice {
      margin-top: 30px;
      border-top: 1px solid rgba(255, 255, 255, 0.05);
      padding-top: 20px;
      text-align: center;
    }

    .security-notice p {
      font-size: 12px;
      color: #4b5563;
      line-height: 1.5;
    }

    .security-notice strong {
      color: #ef4444;
    }

    @media (max-width: 600px) {
      body {
        padding: 12px;
      }

      .container {
        padding: 30px 20px;
        border-radius: 20px;
      }

      .logo-section h2 {
        font-size: 22px;
      }

      .logo-section p {
        font-size: 13px;
      }

      .input-wrapper input {
        padding: 14px 16px;
        font-size: 15px;
      }

      .btn-submit {
        padding: 14px;
        font-size: 15px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo-section">
      <h2>MISTYSOFT</h2>
      <p>Cổng phỏng vấn tư duy &amp; logic bảo mật</p>
    </div>

    <?php if ($error = flash('error')): ?>
      <div class="alert-error">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        <span><?= e($error) ?></span>
      </div>
    <?php endif; ?>

    <form action="<?= url('/interview/enter') ?>" method="POST">
      <div class="form-group">
        <label for="tenant_id">Mã truy cập phỏng vấn (Tenant ID)</label>
        <div class="input-wrapper">
          <input type="text" id="tenant_id" name="tenant_id" placeholder="Nhập mã truy cập..." required autocomplete="off" autofocus>
        </div>
      </div>

      <button type="submit" class="btn-submit">Bắt đầu làm bài phỏng vấn</button>
    </form>

    <div class="security-notice">
      <p>
        <strong>Lưu ý bảo mật:</strong> Hệ thống giám sát tự động sẽ hoạt động trong suốt quá trình làm bài. Hành vi chuyển tab, sao chép hoặc chụp màn hình vượt quá <strong>3 lần</strong> sẽ khiến tài khoản bị khóa 30 phút.
      </p>
    </div>
  </div>
</body>
</html>

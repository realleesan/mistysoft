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
      --accent-green: #10b981;
      --card-bg: rgba(17, 24, 39, 0.7);
      --card-border: rgba(255, 255, 255, 0.08);
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
      background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, rgba(0,0,0,0) 70%);
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 0;
    }

    .container {
      max-width: 480px;
      width: 100%;
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-radius: 28px;
      padding: 50px 40px;
      text-align: center;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.05);
      z-index: 1;
      position: relative;
      animation: scaleIn 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes scaleIn {
      from {
        opacity: 0;
        transform: scale(0.95);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .success-icon {
      width: 80px;
      height: 80px;
      background: rgba(16, 185, 129, 0.1);
      border: 1px solid rgba(16, 185, 129, 0.3);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 30px;
      box-shadow: 0 0 20px rgba(16, 185, 129, 0.2);
    }

    .success-icon svg {
      width: 40px;
      height: 40px;
      color: var(--accent-green);
    }

    h1 {
      font-size: 26px;
      font-weight: 700;
      margin-bottom: 12px;
      color: #fff;
    }

    p {
      font-size: 15px;
      color: #9ca3af;
      line-height: 1.6;
      margin-bottom: 35px;
    }

    .btn-home {
      display: inline-block;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: #fff;
      text-decoration: none;
      border-radius: 12px;
      padding: 12px 30px;
      font-size: 14px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-home:hover {
      background: rgba(255, 255, 255, 0.15);
      transform: translateY(-1px);
    }

    @media (max-width: 600px) {
      body {
        padding: 12px;
      }

      .container {
        padding: 30px 20px;
        border-radius: 20px;
      }

      h1 {
        font-size: 22px;
      }

      p {
        font-size: 14px;
      }

      .success-icon {
        width: 64px;
        height: 64px;
        margin-bottom: 20px;
      }

      .success-icon svg {
        width: 32px;
        height: 32px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="success-icon">
      <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
      </svg>
    </div>
    <h1>Nộp bài thành công</h1>
    <p><?= e($message) ?></p>
    <a href="<?= url('/') ?>" class="btn-home">Quay lại trang chủ</a>
  </div>
</body>
</html>

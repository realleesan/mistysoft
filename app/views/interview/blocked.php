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
      --bg-color: #080c14;
      --text-color: #f3f4f6;
      --accent-red: #f43f5e;
      --card-bg: rgba(15, 23, 42, 0.75);
      --card-border: rgba(244, 63, 94, 0.25);
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

    /* Cosmic Glow Effect */
    body::before {
      content: '';
      position: absolute;
      width: 450px;
      height: 450px;
      background: radial-gradient(circle, rgba(244, 63, 94, 0.15) 0%, rgba(0,0,0,0) 70%);
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 0;
    }

    .container {
      max-width: 520px;
      width: 100%;
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-radius: 28px;
      padding: 45px 35px;
      text-align: center;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.05);
      z-index: 1;
      position: relative;
      animation: scaleIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes scaleIn {
      from {
        opacity: 0;
        transform: scale(0.95) translateY(15px);
      }
      to {
        opacity: 1;
        transform: scale(1) translateY(0);
      }
    }

    .icon-wrapper {
      width: 84px;
      height: 84px;
      background: rgba(244, 63, 94, 0.08);
      border: 1px solid rgba(244, 63, 94, 0.3);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 28px;
      box-shadow: 0 0 25px rgba(244, 63, 94, 0.25);
    }

    .icon-wrapper svg {
      width: 42px;
      height: 42px;
      color: var(--accent-red);
      animation: pulse 2.5s infinite ease-in-out;
    }

    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
        opacity: 1;
      }
      50% {
        transform: scale(1.06);
        opacity: 0.8;
      }
    }

    h1 {
      font-size: 26px;
      font-weight: 700;
      margin-bottom: 14px;
      color: #fff;
      letter-spacing: -0.02em;
    }

    .description {
      font-size: 15px;
      color: #9ca3af;
      line-height: 1.6;
      margin-bottom: 35px;
    }

    .countdown-box {
      background: rgba(255, 255, 255, 0.02);
      border: 1px solid rgba(255, 255, 255, 0.04);
      border-radius: 20px;
      padding: 22px;
      margin-bottom: 28px;
    }

    .countdown-label {
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 0.12em;
      color: #6b7280;
      margin-bottom: 10px;
      font-weight: 600;
    }

    .countdown-time {
      font-size: 40px;
      font-weight: 800;
      color: var(--accent-red);
      font-feature-settings: "tnum";
      font-variant-numeric: tabular-nums;
      text-shadow: 0 0 15px rgba(244, 63, 94, 0.35);
    }

    .info-footer {
      font-size: 13px;
      color: #4b5563;
      border-top: 1px solid rgba(255, 255, 255, 0.05);
      padding-top: 24px;
    }

    .info-footer p {
      margin-bottom: 8px;
    }

    .info-footer strong {
      color: #9ca3af;
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

      .description {
        font-size: 14px;
      }

      .countdown-time {
        font-size: 32px;
      }

      .icon-wrapper {
        width: 64px;
        height: 64px;
        margin-bottom: 20px;
      }

      .icon-wrapper svg {
        width: 32px;
        height: 32px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="icon-wrapper">
      <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"></path>
      </svg>
    </div>
    <h1>Phòng phỏng vấn bị khóa</h1>
    <p class="description">
      Hệ thống phát hiện thiết bị này đã vi phạm chính sách bảo mật tuyển dụng vượt quá giới hạn an toàn (3 lần). Phiên phỏng vấn đã bị tạm khóa tự động để bảo đảm tính liêm chính của đề thi.
    </p>

    <div class="countdown-box">
      <div class="countdown-label">Mở khóa sau</div>
      <div class="countdown-time" id="countdown">--:--</div>
    </div>

    <div class="info-footer">
      <p>Địa chỉ IP của bạn: <strong><?= e($ip) ?></strong></p>
      <p>Mọi hành vi gian lận đều được ghi lại. Vui lòng liên hệ ban tuyển dụng nếu có thắc mắc.</p>
    </div>
  </div>

  <script>
    (function() {
      let remaining = parseInt(<?= json_encode($remaining) ?>) || 0;
      const countdownEl = document.getElementById('countdown');

      function updateTimer() {
        if (remaining <= 0) {
          countdownEl.textContent = 'Đang tải lại...';
          setTimeout(() => {
            window.location.reload();
          }, 1500);
          return;
        }

        const minutes = Math.floor(remaining / 60);
        const seconds = remaining % 60;
        
        countdownEl.textContent = 
          String(minutes).padStart(2, '0') + ':' + 
          String(seconds).padStart(2, '0');

        remaining--;
        setTimeout(updateTimer, 1000);
      }

      updateTimer();
    })();
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($title) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg-color: #0b0f19;
      --text-color: #f3f4f6;
      --accent-red: #ef4444;
      --card-bg: rgba(17, 24, 39, 0.7);
      --card-border: rgba(239, 68, 68, 0.2);
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
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

    /* Cosmic Background Effects */
    body::before {
      content: '';
      position: absolute;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(239, 68, 68, 0.15) 0%, rgba(0,0,0,0) 70%);
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 0;
    }

    .container {
      max-width: 500px;
      width: 100%;
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border-radius: 24px;
      padding: 40px 30px;
      text-align: center;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.05);
      z-index: 1;
      position: relative;
      animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .icon-wrapper {
      width: 80px;
      height: 80px;
      background: rgba(239, 68, 68, 0.1);
      border: 1px solid rgba(239, 68, 68, 0.3);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 24px;
      box-shadow: 0 0 20px rgba(239, 68, 68, 0.2);
    }

    .icon-wrapper svg {
      width: 40px;
      height: 40px;
      color: var(--accent-red);
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
        opacity: 1;
      }
      50% {
        transform: scale(1.05);
        opacity: 0.8;
      }
    }

    h1 {
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 12px;
      color: #fff;
      letter-spacing: -0.02em;
    }

    .description {
      font-size: 15px;
      color: #9ca3af;
      line-height: 1.6;
      margin-bottom: 30px;
    }

    .countdown-box {
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid rgba(255, 255, 255, 0.05);
      border-radius: 16px;
      padding: 20px;
      margin-bottom: 24px;
    }

    .countdown-label {
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: #6b7280;
      margin-bottom: 8px;
      font-weight: 600;
    }

    .countdown-time {
      font-size: 36px;
      font-weight: 700;
      color: var(--accent-red);
      font-feature-settings: "tnum";
      font-variant-numeric: tabular-nums;
      text-shadow: 0 0 10px rgba(239, 68, 68, 0.3);
    }

    .info-footer {
      font-size: 13px;
      color: #4b5563;
      border-top: 1px solid rgba(255, 255, 255, 0.05);
      padding-top: 20px;
    }

    .info-footer p {
      margin-bottom: 6px;
    }

    .info-footer strong {
      color: #9ca3af;
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
    <h1>Truy cập bị tạm khóa</h1>
    <p class="description">
      Hệ thống phát hiện thiết bị này đã thực hiện thao tác chụp ảnh màn hình hoặc in ấn vượt quá giới hạn an toàn (5 lần) trong phiên làm việc của tài liệu bảo mật.
    </p>

    <div class="countdown-box">
      <div class="countdown-label">Mở khóa sau</div>
      <div class="countdown-time" id="countdown">--:--</div>
    </div>

    <div class="info-footer">
      <p>Địa chỉ IP của bạn: <strong><?= e($ip) ?></strong></p>
      <p>Nếu đây là sự nhầm lẫn, vui lòng liên hệ admin để được hỗ trợ.</p>
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

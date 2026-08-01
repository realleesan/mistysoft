<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($title) ?></title>
  
  <!-- Font & PDF.js CDN -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>

  <style>
    :root {
      --bg-dark: #070a13;
      --bg-panel: rgba(15, 22, 42, 0.75);
      --border-color: rgba(255, 255, 255, 0.08);
      --text-main: #f8fafc;
      --text-muted: #94a3b8;
      --accent-cyan: #06b6d4;
      --accent-cyan-glow: rgba(6, 182, 212, 0.35);
      --accent-blue: #3b82f6;
      --accent-red: #ef4444;
      --accent-green: #10b981;
      --font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      user-select: none;
      -webkit-user-drag: none;
    }

    body {
      background-color: var(--bg-dark);
      color: var(--text-main);
      font-family: var(--font-family);
      height: 100vh;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    /* Prevent selection of elements */
    body, html, canvas, div, span, button, a {
      -webkit-user-select: none !important;
      -moz-user-select: none !important;
      -ms-user-select: none !important;
      user-select: none !important;
    }

    /* Print protection styles */
    @media print {
      body {
        display: none !important;
      }
      html {
        display: none !important;
      }
    }

    /* Top Header */
    .header {
      height: 64px;
      background: var(--bg-panel);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-bottom: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 24px;
      z-index: 100;
    }

    .header-logo {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
    }

    .header-logo img {
      height: 32px;
      pointer-events: none;
    }

    .logo-text {
      display: flex;
      flex-direction: column;
    }

    .logo-name {
      font-size: 14px;
      font-weight: 800;
      color: #fff;
      letter-spacing: 0.05em;
    }

    .logo-tagline {
      font-size: 9px;
      color: var(--accent-cyan);
      font-weight: 600;
      letter-spacing: 0.05em;
    }

    .header-title-bar {
      font-size: 15px;
      font-weight: 600;
      color: var(--text-main);
      background: rgba(255, 255, 255, 0.04);
      padding: 6px 16px;
      border-radius: 99px;
      border: 1px solid var(--border-color);
    }

    .security-status {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      font-weight: 500;
      color: var(--text-muted);
    }

    .status-dot {
      width: 8px;
      height: 8px;
      background-color: var(--accent-green);
      border-radius: 50%;
      box-shadow: 0 0 10px var(--accent-green);
      animation: pulseGreen 2s infinite;
    }

    @keyframes pulseGreen {
      0%, 100% {
        transform: scale(1);
        opacity: 1;
        box-shadow: 0 0 4px var(--accent-green);
      }
      50% {
        transform: scale(1.3);
        opacity: 0.6;
        box-shadow: 0 0 10px var(--accent-green);
      }
    }

    /* Main workspace */
    .app-body {
      flex: 1;
      display: flex;
      overflow: hidden;
      position: relative;
    }

    /* Left Sidebar */
    .sidebar {
      width: 320px;
      background: rgba(10, 15, 30, 0.6);
      border-right: 1px solid var(--border-color);
      display: flex;
      flex-direction: column;
      padding: 24px;
      overflow-y: auto;
      gap: 24px;
    }

    .sidebar-section-title {
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: var(--text-muted);
      margin-bottom: 12px;
    }

    /* Steps Progress List */
    .flow-steps {
      display: flex;
      flex-direction: column;
      position: relative;
    }

    .flow-steps::before {
      content: '';
      position: absolute;
      left: 17px;
      top: 15px;
      bottom: 15px;
      width: 2px;
      background: rgba(255, 255, 255, 0.05);
      z-index: 1;
    }

    .step-item {
      display: flex;
      align-items: flex-start;
      gap: 16px;
      padding: 12px 16px;
      border-radius: 12px;
      cursor: pointer;
      position: relative;
      z-index: 2;
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      margin-bottom: 8px;
      border: 1px solid transparent;
      background: transparent;
    }

    .step-item:hover {
      background: rgba(255, 255, 255, 0.02);
      border-color: rgba(255, 255, 255, 0.04);
    }

    .step-item.active {
      background: rgba(6, 182, 212, 0.08);
      border-color: rgba(6, 182, 212, 0.2);
    }

    .step-badge {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      font-weight: 700;
      color: var(--text-muted);
      transition: all 0.3s ease;
      flex-shrink: 0;
    }

    .step-item.active .step-badge {
      background: var(--accent-cyan);
      border-color: var(--accent-cyan);
      color: #000;
      box-shadow: 0 0 12px var(--accent-cyan-glow);
    }

    .step-content {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .step-title {
      font-size: 14px;
      font-weight: 600;
      color: var(--text-muted);
      transition: color 0.3s ease;
    }

    .step-item.active .step-title {
      color: #fff;
    }

    .step-desc {
      font-size: 11px;
      color: var(--text-muted);
    }

    /* Guidelines Panel */
    .guidelines-card {
      background: rgba(255, 255, 255, 0.02);
      border: 1px solid var(--border-color);
      border-radius: 16px;
      padding: 16px;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .guidelines-title {
      font-size: 13px;
      font-weight: 600;
      color: #fff;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .guidelines-title svg {
      width: 16px;
      height: 16px;
      color: var(--accent-cyan);
    }

    .guidelines-list {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .guidelines-list li {
      font-size: 12px;
      color: var(--text-muted);
      line-height: 1.5;
      display: flex;
      align-items: flex-start;
      gap: 8px;
    }

    .guidelines-list li svg {
      width: 14px;
      height: 14px;
      color: var(--accent-red);
      flex-shrink: 0;
      margin-top: 2px;
    }

    /* Session details */
    .session-info {
      margin-top: auto;
      background: rgba(255, 255, 255, 0.02);
      border: 1px solid var(--border-color);
      border-radius: 12px;
      padding: 12px;
      font-size: 11px;
      color: var(--text-muted);
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .session-row {
      display: flex;
      justify-content: space-between;
    }

    .session-row strong {
      color: #fff;
    }

    /* Main View Area */
    .view-area {
      flex: 1;
      display: flex;
      flex-direction: column;
      background: #090c15;
      position: relative;
    }

    /* View Area Toolbar */
    .toolbar {
      height: 52px;
      background: rgba(15, 22, 42, 0.4);
      border-bottom: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 24px;
      z-index: 10;
    }

    .toolbar-left, .toolbar-right, .toolbar-center {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .btn {
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid var(--border-color);
      border-radius: 8px;
      color: #fff;
      padding: 8px 12px;
      font-size: 13px;
      font-weight: 500;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s ease;
    }

    .btn:hover:not(:disabled) {
      background: rgba(255, 255, 255, 0.08);
      border-color: rgba(255, 255, 255, 0.15);
    }

    .btn:disabled {
      opacity: 0.35;
      cursor: not-allowed;
    }

    .btn svg {
      width: 16px;
      height: 16px;
    }

    .btn-icon {
      width: 34px;
      height: 34px;
      padding: 0;
      justify-content: center;
    }

    .btn-primary {
      background: var(--accent-cyan);
      color: #000;
      border: none;
      font-weight: 600;
    }

    .btn-primary:hover:not(:disabled) {
      background: #22d3ee;
      box-shadow: 0 0 10px rgba(6, 182, 212, 0.4);
    }

    .page-input-wrapper {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: var(--text-muted);
    }

    .page-input {
      width: 44px;
      height: 32px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid var(--border-color);
      border-radius: 6px;
      color: #fff;
      text-align: center;
      font-size: 13px;
      font-weight: 600;
    }

    .page-input:focus {
      outline: none;
      border-color: var(--accent-cyan);
      box-shadow: 0 0 0 2px var(--accent-cyan-glow);
    }

    /* Canvas Viewer Container */
    .viewer-viewport {
      flex: 1;
      overflow-y: auto;
      overflow-x: auto;
      padding: 40px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
      background: radial-gradient(circle at center, #0f172a 0%, #070a13 100%);
      scroll-behavior: smooth;
    }

    .canvas-card {
      background: #181c2b;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
      border-radius: 12px;
      border: 1px solid rgba(255, 255, 255, 0.05);
      position: relative;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      transition: transform 0.2s ease;
      margin-bottom: 24px;
      width: fit-content;
    }

    /* Repeating CSS Watermark Overlay on top of Document */
    .watermark-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 2;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-template-rows: repeat(6, 1fr);
      opacity: 0.07;
      transform: rotate(-15deg) scale(1.1);
      overflow: hidden;
    }

    .watermark-text {
      color: #fff;
      font-size: 14px;
      font-weight: 800;
      white-space: nowrap;
      display: flex;
      align-items: center;
      justify-content: center;
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }

    /* Loading Overlay */
    .loading-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: var(--bg-dark);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      z-index: 90;
      gap: 20px;
      transition: opacity 0.3s ease;
    }

    .spinner {
      width: 48px;
      height: 48px;
      border: 3px solid rgba(6, 182, 212, 0.1);
      border-radius: 50%;
      border-top-color: var(--accent-cyan);
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    .loading-text {
      font-size: 15px;
      font-weight: 600;
      color: #fff;
    }

    .loading-subtext {
      font-size: 12px;
      color: var(--text-muted);
    }

    /* Toast Notification System */
    .toast-container {
      position: fixed;
      bottom: 24px;
      right: 24px;
      z-index: 9999;
      display: flex;
      flex-direction: column;
      gap: 12px;
      max-width: 420px;
      width: calc(100vw - 48px);
      pointer-events: none;
    }

    .toast {
      background: rgba(17, 24, 39, 0.95);
      border: 1px solid var(--accent-red);
      color: #fff;
      padding: 16px;
      border-radius: 12px;
      font-size: 13px;
      line-height: 1.5;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), 0 0 15px rgba(239, 68, 68, 0.15);
      display: flex;
      align-items: flex-start;
      gap: 12px;
      animation: toastIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
      pointer-events: auto;
    }

    @keyframes toastIn {
      from {
        opacity: 0;
        transform: translateY(20px) scale(0.95);
      }
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    .toast-icon {
      color: var(--accent-red);
      flex-shrink: 0;
      margin-top: 1px;
    }

    .toast-body {
      flex: 1;
    }

    .toast-close {
      background: none;
      border: none;
      color: var(--text-muted);
      cursor: pointer;
      font-size: 16px;
      padding: 0 4px;
      line-height: 1;
    }

    .toast-close:hover {
      color: #fff;
    }

    /* Red screen flashing animation keyframes */
    @keyframes flashEffect {
      0% { opacity: 0.8; border-width: 15px; }
      100% { opacity: 0; border-width: 0px; }
    }

    /* Responsive Styling & Mobile Drawer */
    .menu-toggle-btn {
      display: none;
      background: none;
      border: none;
      color: var(--text-main);
      cursor: pointer;
      padding: 8px;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      transition: background 0.2s ease;
    }
    .menu-toggle-btn:hover {
      background: rgba(255, 255, 255, 0.05);
    }
    
    .sidebar-overlay {
      position: fixed;
      top: 64px;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      z-index: 98;
      display: none;
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    .sidebar-overlay.active {
      display: block;
      opacity: 1;
    }

    @media (max-width: 1024px) {
      .header-title-bar {
        display: none;
      }
    }

    @media (max-width: 768px) {
      .menu-toggle-btn {
        display: flex;
      }
      .sidebar {
        position: fixed;
        top: 64px;
        left: 0;
        bottom: 0;
        z-index: 99;
        width: 290px;
        background: rgba(10, 15, 30, 0.96);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        transform: translateX(-100%);
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        border-right: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 15px 0 30px rgba(0,0,0,0.6);
      }
      .sidebar.open {
        transform: translateX(0);
      }
      .viewer-viewport {
        padding: 20px 10px;
      }
    }

    @media (max-width: 600px) {
      .header {
        padding: 0 12px;
      }
      .logo-tagline {
        display: none !important;
      }
      .logo-name {
        font-size: 13px !important;
      }
      .security-status span {
        display: none;
      }
      .toolbar {
        height: auto !important;
        padding: 8px 12px !important;
        flex-direction: column !important;
        gap: 10px !important;
      }
      .toolbar-left, .toolbar-center {
        width: 100% !important;
        justify-content: center !important;
        gap: 12px !important;
      }
      .btn .btn-text {
        display: none !important;
      }
      .btn {
        padding: 8px 12px !important;
      }
      .page-input-wrapper {
        font-size: 12px !important;
        gap: 4px !important;
      }
      .page-input {
        width: 36px !important;
        height: 28px !important;
        font-size: 12px !important;
      }
      #btn-next-doc {
        display: none !important;
      }
    }
  </style>
</head>
<body>

  <!-- Top Header -->
  <header class="header">
    <div style="display: flex; align-items: center; gap: 12px;">
      <button class="menu-toggle-btn" id="menu-toggle-btn" aria-label="Mở menu tài liệu">
        <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="3" y1="12" x2="21" y2="12"></line>
          <line x1="3" y1="6" x2="21" y2="6"></line>
          <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
      </button>

      <a href="#" class="header-logo" onclick="event.preventDefault()">
        <img src="<?= asset('/assets/images/resources/logo_1_.svg') ?>" alt="MistySoft">
        <div class="logo-text">
          <span class="logo-name">MISTYSOFT</span>
          <span class="logo-tagline">SMART SYSTEMS - SEAMLESS SOLUTIONS</span>
        </div>
      </a>
    </div>
    
    <div class="header-title-bar">
      <span>Trung tâm Tài liệu Dự án - Bảo mật cao</span>
    </div>

    <div class="security-status">
      <div class="status-dot"></div>
      <span>Kết nối được bảo vệ</span>
    </div>
  </header>

  <!-- App Body -->
  <div class="app-body">
    <!-- Sidebar Backdrop overlay for mobile drawer -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    
    <!-- Sidebar: Steps & Guidelines -->
    <aside class="sidebar">
      <div>
        <h3 class="sidebar-section-title">Trình tự xem tài liệu</h3>
        
        <div class="flow-steps">
          <div class="step-item active" data-doc="proposal" id="step-proposal">
            <div class="step-badge">1</div>
            <div class="step-content">
              <span class="step-title">01. Proposal</span>
              <span class="step-desc">Đề xuất giải pháp dự án</span>
            </div>
          </div>

          <div class="step-item" data-doc="srs" id="step-srs">
            <div class="step-badge">2</div>
            <div class="step-content">
              <span class="step-title">02. SRS</span>
              <span class="step-desc">Đặc tả yêu cầu phần mềm</span>
            </div>
          </div>

          <div class="step-item" data-doc="qna" id="step-qna">
            <div class="step-badge">3</div>
            <div class="step-content">
              <span class="step-title">03. QnA</span>
              <span class="step-desc">Giải đáp & làm rõ thiết kế</span>
            </div>
          </div>

          <div class="step-item" data-doc="ats" id="step-ats">
            <div class="step-badge">4</div>
            <div class="step-content">
              <span class="step-title">04. ATS</span>
              <span class="step-desc">Kế hoạch kiểm thử chấp nhận</span>
            </div>
          </div>

          <div class="step-item" data-doc="payment" id="step-payment">
            <div class="step-badge">5</div>
            <div class="step-content">
              <span class="step-title">05. Payment</span>
              <span class="step-desc">Báo cáo và phân tích cổng thanh toán quốc tế</span>
            </div>
          </div>

          <div class="step-item" data-doc="contract" id="step-contract">
            <div class="step-badge">6</div>
            <div class="step-content">
              <span class="step-title">06. Contract</span>
              <span class="step-desc">Hợp đồng dịch vụ phát triển phần mềm</span>
            </div>
          </div>

          <div class="step-item" data-doc="config" id="step-config">
            <div class="step-badge">7</div>
            <div class="step-content">
              <span class="step-title">07. Config</span>
              <span class="step-desc">Hướng dẫn cấu hình hệ thống</span>
            </div>
          </div>

          <div class="step-item" data-doc="email" id="step-email">
            <div class="step-badge">8</div>
            <div class="step-content">
              <span class="step-title">08. Email</span>
              <span class="step-desc">Hướng dẫn cấu hình email</span>
            </div>
          </div>

          
        </div>
      </div>

      <div class="guidelines-card">
        <div class="guidelines-title">
          <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
          </svg>
          Chính sách an toàn tài liệu
        </div>
        <ul class="guidelines-list">
          <li>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
            Nghiêm cấm hành vi tải file, in ấn, sao chép văn bản dưới mọi hình thức.
          </li>
          <li>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
            Mọi hành động chụp ảnh màn hình (screenshot/snipping) sẽ bị hệ thống phát hiện.
          </li>
          <li>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
            <strong>Nếu vi phạm quá 5 lần chụp màn hình, thiết bị này sẽ bị khóa truy cập trong vòng 30 phút.</strong>
          </li>
        </ul>
      </div>

      <div class="session-info">
        <div class="session-row">
          <span>Địa chỉ IP:</span>
          <strong><?= e($ip) ?></strong>
        </div>
        <div class="session-row">
          <span>Mã phiên:</span>
          <strong>SECURE_<?= substr(md5($ip), 0, 8) ?></strong>
        </div>
        <div class="session-row">
          <span>Giám sát:</span>
          <span style="color: var(--accent-cyan); font-weight: 600;">ACTIVE</span>
        </div>
      </div>
    </aside>

    <!-- Main Viewport -->
    <main class="view-area">
      
      <!-- View Toolbar -->
      <div class="toolbar">
        <div class="toolbar-left">
          <button class="btn" id="prev-page" disabled>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
            <span class="btn-text">Trang trước</span>
          </button>
          
          <div class="page-input-wrapper">
            <span>Trang</span>
            <input type="text" class="page-input" id="page-num-input" value="1">
            <span>/ <span id="page-count">--</span></span>
          </div>

          <button class="btn" id="next-page" disabled>
            <span class="btn-text">Trang sau</span>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
          </button>
        </div>

        <div class="toolbar-center">
          <button class="btn btn-icon" id="zoom-out">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"></path></svg>
          </button>
          <span id="zoom-percent" style="font-size: 13px; font-weight: 600; min-width: 48px; text-align: center;">100%</span>
          <button class="btn btn-icon" id="zoom-in">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
          </button>
          <button class="btn" id="zoom-fit">Tự động</button>
        </div>

        <div class="toolbar-right">
          <!-- Flow navigation shortcut -->
          <button class="btn btn-primary" id="btn-next-doc">
            Tài liệu tiếp theo
            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
          </button>
        </div>
      </div>

      <!-- Viewer Container -->
      <div class="viewer-viewport" id="viewport">
        
        <!-- Loading Overlay -->
        <div class="loading-overlay" id="loading">
          <div class="spinner"></div>
          <div class="loading-text" id="loading-title">Đang xác thực bảo mật...</div>
          <div class="loading-subtext">Đang thiết lập môi trường đọc an toàn</div>
        </div>

        <!-- Vertical Pages Container -->
        <div id="pages-container" style="display: none; flex-direction: column; align-items: center; width: 100%;"></div>

      </div>
    </main>
  </div>

  <!-- Toast Notification Container -->
  <div class="toast-container" id="toast-container"></div>

  <!-- Client JavaScript Logic -->
  <script>
    (function() {
      // Configuration & State
      const DOC_ORDER = ['proposal', 'srs', 'qna', 'ats', 'payment', 'contract', 'email'];
      let currentDoc = 'proposal';
      let pdfDoc = null;
      let pageNum = 1;
      let scale = 1.2;
      let renderSessionId = 0;

      const viewport = document.getElementById('viewport');
      const loading = document.getElementById('loading');
      const loadingTitle = document.getElementById('loading-title');
      const pagesContainer = document.getElementById('pages-container');
      
      const prevBtn = document.getElementById('prev-page');
      const nextBtn = document.getElementById('next-page');
      const pageNumInput = document.getElementById('page-num-input');
      const pageCountSpan = document.getElementById('page-count');
      const zoomPercentSpan = document.getElementById('zoom-percent');
      const nextDocBtn = document.getElementById('btn-next-doc');

      // Set PDF.js Worker
      pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';

      // 1. Page Intersection Observer to sync toolbar page number during scroll
      const pageObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const pageId = entry.target.id;
            const pageNumInView = parseInt(pageId.replace('page-wrapper-', ''));
            if (!isNaN(pageNumInView)) {
              pageNum = pageNumInView;
              pageNumInput.value = pageNum;
              updateNavigationButtons();
            }
          }
        });
      }, {
        root: viewport,
        threshold: 0.25 // Trigger when 25% of the page is in view
      });

      // 2. Toast Alert System
      function showToast(message) {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.className = 'toast';
        toast.innerHTML = `
          <div class="toast-icon">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
          </div>
          <div class="toast-body">${message}</div>
          <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
        `;
        container.appendChild(toast);
        
        // Auto-remove after 8 seconds
        setTimeout(() => {
          toast.style.animation = 'toastIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) reverse forwards';
          setTimeout(() => toast.remove(), 300);
        }, 8000);
      }

      // 3. Security Violations Reporter
      let violationCount = 0;
      function reportViolation(reason) {
        // Red flash border effect
        const flash = document.createElement('div');
        flash.style.position = 'fixed';
        flash.style.top = '0';
        flash.style.left = '0';
        flash.style.width = '100vw';
        flash.style.height = '100vh';
        flash.style.border = '12px solid var(--accent-red)';
        flash.style.pointerEvents = 'none';
        flash.style.zIndex = '9999';
        flash.style.animation = 'flashEffect 0.6s ease-out forwards';
        document.body.appendChild(flash);
        setTimeout(() => flash.remove(), 600);

        // Report to server
        fetch('/api/v1/document/report-violation', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            if (data.blocked) {
              window.location.reload();
            } else {
              showToast(`CẢNH BÁO BẢO MẬT: Phát hiện thao tác bị cấm (${reason}). Lần vi phạm: ${data.violations}/5. Tài khoản sẽ bị khóa 30 phút nếu tiếp tục chụp hoặc in ấn.`);
            }
          }
        })
        .catch(err => {
          violationCount++;
          if (violationCount >= 5) {
            alert('Quyền truy cập của bạn đã bị khóa tạm thời do vi phạm điều khoản bảo mật.');
            window.location.reload();
          } else {
            showToast(`CẢNH BÁO BẢO MẬT: Thao tác bị cấm! Số lần vi phạm: ${violationCount}/5.`);
          }
        });
      }

      // Hook Security events
      // A. Right click
      document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        showToast('Cảnh báo: Nhấp chuột phải bị cấm trên trang bảo mật này.');
      });

      // B. Copy, Cut, Paste, SelectStart
      document.addEventListener('copy', e => { e.preventDefault(); reportViolation('Sao chép (Copy)'); });
      document.addEventListener('cut', e => { e.preventDefault(); reportViolation('Cắt dữ liệu (Cut)'); });
      document.addEventListener('paste', e => { e.preventDefault(); reportViolation('Dán dữ liệu (Paste)'); });
      document.addEventListener('selectstart', e => e.preventDefault());

      // C. F12 and keyboard shortcuts
      let modifiersPressed = false;
      window.addEventListener('keydown', function(e) {
        if (e.ctrlKey || e.shiftKey || e.altKey || e.metaKey) {
          modifiersPressed = true;
        }

        // F12
        if (e.key === 'F12' || e.keyCode === 123) {
          e.preventDefault();
          reportViolation('Nhấn F12');
          return false;
        }

        // Ctrl+Shift+I / J / C (DevTools)
        if (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J' || e.key === 'C' || e.keyCode === 73 || e.keyCode === 74 || e.keyCode === 67)) {
          e.preventDefault();
          reportViolation('Mở Trình duyệt DevTools');
          return false;
        }

        // Cmd+Opt+I / J / C (Mac DevTools)
        if (e.metaKey && e.altKey && (e.key === 'i' || e.key === 'j' || e.key === 'c' || e.key === 'I' || e.key === 'J' || e.key === 'C')) {
          e.preventDefault();
          reportViolation('Mở Mac DevTools');
          return false;
        }

        // Ctrl+U / Cmd+Alt+U (Source code)
        if (e.ctrlKey && (e.key === 'u' || e.key === 'U' || e.keyCode === 85)) {
          e.preventDefault();
          reportViolation('Xem mã nguồn (View Source)');
          return false;
        }

        // Ctrl+S / Cmd+S (Save)
        if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'S' || e.keyCode === 83)) {
          e.preventDefault();
          reportViolation('Lưu trang (Save Page)');
          return false;
        }

        // Ctrl+P / Cmd+P (Print)
        if ((e.ctrlKey || e.metaKey) && (e.key === 'p' || e.key === 'P' || e.keyCode === 80)) {
          e.preventDefault();
          reportViolation('In tài liệu (Print PDF)');
          return false;
        }

        // Win + Shift + S or Command + Shift + 4 (Screenshots)
        if ((e.metaKey || e.ctrlKey) && e.shiftKey && (e.key === 's' || e.key === 'S' || e.key === '4' || e.key === '3' || e.key === '5')) {
          reportViolation('Chụp màn hình (Shortcut)');
        }

        // PrintScreen Key
        if (e.key === 'PrintScreen' || e.keyCode === 44) {
          e.preventDefault();
          reportViolation('Phím Chụp Màn Hình (PrintScreen)');
          return false;
        }
      });

      window.addEventListener('keyup', function(e) {
        if (!e.ctrlKey && !e.shiftKey && !e.altKey && !e.metaKey) {
          modifiersPressed = false;
        }
      });

      // D. Blur event combined with modifiers (Screenshots trigger focus loss)
      window.addEventListener('blur', function() {
        if (modifiersPressed) {
          reportViolation('Chụp màn hình (Linh cảm từ Hệ thống - Window Blur)');
          modifiersPressed = false;
        }
      });

      // E. Beforeprint event
      window.addEventListener('beforeprint', function(e) {
        e.preventDefault();
        reportViolation('In tài liệu (System Print)');
      });


      // 4. PDF.js Document Loader
      function loadDocument(docKey) {
        currentDoc = docKey;
        pageNum = 1;
        renderSessionId++; // Cancel active render loops
        const thisSessionId = renderSessionId;
        
        // UI reset
        loading.style.opacity = '1';
        loading.style.display = 'flex';
        loadingTitle.textContent = `Đang tải tài liệu: ${docKey.toUpperCase()}...`;
        pagesContainer.innerHTML = '';
        pagesContainer.style.display = 'none';
        
        updateNavigationButtons();
        
        // Call secure API stream
        const url = `/api/v1/document/stream?doc=${docKey}`;

        pdfjsLib.getDocument({ url: url, withCredentials: true }).promise.then(function(pdf) {
          if (thisSessionId !== renderSessionId) return;

          pdfDoc = pdf;
          pageCountSpan.textContent = pdf.numPages;
          pageNumInput.value = pageNum;
          
          // Calculate scale to fit width on initial load
          pdf.getPage(1).then(function(page) {
            if (thisSessionId !== renderSessionId) return;
            
            const viewportData = page.getViewport({ scale: 1.0 });
            const viewportWidth = viewport.clientWidth - 48; // padding
            scale = viewportWidth / viewportData.width;
            scale = Math.min(Math.max(scale, 0.45), 1.8);
            zoomPercentSpan.textContent = Math.round(scale * 100) + '%';
            
            // Fade out loading
            loading.style.opacity = '0';
            setTimeout(() => {
              if (thisSessionId !== renderSessionId) return;
              loading.style.display = 'none';
              pagesContainer.style.display = 'flex';
              
              // Start rendering pages sequentially
              renderPages(thisSessionId, 1);
            }, 300);
          });

        }).catch(function(error) {
          console.error(error);
          loadingTitle.textContent = 'Lỗi tải tài liệu. Vui lòng kiểm tra quyền truy cập.';
          showToast('Lỗi: Không thể tải file tài liệu từ server.');
        });
      }

      // 5. Recursive Page Rendering
      function renderPages(sessionId, num) {
        if (sessionId !== renderSessionId) return;
        if (num > pdfDoc.numPages) {
          updateNavigationButtons();
          return;
        }

        // Create page wrapper card
        const pageWrapper = document.createElement('div');
        pageWrapper.className = 'canvas-card';
        pageWrapper.id = `page-wrapper-${num}`;
        pageWrapper.style.position = 'relative';
        pageWrapper.style.marginBottom = '24px';
        pageWrapper.style.display = 'flex';
        pageWrapper.style.justifyContent = 'center';
        pageWrapper.style.alignItems = 'center';

        const pageCanvas = document.createElement('canvas');
        pageCanvas.id = `page-canvas-${num}`;
        pageCanvas.style.display = 'block';
        pageCanvas.style.pointerEvents = 'none'; // Lock mouse events
        pageWrapper.appendChild(pageCanvas);

        // Watermark Overlay
        const pageWatermark = document.createElement('div');
        pageWatermark.className = 'watermark-overlay';
        
        const ip = <?= json_encode($ip) ?>;
        const text = `CONFIDENTIAL // MISTYSOFT // IP: ${ip}`;
        for (let i = 0; i < 24; i++) {
          const div = document.createElement('div');
          div.className = 'watermark-text';
          div.textContent = text;
          pageWatermark.appendChild(div);
        }
        pageWrapper.appendChild(pageWatermark);

        pagesContainer.appendChild(pageWrapper);
        
        // Observe page for updating Page number in toolbar
        pageObserver.observe(pageWrapper);

        // Fetch & render page
        pdfDoc.getPage(num).then(function(page) {
          if (sessionId !== renderSessionId) return;

          const viewportData = page.getViewport({ scale: scale });
          const pixelRatio = window.devicePixelRatio || 1;
          
          pageCanvas.width = viewportData.width * pixelRatio;
          pageCanvas.height = viewportData.height * pixelRatio;
          pageCanvas.style.width = viewportData.width + 'px';
          pageCanvas.style.height = viewportData.height + 'px';

          const ctx = pageCanvas.getContext('2d');
          const renderContext = {
            canvasContext: ctx,
            viewport: viewportData,
            transform: [pixelRatio, 0, 0, pixelRatio, 0, 0]
          };

          page.render(renderContext).promise.then(function() {
            if (sessionId !== renderSessionId) return;

            pageWatermark.style.width = viewportData.width + 'px';
            pageWatermark.style.height = viewportData.height + 'px';

            // Next page render
            renderPages(sessionId, num + 1);
          });
        });
      }

      function reRenderDocument() {
        if (!pdfDoc) return;
        renderSessionId++; // Cancel current loop
        const thisSessionId = renderSessionId;
        
        pagesContainer.innerHTML = '';
        pagesContainer.style.display = 'flex';
        
        renderPages(thisSessionId, 1);
      }

      function updateNavigationButtons() {
        if (!pdfDoc) {
          prevBtn.disabled = true;
          nextBtn.disabled = true;
          return;
        }

        prevBtn.disabled = pageNum <= 1;
        nextBtn.disabled = pageNum >= pdfDoc.numPages;

        // "Next Document" button logic
        const currentIndex = DOC_ORDER.indexOf(currentDoc);
        if (currentIndex < DOC_ORDER.length - 1) {
          nextDocBtn.style.display = 'flex';
          nextDocBtn.textContent = `Tài liệu tiếp theo: ${DOC_ORDER[currentIndex + 1].toUpperCase()}`;
        } else {
          nextDocBtn.style.display = 'none';
        }
      }

      // Page actions: Smooth scroll to target page wrapper
      prevBtn.addEventListener('click', function() {
        if (pageNum <= 1) return;
        const prevWrapper = document.getElementById(`page-wrapper-${pageNum - 1}`);
        if (prevWrapper) {
          prevWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });

      nextBtn.addEventListener('click', function() {
        if (!pdfDoc || pageNum >= pdfDoc.numPages) return;
        const nextWrapper = document.getElementById(`page-wrapper-${pageNum + 1}`);
        if (nextWrapper) {
          nextWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });

      pageNumInput.addEventListener('change', function() {
        if (!pdfDoc) return;
        let value = parseInt(this.value);
        if (!isNaN(value) && value >= 1 && value <= pdfDoc.numPages) {
          const wrapper = document.getElementById(`page-wrapper-${value}`);
          if (wrapper) {
            wrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
        } else {
          this.value = pageNum;
        }
      });

      // Zoom actions
      document.getElementById('zoom-in').addEventListener('click', function() {
        if (scale >= 3.0) return;
        scale += 0.15;
        zoomPercentSpan.textContent = Math.round(scale * 100) + '%';
        reRenderDocument();
      });

      document.getElementById('zoom-out').addEventListener('click', function() {
        if (scale <= 0.6) return;
        scale -= 0.15;
        zoomPercentSpan.textContent = Math.round(scale * 100) + '%';
        reRenderDocument();
      });

      // Auto Fit scale function
      function autoFitScale() {
        if (!pdfDoc) return;
        pdfDoc.getPage(pageNum).then(function(page) {
          const viewportData = page.getViewport({ scale: 1.0 });
          const viewportWidth = viewport.clientWidth - 40;
          scale = viewportWidth / viewportData.width;
          scale = Math.min(Math.max(scale, 0.45), 2.5);
          zoomPercentSpan.textContent = Math.round(scale * 100) + '%';
          reRenderDocument();
        });
      }

      document.getElementById('zoom-fit').addEventListener('click', autoFitScale);

      // Debounced window resize scale listener
      let resizeTimeout;
      window.addEventListener('resize', function() {
        if (!pdfDoc) return;
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
          if (window.innerWidth < 768) {
            autoFitScale();
          }
        }, 200);
      });

      // Mobile Sidebar Toggle JS
      const menuToggleBtn = document.getElementById('menu-toggle-btn');
      const sidebar = document.querySelector('.sidebar');
      const sidebarOverlay = document.getElementById('sidebar-overlay');

      if (menuToggleBtn && sidebar && sidebarOverlay) {
        menuToggleBtn.addEventListener('click', function() {
          sidebar.classList.toggle('open');
          sidebarOverlay.classList.toggle('active');
        });

        sidebarOverlay.addEventListener('click', function() {
          sidebar.classList.remove('open');
          sidebarOverlay.classList.remove('active');
        });

        // Close drawer when selecting step items on mobile
        document.querySelectorAll('.step-item').forEach(item => {
          item.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
              sidebar.classList.remove('open');
              sidebarOverlay.classList.remove('active');
            }
          });
        });
      }

      // Tab navigation
      const stepItems = document.querySelectorAll('.step-item');
      stepItems.forEach(item => {
        item.addEventListener('click', function() {
          const doc = this.getAttribute('data-doc');
          
          // Highlight active tab
          stepItems.forEach(s => s.classList.remove('active'));
          this.classList.add('active');

          loadDocument(doc);
        });
      });

      // Next Document shortcut
      nextDocBtn.addEventListener('click', function() {
        const currentIndex = DOC_ORDER.indexOf(currentDoc);
        if (currentIndex < DOC_ORDER.length - 1) {
          const nextDoc = DOC_ORDER[currentIndex + 1];
          const nextStepItem = document.getElementById(`step-${nextDoc}`);
          if (nextStepItem) {
            nextStepItem.click();
          }
        }
      });

      // Initial Load
      loadDocument('proposal');

    })();
  </script>
</body>
</html>

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
      --bg-color: #070a13;
      --panel-bg: rgba(13, 18, 33, 0.7);
      --card-border: rgba(255, 255, 255, 0.06);
      --accent-blue: #3b82f6;
      --accent-purple: #8b5cf6;
      --accent-red: #f43f5e;
      --text-main: #f3f4f6;
      --text-muted: #9ca3af;
      --success: #10b981;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Outfit', 'Inter', -apple-system, sans-serif;
      background-color: var(--bg-color);
      color: var(--text-main);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      user-select: none;
      -webkit-user-select: none;
    }

    /* Glow overlays */
    body::before {
      content: '';
      position: absolute;
      width: 600px;
      height: 600px;
      background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, rgba(0,0,0,0) 70%);
      top: -10%;
      right: -10%;
      pointer-events: none;
      z-index: 0;
    }

    body::after {
      content: '';
      position: absolute;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(139, 92, 246, 0.05) 0%, rgba(0,0,0,0) 70%);
      bottom: -10%;
      left: -10%;
      pointer-events: none;
      z-index: 0;
    }

    header {
      background: rgba(13, 18, 33, 0.5);
      border-bottom: 1px solid var(--card-border);
      padding: 16px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      backdrop-filter: blur(12px);
      z-index: 10;
    }

    .header-logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .header-logo h1 {
      font-size: 20px;
      font-weight: 800;
      background: linear-gradient(135deg, #fff 0%, #a5b4fc 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .header-logo span {
      background: rgba(59, 130, 246, 0.1);
      border: 1px solid rgba(59, 130, 246, 0.2);
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 600;
      color: var(--accent-blue);
      text-transform: uppercase;
    }

    .header-status {
      display: flex;
      align-items: center;
      gap: 20px;
      font-size: 13px;
      color: var(--text-muted);
    }

    .status-badge {
      display: flex;
      align-items: center;
      gap: 6px;
      background: rgba(16, 185, 129, 0.1);
      border: 1px solid rgba(16, 185, 129, 0.2);
      color: var(--success);
      padding: 4px 10px;
      border-radius: 20px;
      font-weight: 600;
    }

    .status-badge.alert-active {
      background: rgba(244, 63, 94, 0.1);
      border: 1px solid rgba(244, 63, 94, 0.2);
      color: var(--accent-red);
    }

    main {
      flex: 1;
      display: grid;
      grid-template-columns: 350px 1fr;
      z-index: 5;
      min-height: 0;
    }

    .sidebar {
      background: rgba(13, 18, 33, 0.4);
      border-right: 1px solid var(--card-border);
      padding: 24px;
      display: flex;
      flex-direction: column;
      gap: 24px;
      overflow-y: auto;
    }

    .section-title {
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: var(--text-muted);
      font-weight: 600;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .timer-container {
      background: rgba(255, 255, 255, 0.02);
      border: 1px solid rgba(255, 255, 255, 0.04);
      border-radius: 20px;
      padding: 20px;
      text-align: center;
      box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.05);
    }

    .timer-display {
      font-size: 42px;
      font-weight: 800;
      color: var(--accent-blue);
      font-feature-settings: "tnum";
      font-variant-numeric: tabular-nums;
      text-shadow: 0 0 15px rgba(59, 130, 246, 0.25);
    }

    .timer-display.warning {
      color: var(--accent-red);
      text-shadow: 0 0 15px rgba(244, 63, 94, 0.35);
      animation: pulse 1.5s infinite ease-in-out;
    }

    .rules-list {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 12px;
      font-size: 13px;
      color: var(--text-muted);
    }

    .rules-list li {
      display: flex;
      gap: 8px;
      align-items: flex-start;
      line-height: 1.5;
    }

    .rules-list svg {
      width: 16px;
      height: 16px;
      color: var(--accent-red);
      flex-shrink: 0;
      margin-top: 2px;
    }

    .workspace-area {
      display: flex;
      flex-direction: column;
      padding: 24px;
      gap: 20px;
      min-height: 0;
      overflow-y: auto;
    }

    .question-card {
      background: var(--panel-bg);
      border: 1px solid var(--card-border);
      border-radius: 20px;
      padding: 24px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .question-card h3 {
      font-size: 18px;
      font-weight: 700;
      color: #fff;
      margin-bottom: 12px;
    }

    .question-card p {
      font-size: 15px;
      color: var(--text-main);
      line-height: 1.6;
      white-space: pre-line;
    }

    .editor-card {
      flex: 1;
      display: flex;
      flex-direction: column;
      min-height: 0;
      background: var(--panel-bg);
      border: 1px solid var(--card-border);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .editor-header {
      background: rgba(255, 255, 255, 0.02);
      border-bottom: 1px solid var(--card-border);
      padding: 12px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
      font-weight: 600;
      color: var(--text-muted);
    }

    textarea {
      flex: 1;
      min-height: 0;
      background: transparent;
      border: none;
      resize: none;
      padding: 20px;
      color: #fff;
      font-family: 'Inter', -apple-system, sans-serif;
      font-size: 15px;
      line-height: 1.6;
      outline: none;
      overflow-y: auto;
    }

    textarea::placeholder {
      color: #4b5563;
    }

    .submit-bar {
      display: flex;
      justify-content: flex-end;
      gap: 15px;
      align-items: center;
    }

    .btn-submit {
      background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
      color: #fff;
      border: none;
      border-radius: 12px;
      padding: 12px 28px;
      font-size: 14px;
      font-weight: 600;
      font-family: inherit;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
    }

    .btn-submit:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
    }

    /* Toast Warnings */
    .toast-container {
      position: fixed;
      bottom: 24px;
      right: 24px;
      display: flex;
      flex-direction: column;
      gap: 10px;
      z-index: 10000;
    }

    .toast-card {
      background: rgba(17, 24, 39, 0.9);
      border: 1px solid rgba(244, 63, 94, 0.3);
      border-radius: 14px;
      padding: 16px 20px;
      color: #fecdd3;
      font-size: 13px;
      font-weight: 500;
      backdrop-filter: blur(16px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
      animation: toastIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
      display: flex;
      align-items: center;
      gap: 12px;
      max-width: 400px;
    }

    @keyframes toastIn {
      from { opacity: 0; transform: translateY(10px) scale(0.98); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* Mobile Drawer & Responsive */
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
      margin-right: 8px;
    }

    .menu-toggle-btn:hover {
      background: rgba(255, 255, 255, 0.05);
    }

    .sidebar-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      z-index: 90;
      display: none;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .sidebar-overlay.active {
      display: block;
      opacity: 1;
    }

    @media (max-width: 1024px) {
      .header-status span:first-child {
        display: none;
      }
    }

    @media (max-width: 768px) {
      .menu-toggle-btn {
        display: flex;
      }

      .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        z-index: 95;
        width: 300px;
        background: rgba(10, 15, 30, 0.98);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        transform: translateX(-100%);
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        border-right: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 15px 0 30px rgba(0,0,0,0.6);
        padding-top: 20px;
      }

      .sidebar.open {
        transform: translateX(0);
      }

      main {
        grid-template-columns: 1fr !important;
      }

      .workspace-area {
        padding: 16px !important;
      }
    }

    @media (max-width: 600px) {
      header {
        padding: 12px 16px !important;
      }

      .header-logo h1 {
        font-size: 16px !important;
      }

      .header-logo span {
        display: none;
      }

      .status-badge span:last-child {
        display: none;
      }

      .timer-display {
        font-size: 32px !important;
      }

      .question-card h3 {
        font-size: 16px !important;
      }

      .question-card p {
        font-size: 14px !important;
      }

      .submit-bar {
        flex-direction: column !important;
        gap: 10px !important;
        align-items: stretch !important;
      }

      .btn-submit {
        width: 100% !important;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="header-logo">
      <button class="menu-toggle-btn" id="menu-toggle-btn" aria-label="Mở menu">
        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
        </svg>
      </button>
      <h1>MISTYSOFT</h1>
      <span>Security Portal</span>
    </div>
    <div class="header-status">
      <span>IP: <strong><?= e($ip) ?></strong></span>
      <div id="violation-badge" class="status-badge">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.635 2.407-1.604 3.093-1.046.742-2.228 1.168-3.497 1.168-1.269 0-2.45-.425-3.496-1.168L9 15.657l-1.402.993C6.551 17.393 5.37 17.818 4.1 17.818c-1.269 0-2.45-.425-3.496-1.168L2.207 15.5l.394-.278L1.6 14.227C.635 13.542 0 12.403 0 11.135c0-1.268.635-2.407 1.604-3.093l1-1.007L4.1 7.82c1.269 0 2.45.426 3.496 1.168L9 8.343l1.402-.993c1.047-.743 2.228-1.168 3.497-1.168s2.45.425 3.497 1.168L21.2 8.343c.969.686 1.604 1.825 1.604 3.093z"/>
        </svg>
        <span>Trạng thái: Bảo mật</span>
      </div>
    </div>
  </header>

  <div class="sidebar-overlay" id="sidebar-overlay"></div>

  <main>
    <div class="sidebar">
      <div>
        <div class="section-title">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          Thời gian còn lại
        </div>
        <div class="timer-container">
          <div id="timer" class="timer-display">10:00</div>
        </div>
      </div>

      <div>
        <div class="section-title">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
          </svg>
          Quy định phòng thi
        </div>
        <ul class="rules-list">
          <li>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            <span>Không sao chép, cắt hoặc dán văn bản.</span>
          </li>
          <li>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            <span>Không nhấp chuột phải hoặc mở DevTools.</span>
          </li>
          <li>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            <span>Không chuyển tab hoặc thoát tiêu điểm cửa sổ thi.</span>
          </li>
          <li>
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            <span><strong>Vi phạm 3 lần</strong> sẽ bị khóa thi trong 30 phút.</span>
          </li>
        </ul>
      </div>
    </div>

    <div class="workspace-area">
      <div class="question-card">
        <h3><?= e($session['title']) ?></h3>
        <p><?= e($session['description']) ?></p>
      </div>

      <form id="interview-form" action="<?= url('/interview/submit') ?>" method="POST" class="editor-card">
        <div class="editor-header">
          <span>Bài làm của ứng viên (Tự động lưu nháp)</span>
          <span id="save-status" style="color: var(--success); font-weight: normal; opacity: 0; transition: opacity 0.3s ease;">Đã lưu nháp</span>
        </div>
        <textarea id="answer" name="answer" placeholder="Viết câu trả lời, lập luận logic và lời giải chi tiết của bạn tại đây..." required></textarea>
      </form>

      <div class="submit-bar">
        <span style="color: var(--text-muted); font-size: 13px;">Nhấp "Nộp bài" để hoàn tất bài thi</span>
        <button type="button" id="btn-submit" class="btn-submit">Nộp bài</button>
      </div>
    </div>
  </main>

  <div class="toast-container" id="toast-container"></div>

  <script>
    (function() {
      // 1. Initial State & Configuration
      const sessionTenantId = <?= json_encode($session['tenant_id']) ?>;
      let remaining = parseInt(<?= json_encode($remaining_time) ?>) || 600;
      const timerEl = document.getElementById('timer');
      const answerArea = document.getElementById('answer');
      const form = document.getElementById('interview-form');
      const btnSubmit = document.getElementById('btn-submit');
      const toastContainer = document.getElementById('toast-container');
      const violationBadge = document.getElementById('violation-badge');
      const saveStatus = document.getElementById('save-status');
      let isSubmitting = false;
      let lastViolationTime = 0;

      // Load draft from localStorage
      const draftKey = `interview_draft_${sessionTenantId}`;
      const savedDraft = localStorage.getItem(draftKey);
      if (savedDraft) {
        answerArea.value = savedDraft;
      }

      // Auto-save draft
      answerArea.addEventListener('input', () => {
        localStorage.setItem(draftKey, answerArea.value);
        saveStatus.style.opacity = '1';
        setTimeout(() => {
          saveStatus.style.opacity = '0';
        }, 1500);
      });

      // 2. Timer Countdown
      function updateCountdown() {
        if (remaining <= 0) {
          timerEl.textContent = '00:00';
          // Auto-submit
          showToast('Hết thời gian làm bài! Hệ thống đang tự động nộp bài...');
          setTimeout(() => {
            localStorage.removeItem(draftKey);
            form.submit();
          }, 1500);
          return;
        }

        const minutes = Math.floor(remaining / 60);
        const seconds = remaining % 60;
        
        timerEl.textContent = 
          String(minutes).padStart(2, '0') + ':' + 
          String(seconds).padStart(2, '0');

        if (remaining <= 60) {
          timerEl.classList.add('warning');
        }

        remaining--;
        setTimeout(updateCountdown, 1000);
      }
      updateCountdown();

      // Submit handle
      btnSubmit.addEventListener('click', () => {
        if (isSubmitting) return;
        if (answerArea.value.trim() === '') {
          alert('Vui lòng điền câu trả lời trước khi nộp bài.');
          return;
        }
        if (confirm('Bạn có chắc chắn muốn nộp bài? Sau khi nộp sẽ không thể chỉnh sửa.')) {
          isSubmitting = true;
          localStorage.removeItem(draftKey);
          form.submit();
        }
      });

      // 3. Security Warning Toasts
      function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'toast-card';
        toast.innerHTML = `
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
          </svg>
          <span>${message}</span>
        `;
        toastContainer.appendChild(toast);
        setTimeout(() => {
          toast.remove();
        }, 6000);
      }

      // 4. Violation Reporting
      let violationCount = 0;
      function reportViolation(reason) {
        if (isSubmitting) return;
        
        const now = Date.now();
        if (now - lastViolationTime < 1000) return;
        lastViolationTime = now;
        // Red flash border effect
        const flash = document.createElement('div');
        flash.style.position = 'fixed';
        flash.style.top = '0';
        flash.style.left = '0';
        flash.style.width = '100vw';
        flash.style.height = '100vh';
        flash.style.border = '12px solid var(--accent-red)';
        flash.style.pointerEvents = 'none';
        flash.style.zIndex = '99999';
        flash.style.animation = 'flashEffect 0.6s ease-out forwards';
        
        // Define keyframes dynamically if not present
        if (!document.getElementById('flash-keyframes')) {
          const style = document.createElement('style');
          style.id = 'flash-keyframes';
          style.innerHTML = `
            @keyframes flashEffect {
              from { opacity: 1; }
              to { opacity: 0; }
            }
          `;
          document.head.appendChild(style);
        }

        document.body.appendChild(flash);
        setTimeout(() => flash.remove(), 600);

        // Report to server
        fetch('/api/v1/interview/report-violation', {
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
              violationBadge.classList.add('alert-active');
              violationBadge.querySelector('span').textContent = `Cảnh báo: Vi phạm ${data.violations}/3`;
              showToast(`CẢNH BÁO BẢO MẬT: Phát hiện hành vi bị cấm (${reason}). Vi phạm: ${data.violations}/3. Thiết bị sẽ bị khóa 30 phút nếu tiếp tục vi phạm.`);
            }
          }
        })
        .catch(err => {
          violationCount++;
          if (violationCount >= 3) {
            alert('Thiết bị của bạn đã bị khóa tạm thời do vi phạm chính sách phòng phỏng vấn.');
            window.location.reload();
          } else {
            violationBadge.classList.add('alert-active');
            violationBadge.querySelector('span').textContent = `Cảnh báo: Vi phạm ${violationCount}/3`;
            showToast(`CẢNH BÁO BẢO MẬT: Hành vi bị cấm! Số lần vi phạm: ${violationCount}/3.`);
          }
        });
      }

      // 5. Block standard actions
      document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
        showToast('Cảnh báo: Nhấp chuột phải bị cấm tại trang phỏng vấn.');
      });

      document.addEventListener('copy', e => { e.preventDefault(); reportViolation('Sao chép'); });
      document.addEventListener('cut', e => { e.preventDefault(); reportViolation('Cắt văn bản'); });
      document.addEventListener('paste', e => { e.preventDefault(); reportViolation('Dán văn bản'); });

      // Keyboard blockers
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
          reportViolation('Mở DevTools');
          return false;
        }

        // Cmd+Opt+I / J / C (Mac DevTools)
        if (e.metaKey && e.altKey && (e.key === 'i' || e.key === 'j' || e.key === 'c' || e.key === 'I' || e.key === 'J' || e.key === 'C')) {
          e.preventDefault();
          reportViolation('Mở Mac DevTools');
          return false;
        }

        // Ctrl+U (Source code)
        if (e.ctrlKey && (e.key === 'u' || e.key === 'U' || e.keyCode === 85)) {
          e.preventDefault();
          reportViolation('Xem mã nguồn');
          return false;
        }

        // Ctrl+S (Save)
        if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'S' || e.keyCode === 83)) {
          e.preventDefault();
          reportViolation('Lưu trang');
          return false;
        }

        // Ctrl+P (Print)
        if ((e.ctrlKey || e.metaKey) && (e.key === 'p' || e.key === 'P' || e.keyCode === 80)) {
          e.preventDefault();
          reportViolation('In ấn');
          return false;
        }

        // PrintScreen Key
        if (e.key === 'PrintScreen' || e.keyCode === 44) {
          e.preventDefault();
          reportViolation('Chụp màn hình (PrintScreen)');
          return false;
        }
      });

      window.addEventListener('keyup', function(e) {
        if (!e.ctrlKey && !e.shiftKey && !e.altKey && !e.metaKey) {
          modifiersPressed = false;
        }
      });

      // 6. Focus Loss and Tab-Switch Detection
      // Whenever candidate switches tabs, VisibilityState changes to 'hidden'
      document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
          reportViolation('Chuyển tab trình duyệt');
        }
      });

      // Window Blur (e.g. alt-tabbing or clicking outside window)
      window.addEventListener('blur', function() {
        reportViolation('Thoát cửa sổ phỏng vấn (Focus loss)');
      });

      // Mobile Sidebar Toggle
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
      }
    })();
  </script>
</body>
</html>

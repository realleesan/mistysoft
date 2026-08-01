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
      --accent-purple: #8b5cf6;
      --card-bg: rgba(17, 24, 39, 0.7);
      --card-border: rgba(255, 255, 255, 0.08);
      --success: #10b981;
      --danger: #ef4444;
      --warning: #f59e0b;
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
      padding: 40px 20px;
    }

    .wrapper {
      max-width: 1200px;
      margin: 0 auto;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 40px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      padding-bottom: 20px;
    }

    h1 {
      font-size: 28px;
      font-weight: 800;
      background: linear-gradient(135deg, #fff 0%, #a5b4fc 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    h2 {
      font-size: 20px;
      font-weight: 700;
      margin-bottom: 20px;
      color: #fff;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    h3 {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 12px;
      color: #e5e7eb;
    }

    .btn-action {
      background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 10px 20px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }

    .btn-action:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .btn-sm {
      padding: 6px 14px;
      font-size: 13px;
      border-radius: 8px;
    }

    .btn-danger {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }

    .btn-danger:hover {
      box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .btn-success {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .btn-success:hover {
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .btn-secondary {
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .btn-secondary:hover {
      background: rgba(255, 255, 255, 0.12);
    }

    .card {
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      border-radius: 20px;
      padding: 30px;
      backdrop-filter: blur(20px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: #9ca3af;
      margin-bottom: 8px;
      text-transform: uppercase;
    }

    input, textarea, select {
      width: 100%;
      background: rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 10px;
      padding: 12px;
      color: #fff;
      font-size: 14px;
      font-family: inherit;
    }

    textarea {
      min-height: 120px;
      resize: vertical;
    }

    input:focus, textarea:focus, select:focus {
      outline: none;
      border-color: var(--accent-blue);
    }

    .form-row {
      display: flex;
      gap: 12px;
      align-items: flex-end;
    }

    .form-row .form-group {
      flex: 1;
      margin-bottom: 0;
    }

    .form-row input[type="number"] {
      width: 100px;
    }

    /* Alerts */
    .alert {
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .alert-success {
      background: rgba(16, 185, 129, 0.1);
      border: 1px solid rgba(16, 185, 129, 0.2);
      color: #a7f3d0;
    }

    .alert-error {
      background: rgba(239, 68, 68, 0.1);
      border: 1px solid rgba(239, 68, 68, 0.2);
      color: #fca5a5;
    }

    /* Question Items */
    .question-item {
      background: rgba(0, 0, 0, 0.2);
      border: 1px solid rgba(255, 255, 255, 0.05);
      border-radius: 16px;
      margin-bottom: 16px;
      overflow: hidden;
    }

    .question-header {
      padding: 20px 24px;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      cursor: pointer;
      transition: background 0.2s ease;
    }

    .question-header:hover {
      background: rgba(255, 255, 255, 0.02);
    }

    .question-info {
      flex: 1;
    }

    .question-title {
      font-size: 16px;
      font-weight: 600;
      color: #fff;
      margin-bottom: 6px;
    }

    .question-desc {
      font-size: 14px;
      color: #9ca3af;
      line-height: 1.5;
    }

    .question-actions {
      display: flex;
      gap: 8px;
      align-items: center;
    }

    .question-body {
      padding: 0 24px 20px;
      border-top: 1px solid rgba(255, 255, 255, 0.05);
      display: none;
    }

    .question-edit-form {
      background: rgba(0, 0, 0, 0.2);
    }

    .question-edit-form textarea {
      min-height: 100px;
      resize: vertical;
    }

    .question-item.expanded .question-body {
      display: block;
    }

    .tenant-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 8px;
      margin-top: 12px;
    }

    .tenant-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(255, 255, 255, 0.05);
      border-radius: 8px;
      padding: 8px 12px;
      font-size: 13px;
    }

    .tenant-id {
      font-family: monospace;
      color: #60a5fa;
      cursor: pointer;
      transition: color 0.2s ease;
    }

    .tenant-id:hover {
      color: #93c5fd;
    }

    .tenant-status {
      font-size: 11px;
      padding: 2px 8px;
      border-radius: 20px;
      font-weight: 600;
    }

    .tenant-status.used {
      background: rgba(239, 68, 68, 0.1);
      color: #f87171;
    }

    .tenant-status.unused {
      background: rgba(16, 185, 129, 0.1);
      color: #34d399;
    }

    .empty-state {
      text-align: center;
      padding: 40px;
      color: #6b7280;
    }

    .empty-state svg {
      width: 48px;
      height: 48px;
      margin-bottom: 12px;
      opacity: 0.5;
    }

    /* Submissions Table */
    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    th, td {
      padding: 14px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      font-size: 14px;
    }

    th {
      color: #9ca3af;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: 0.05em;
    }

    td {
      color: #e5e7eb;
    }

    .answer-preview {
      max-width: 300px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      color: #9ca3af;
      font-size: 13px;
    }

    .badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .badge-success {
      background: rgba(16, 185, 129, 0.1);
      color: #34d399;
      border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .badge-danger {
      background: rgba(239, 68, 68, 0.1);
      color: #f87171;
      border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .badge-warning {
      background: rgba(245, 158, 11, 0.1);
      color: #fbbf24;
      border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .code-id {
      font-family: monospace;
      background: rgba(255, 255, 255, 0.05);
      padding: 4px 8px;
      border-radius: 6px;
      color: #60a5fa;
      cursor: pointer;
      transition: all 0.2s ease;
      font-size: 13px;
    }

    .code-id:hover {
      background: rgba(96, 165, 250, 0.15);
    }

    .section-title {
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 20px;
      color: #fff;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .stats-row {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
      margin-bottom: 30px;
    }

    .stat-card {
      background: var(--card-bg);
      border: 1px solid var(--card-border);
      border-radius: 16px;
      padding: 20px;
      text-align: center;
    }

    .stat-value {
      font-size: 28px;
      font-weight: 800;
      background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .stat-label {
      font-size: 13px;
      color: #9ca3af;
      margin-top: 4px;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    /* Responsive */
    @media (max-width: 900px) {
      .grid {
        grid-template-columns: 1fr;
      }

      .wrapper {
        padding: 0;
      }

      body {
        padding: 20px 12px;
      }
    }

    @media (max-width: 600px) {
      header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }

      h1 {
        font-size: 22px;
      }

      .card {
        padding: 20px 16px;
        border-radius: 16px;
      }

      .section-title {
        font-size: 18px;
      }

      .stats-row {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
      }

      .stat-value {
        font-size: 22px;
      }

      .table-container {
        margin: 0 -16px;
        width: calc(100% + 32px);
      }

      table {
        font-size: 12px;
      }

      th, td {
        padding: 10px 8px;
      }

      .tenant-grid {
        grid-template-columns: 1fr;
      }

      .btn-action {
        padding: 8px 14px;
        font-size: 13px;
      }
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <header>
      <div>
        <h1>Quản trị phòng phỏng vấn</h1>
        <p style="color: #6b7280; font-size: 14px; margin-top: 5px;">Tạo đề bài, quản lý mã truy cập và xem kết quả</p>
      </div>
      <a href="<?= url('/interview') ?>" class="btn-action" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1)">Xem trang Interview</a>
    </header>

    <?php if ($success = flash('success')): ?>
      <div class="alert alert-success"><?= e($success) ?></div>
    <?php endif; ?>
    <?php if ($error = flash('error')): ?>
      <div class="alert alert-error"><?= e($error) ?></div>
    <?php endif; ?>

    <!-- Stats -->
    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-value"><?= count($questions) ?></div>
        <div class="stat-label">Đề bài</div>
      </div>
      <div class="stat-card">
        <div class="stat-value"><?= count($tenants) ?></div>
        <div class="stat-label">Mã truy cập</div>
      </div>
      <div class="stat-card">
        <div class="stat-value"><?= count(array_filter($tenants, fn($t) => !$t['is_used'])) ?></div>
        <div class="stat-label">Chưa sử dụng</div>
      </div>
      <div class="stat-card">
        <div class="stat-value"><?= count($submissions) ?></div>
        <div class="stat-label">Bài nộp</div>
      </div>
    </div>

    <!-- Create Question -->
    <div class="card">
      <h2>
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Tạo đề bài mới
      </h2>
      <form action="<?= url('/interview/admin/create-question') ?>" method="POST">
        <div class="form-group">
          <label for="title">Tiêu đề đề bài</label>
          <input type="text" name="title" id="title" placeholder="Ví dụ: Phỏng vấn tư duy logic - Vòng 1" required>
        </div>
        <div class="form-group">
          <label for="description">Nội dung đề bài</label>
          <textarea name="description" id="description" placeholder="Nhập nội dung câu hỏi phỏng vấn..." required></textarea>
        </div>
        <button type="submit" class="btn-action">Tạo đề bài</button>
      </form>
    </div>

    <!-- Questions Management -->
    <div class="card">
      <h2>
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
        </svg>
        Quản lý đề bài và mã truy cập
      </h2>

      <?php if (empty($questions)): ?>
        <div class="empty-state">
          <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12m-3.75.75h9.75m-9.75 0V19.5m9.75 0V19.5"/>
          </svg>
          <p>Chưa có đề bài nào. Tạo đề bài đầu tiên ở trên.</p>
        </div>
      <?php else: ?>
        <?php foreach ($questions as $q): ?>
          <?php
            $questionTenants = array_values(array_filter($tenants, fn($t) => $t['question_id'] === $q['id']));
            $unusedCount = count(array_filter($questionTenants, fn($t) => !$t['is_used']));
          ?>
          <div class="question-item">
            <div class="question-header" onclick="toggleQuestion(this)">
              <div class="question-info">
                <div class="question-title"><?= e($q['title']) ?></div>
                <div class="question-desc"><?= e($q['description']) ?></div>
                <div style="margin-top: 8px; display: flex; gap: 12px; font-size: 12px; color: #6b7280;">
                  <span><?= count($questionTenants) ?> mã</span>
                  <span style="color: #34d399;"><?= $unusedCount ?> chưa dùng</span>
                  <span style="color: #f87171;"><?= count($questionTenants) - $unusedCount ?> đã dùng</span>
                </div>
              </div>
              <div class="question-actions">
                <button type="button" class="btn-action btn-sm" onclick="event.stopPropagation(); generateTenant('<?= e($q['id']) ?>')">Tạo mã</button>
                <button type="button" class="btn-action btn-sm btn-secondary" onclick="event.stopPropagation(); toggleEdit('<?= e($q['id']) ?>')">Sửa</button>
                <form action="<?= url('/interview/admin/delete-question') ?>" method="POST" style="display: inline;" onsubmit="return confirm('Xoá đề bài này và tất cả mã truy cập liên quan?')">
                  <input type="hidden" name="question_id" value="<?= e($q['id']) ?>">
                  <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                  <button type="submit" class="btn-action btn-sm btn-danger">Xoá</button>
                </form>
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="transition: transform 0.2s;">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
              </div>
            </div>
            <div id="edit-form-<?= e($q['id']) ?>" class="question-edit-form" style="display: none; padding: 20px 24px; border-top: 1px solid rgba(255,255,255,0.05);">
              <form action="<?= url('/interview/admin/update-question') ?>" method="POST">
                <input type="hidden" name="question_id" value="<?= e($q['id']) ?>">
                <div class="form-group">
                  <label>Tiêu đề đề bài</label>
                  <input type="text" name="title" value="<?= e($q['title']) ?>" required>
                </div>
                <div class="form-group">
                  <label>Nội dung đề bài</label>
                  <textarea name="description" required><?= e($q['description']) ?></textarea>
                </div>
                <div style="display: flex; gap: 10px;">
                  <button type="submit" class="btn-action btn-sm btn-success">Lưu thay đổi</button>
                  <button type="button" class="btn-action btn-sm btn-secondary" onclick="toggleEdit('<?= e($q['id']) ?>')">Huỷ</button>
                </div>
              </form>
            </div>
            <div class="question-body">
              <form action="<?= url('/interview/admin/generate') ?>" method="POST" style="display: flex; gap: 12px; align-items: flex-end; margin-bottom: 16px;">
                <input type="hidden" name="question_id" value="<?= e($q['id']) ?>">
                <div class="form-group" style="flex: 1; margin-bottom: 0;">
                  <label>Số lượng mã cần tạo</label>
                  <input type="number" name="quantity" value="1" min="1" max="50" required>
                </div>
                <button type="submit" class="btn-action btn-sm btn-success">Tạo mã</button>
              </form>

              <?php if (empty($questionTenants)): ?>
                <div class="empty-state" style="padding: 20px;">
                  <p style="font-size: 13px;">Chưa có mã truy cập nào cho đề bài này.</p>
                </div>
              <?php else: ?>
                <div class="tenant-grid">
                  <?php foreach ($questionTenants as $t): ?>
                    <div class="tenant-item">
                      <span class="tenant-id" onclick="copyText('<?= e($t['tenant_id']) ?>')" title="Click để sao chép"><?= e($t['tenant_id']) ?></span>
                      <div style="display: flex; align-items: center; gap: 6px;">
                        <span class="tenant-status <?= $t['is_used'] ? 'used' : 'unused' ?>"><?= $t['is_used'] ? 'Đã dùng' : 'Chưa dùng' ?></span>
                        <form action="<?= url('/interview/admin/delete-tenant') ?>" method="POST" onsubmit="return confirm('Xoá mã này?')">
                          <input type="hidden" name="tenant_id" value="<?= e($t['tenant_id']) ?>">
                          <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                          <button type="submit" class="btn-action btn-sm btn-danger" style="padding: 2px 8px; font-size: 11px;">X</button>
                        </form>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- Submissions -->
    <div class="card">
      <h2>
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        Bài nộp gần đây
      </h2>

      <?php if (empty($submissions)): ?>
        <div class="empty-state">
          <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12m-3.75.75h9.75m-9.75 0V19.5m9.75 0V19.5"/>
          </svg>
          <p>Chưa có bài nộp nào.</p>
        </div>
      <?php else: ?>
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Thời điểm</th>
                <th>Mã truy cập</th>
                <th>Đề bài</th>
                <th>IP</th>
                <th>Thời gian</th>
                <th>Nội dung</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach (array_reverse($submissions) as $s): ?>
                <tr>
                  <td><?= e($s['submitted_at']) ?></td>
                  <td><span class="code-id"><?= e($s['tenant_id']) ?></span></td>
                  <td><?= e($s['question_title']) ?></td>
                  <td><span class="code-id"><?= e($s['ip']) ?></span></td>
                  <td><?= e($s['time_spent']) ?></td>
                  <td><div class="answer-preview" title="<?= e($s['answer']) ?>"><?= e($s['answer']) ?></div></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <script>
    function copyText(text) {
      navigator.clipboard.writeText(text).then(() => {
        alert("Đã sao chép: " + text);
      }).catch(err => {
        console.error("Không thể sao chép: ", err);
      });
    }

    function toggleQuestion(header) {
      const item = header.parentElement;
      item.classList.toggle('expanded');
      const arrow = header.querySelector('svg:last-child');
      if (arrow) {
        arrow.style.transform = item.classList.contains('expanded') ? 'rotate(180deg)' : 'rotate(0deg)';
      }
    }

    function toggleEdit(questionId) {
      const form = document.getElementById('edit-form-' + questionId);
      const item = form.closest('.question-item');
      if (form.style.display === 'none') {
        form.style.display = 'block';
        item.classList.add('expanded');
      } else {
        form.style.display = 'none';
      }
    }

    function generateTenant(questionId) {
      const quantity = prompt('Nhập số lượng mã truy cập cần tạo (1-50):', '1');
      if (quantity === null) return;
      
      const qty = parseInt(quantity, 10);
      if (isNaN(qty) || qty < 1 || qty > 50) {
        alert('Số lượng không hợp lệ. Vui lòng nhập từ 1 đến 50.');
        return;
      }

      const form = document.createElement('form');
      form.method = 'POST';
      form.action = '<?= url('/interview/admin/generate') ?>';
      
      const input1 = document.createElement('input');
      input1.type = 'hidden';
      input1.name = 'question_id';
      input1.value = questionId;
      
      const input2 = document.createElement('input');
      input2.type = 'hidden';
      input2.name = 'quantity';
      input2.value = qty;
      
      const input3 = document.createElement('input');
      input3.type = 'hidden';
      input3.name = 'csrf_token';
      input3.value = '<?= csrf_token() ?>';
      
      form.appendChild(input1);
      form.appendChild(input2);
      form.appendChild(input3);
      document.body.appendChild(form);
      form.submit();
    }
  </script>
</body>
</html>

<section class="section section--domain-check">
  <div class="container">
    <div class="domain-check__header">
      <h1 class="domain-check__title">Kiểm tra tên miền</h1>
      <p class="domain-check__subtitle">Kiểm tra tính khả dụng của tên miền và nhận báo giá đăng ký ngay lập tức</p>
    </div>

    <div class="domain-check__search">
      <form class="domain-check__form" id="domainCheckForm">
        <div class="domain-check__input-group">
          <input 
            type="text" 
            id="domainInput" 
            name="domain" 
            placeholder="Nhập tên miền (ví dụ: example.com)" 
            class="domain-check__input"
            required
            pattern="[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,}"
            autocomplete="off"
          >
          <button type="submit" class="btn btn--primary btn--lg domain-check__btn">
            <span class="domain-check__btn-text">Kiểm tra</span>
            <span class="domain-check__btn-loading" style="display: none;">
              <svg class="spinner" width="20" height="20" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-dasharray="31.4 31.4" class="spinner__circle"/>
              </svg>
            </span>
          </button>
        </div>
        <div class="domain-check__help">Nhập tên miền bạn muốn kiểm tra, ví dụ: mycompany.com</div>
      </form>
    </div>

    <div class="domain-check__result" id="domainResult" style="display: none;">
      <!-- Result will be injected here -->
    </div>

    <div class="domain-check__info">
      <h3 class="domain-check__info-title">Tại sao chọn MistySoft?</h3>
      <div class="domain-check__features">
        <div class="domain-check__feature">
          <div class="domain-check__feature-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 2L2 7l10 5 10-5-10-5z"/>
              <path d="M2 17l10 5 10-5"/>
              <path d="M2 12l10 5 10-5"/>
            </svg>
          </div>
          <h4 class="domain-check__feature-title">Giá cạnh tranh</h4>
          <p class="domain-check__feature-desc">Giá đăng ký tên miền cạnh tranh nhất thị trường</p>
        </div>
        <div class="domain-check__feature">
          <div class="domain-check__feature-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
            </svg>
          </div>
          <h4 class="domain-check__feature-title">Kích hoạt nhanh</h4>
          <p class="domain-check__feature-desc">Tên miền được kích hoạt ngay sau khi đăng ký</p>
        </div>
        <div class="domain-check__feature">
          <div class="domain-check__feature-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18.36 6.64a9 9 0 1 1-12.73 0"/>
              <line x1="12" y1="2" x2="12" y2="12"/>
            </svg>
          </div>
          <h4 class="domain-check__feature-title">Hỗ trợ 24/7</h4>
          <p class="domain-check__feature-desc">Đội ngũ hỗ trợ kỹ thuật luôn sẵn sàng giúp đỡ</p>
        </div>
        <div class="domain-check__feature">
          <div class="domain-check__feature-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
          </div>
          <h4 class="domain-check__feature-title">Bảo mật cao</h4>
          <p class="domain-check__feature-desc">Bảo mật thông tin chủ thể tên miền</p>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
.section--domain-check {
  padding: 80px 0;
  background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
}

.domain-check__header {
  text-align: center;
  margin-bottom: 48px;
}

.domain-check__title {
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--color-text);
  margin-bottom: 16px;
}

.domain-check__subtitle {
  font-size: 1.125rem;
  color: var(--color-text-muted);
  max-width: 600px;
  margin: 0 auto;
}

.domain-check__search {
  max-width: 700px;
  margin: 0 auto 60px;
}

.domain-check__input-group {
  display: flex;
  gap: 12px;
  margin-bottom: 12px;
}

.domain-check__input {
  flex: 1;
  padding: 16px 20px;
  font-size: 1.125rem;
  border: 2px solid var(--color-border);
  border-radius: var(--radius-md);
  transition: var(--transition);
}

.domain-check__input:focus {
  outline: none;
  border-color: var(--color-primary);
  box-shadow: var(--shadow-primary);
}

.domain-check__btn {
  padding: 16px 32px;
  font-size: 1.125rem;
  font-weight: 600;
  border-radius: var(--radius-md);
  white-space: nowrap;
}

.domain-check__btn-loading {
  display: flex;
  align-items: center;
  justify-content: center;
}

.spinner {
  animation: spin 1s linear infinite;
}

.spinner__circle {
  stroke-dasharray: 31.4;
  stroke-dashoffset: 31.4;
  animation: dash 1.5s ease-in-out infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

@keyframes dash {
  to { stroke-dashoffset: 0; }
}

.domain-check__help {
  font-size: 0.875rem;
  color: var(--color-text-muted);
  padding-left: 4px;
}

.domain-check__result {
  max-width: 700px;
  margin: 0 auto 60px;
  animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.domain-check__result-card {
  background: #fff;
  border-radius: var(--radius-lg);
  padding: 32px;
  box-shadow: var(--shadow-md);
  margin-bottom: 24px;
}

.domain-check__result-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 24px;
  padding-bottom: 24px;
  border-bottom: 1px solid var(--color-border);
}

.domain-check__result-domain {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--color-text);
}

.domain-check__result-status {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 16px;
  border-radius: 20px;
  font-size: 0.875rem;
  font-weight: 600;
}

.domain-check__result-status--available {
  background: #dcfce7;
  color: #166534;
}

.domain-check__result-status--taken {
  background: #fee2e2;
  color: #991b1b;
}

.domain-check__result-price {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 24px;
}

.domain-check__price-label {
  font-size: 1rem;
  color: var(--color-text-muted);
}

.domain-check__price-value {
  font-size: 2rem;
  font-weight: 700;
  color: var(--color-primary);
}

.domain-check__price-period {
  font-size: 0.875rem;
  color: var(--color-text-muted);
  margin-left: 4px;
}

.domain-check__result-actions {
  display: flex;
  gap: 12px;
}

.domain-check__suggestions {
  margin-top: 24px;
  padding-top: 24px;
  border-top: 1px solid var(--color-border);
}

.domain-check__suggestions-title {
  font-size: 1.125rem;
  font-weight: 600;
  color: var(--color-text);
  margin-bottom: 16px;
}

.domain-check__suggestions-list {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 12px;
}

.domain-check__suggestion-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px;
  background: var(--color-bg-alt);
  border-radius: var(--radius);
  transition: var(--transition);
}

.domain-check__suggestion-item:hover {
  background: #e2e8f0;
}

.domain-check__suggestion-domain {
  font-weight: 600;
  color: var(--color-text);
}

.domain-check__suggestion-price {
  font-weight: 700;
  color: var(--color-primary);
}

.domain-check__info {
  max-width: 900px;
  margin: 0 auto;
}

.domain-check__info-title {
  font-size: 1.75rem;
  font-weight: 700;
  color: var(--color-text);
  text-align: center;
  margin-bottom: 32px;
}

.domain-check__features {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 32px;
}

.domain-check__feature {
  text-align: center;
}

.domain-check__feature-icon {
  width: 64px;
  height: 64px;
  margin: 0 auto 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--gradient-primary);
  border-radius: 50%;
  color: #fff;
}

.domain-check__feature-title {
  font-size: 1.125rem;
  font-weight: 600;
  color: var(--color-text);
  margin-bottom: 8px;
}

.domain-check__feature-desc {
  font-size: 0.875rem;
  color: var(--color-text-muted);
  line-height: 1.5;
}

@media (max-width: 768px) {
  .domain-check__title {
    font-size: 2rem;
  }
  
  .domain-check__input-group {
    flex-direction: column;
  }
  
  .domain-check__btn {
    width: 100%;
  }
  
  .domain-check__result-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
  }
  
  .domain-check__result-price {
    flex-direction: column;
    align-items: flex-start;
    gap: 8px;
  }
  
  .domain-check__result-actions {
    flex-direction: column;
  }
  
  .domain-check__suggestions-list {
    grid-template-columns: 1fr;
  }
}
</style>

<script>
(function() {
  const form = document.getElementById('domainCheckForm');
  const input = document.getElementById('domainInput');
  const resultDiv = document.getElementById('domainResult');
  const btnText = document.querySelector('.domain-check__btn-text');
  const btnLoading = document.querySelector('.domain-check__btn-loading');
  const submitBtn = form.querySelector('button[type="submit"]');

  form.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const domain = input.value.trim();
    if (!domain) return;

    // Show loading
    btnText.style.display = 'none';
    btnLoading.style.display = 'flex';
    submitBtn.disabled = true;
    resultDiv.style.display = 'none';

    try {
      const response = await fetch(`<?= url('/api/v1/check-domain') ?>?domain=${encodeURIComponent(domain)}`, {
        method: 'GET'
      });

      const data = await response.json();

      if (data.error) {
        showError(data.error);
      } else {
        showResult(data);
      }
    } catch (error) {
      showError('Có lỗi xảy ra. Vui lòng thử lại.');
    } finally {
      btnText.style.display = 'inline';
      btnLoading.style.display = 'none';
      submitBtn.disabled = false;
    }
  });

  function showError(message) {
    resultDiv.innerHTML = `
      <div class="domain-check__result-card" style="background: #fee2e2; border: 1px solid #fecaca;">
        <div style="color: #991b1b; font-weight: 600;">${message}</div>
      </div>
    `;
    resultDiv.style.display = 'block';
  }

  function showResult(data) {
    const isAvailable = data.available;
    const price = data.price;
    const suggestions = data.suggestions || [];

    let html = `
      <div class="domain-check__result-card">
        <div class="domain-check__result-header">
          <div class="domain-check__result-domain">${data.domain}</div>
          <div class="domain-check__result-status ${isAvailable ? 'domain-check__result-status--available' : 'domain-check__result-status--taken'}">
            ${isAvailable ? '✓ Có sẵn' : '✗ Đã đăng ký'}
          </div>
        </div>
    `;

    if (isAvailable && price.available) {
      html += `
        <div class="domain-check__result-price">
          <span class="domain-check__price-label">Giá đăng ký:</span>
          <div>
            <span class="domain-check__price-value">${formatPrice(price.selling_price)}</span>
            <span class="domain-check__price-period">/năm</span>
          </div>
        </div>
        <div class="domain-check__result-actions">
          <a href="<?= url('/#contact') ?>?domain=${encodeURIComponent(data.domain)}&price=${price.selling_price}" class="btn btn--primary btn--lg" style="flex: 1; text-align: center;">
            Đăng ký ngay
          </a>
        </div>
      `;
    } else if (!isAvailable) {
      html += `
        <div style="color: var(--color-text-muted); margin-bottom: 24px;">
          Tên miền này đã được đăng ký. Vui lòng chọn tên khác hoặc xem gợi ý bên dưới.
        </div>
      `;
    }

    if (suggestions.length > 0) {
      html += `
        <div class="domain-check__suggestions">
          <h4 class="domain-check__suggestions-title">Gợi ý tên miền khác:</h4>
          <div class="domain-check__suggestions-list">
      `;

      suggestions.forEach(sug => {
        if (sug.price.available) {
          html += `
            <div class="domain-check__suggestion-item">
              <span class="domain-check__suggestion-domain">${sug.domain}</span>
              <span class="domain-check__suggestion-price">${formatPrice(sug.price.selling_price)}</span>
            </div>
          `;
        }
      });

      html += `
          </div>
        </div>
      `;
    }

    html += '</div>';
    resultDiv.innerHTML = html;
    resultDiv.style.display = 'block';
  }

  function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price) + 'đ';
  }
})();
</script>

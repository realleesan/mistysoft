<div class="coming-soon">
  <div class="coming-soon__container">
    <div class="coming-soon__content">
      <h1 class="coming-soon__title">COMING SOON</h1>
      <p class="coming-soon__subtitle">
        Chúng tôi đang hoàn thiện những điều tuyệt vời nhất để mang đến trải nghiệm tốt hơn cho bạn.
      </p>
      
      <form class="coming-soon__form" action="<?= url('/coming-soon/subscribe') ?>" method="POST">
        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_token() ?>">
        <div class="coming-soon__form-group">
          <input type="email" name="email" class="coming-soon__input" placeholder="Nhập email của bạn" required>
          <button type="submit" class="coming-soon__btn">Đăng ký</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
.coming-soon {
  min-height: 100vh;
  display: flex;
  align-items: center;
  background: url('<?= asset('/assets/images/resources/comingsoon.png') ?>') center center / cover no-repeat;
}

.coming-soon__container {
  width: 100%;
  max-width: 600px;
  padding: 40px;
  margin-left: 10%;
}

.coming-soon__content {
  color: white;
}

.coming-soon__title {
  font-size: 4rem;
  font-weight: 800;
  margin-bottom: 1.5rem;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  line-height: 1.1;
}

.coming-soon__subtitle {
  font-size: 1.25rem;
  margin-bottom: 2.5rem;
  color: rgba(255, 255, 255, 0.9);
  line-height: 1.6;
}

.coming-soon__notify {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 2rem;
  padding: 1.5rem;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 12px;
  backdrop-filter: blur(10px);
}

.coming-soon__bell-icon {
  color: #fbbf24;
  flex-shrink: 0;
}

.coming-soon__notify-text {
  font-size: 1rem;
  color: rgba(255, 255, 255, 0.9);
  margin: 0;
}

.coming-soon__form {
  margin-top: 2rem;
}

.coming-soon__form-group {
  display: flex;
  gap: 12px;
}

.coming-soon__input {
  flex: 1;
  padding: 16px 20px;
  font-size: 1rem;
  border: 2px solid rgba(255, 255, 255, 0.2);
  border-radius: 8px;
  background: rgba(255, 255, 255, 0.1);
  color: white;
  backdrop-filter: blur(10px);
  transition: all 0.3s ease;
}

.coming-soon__input::placeholder {
  color: rgba(255, 255, 255, 0.6);
}

.coming-soon__input:focus {
  outline: none;
  border-color: rgba(255, 255, 255, 0.5);
  background: rgba(255, 255, 255, 0.15);
}

.coming-soon__btn {
  padding: 16px 32px;
  font-size: 1rem;
  font-weight: 600;
  border: none;
  border-radius: 8px;
  background: var(--color-primary, #2563eb);
  color: white;
  cursor: pointer;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.coming-soon__btn:hover {
  background: var(--color-primary-dark, #1d4ed8);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
}

@media (max-width: 1024px) {
  .coming-soon__container {
    margin-left: 0;
    max-width: 100%;
    padding: 40px 20px;
  }
}

@media (max-width: 768px) {
  .coming-soon__title {
    font-size: 2.5rem;
  }
  
  .coming-soon__subtitle {
    font-size: 1rem;
  }
  
  .coming-soon__notify {
    flex-direction: column;
    text-align: center;
  }
  
  .coming-soon__form-group {
    flex-direction: column;
  }
  
  .coming-soon__btn {
    width: 100%;
  }
}
</style>

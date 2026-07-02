# QR-NFC Build Plan

## Overview
Build QR-NFC SaaS system theo lộ trình từ MVP đến production.

## Tech Stack

| Folder | Subdomain | Tech Stack | Hosting |
|--------|-----------|------------|---------|
| mistysoft-qr-nfc-review | review.mistydev.id.vn | HTML + Tailwind + Alpine.js | InfinityFree |
| mistysoft-qr-nfc-go | go.mistydev.id.vn | PHP | InfinityFree |
| mistysoft-qr-nfc-app | app.mistydev.id.vn | React + Vite + shadcn/ui | Vercel |
| mistysoft-api/qr-nfc | api.mistydev.id.vn | Node.js + Fastify + PostgreSQL | Railway |

---

## Phase 1: Foundation Setup (Week 1)

### 1.1 Setup Development Environment
- [ ] Install Node.js 18+ (cho API và React)
- [ ] Install PHP 8+ (cho go subdomain)
- [ ] Setup PostgreSQL local (cho API dev)
- [ ] Setup Git cho từng folder

### 1.2 Initialize Projects
- [ ] **mistysoft-qr-nfc-review**
  - [ ] Create HTML structure
  - [ ] Setup Tailwind CSS
  - [ ] Add Alpine.js
  - [ ] Create README.md

- [ ] **mistysoft-qr-nfc-go**
  - [ ] Create PHP structure
  - [ ] Setup .htaccess
  - [ ] Create README.md

- [ ] **mistysoft-qr-nfc-app**
  - [ ] `npm create vite@latest`
  - [ ] Install React + shadcn/ui
  - [ ] Setup routing (React Router)
  - [ ] Create README.md

- [ ] **mistysoft-api/qr-nfc**
  - [ ] `npm init`
  - [ ] Install Fastify
  - [ ] Setup PostgreSQL connection
  - [ ] Setup JWT auth
  - [ ] Create README.md

---

## Phase 2: API Development (Week 2-3)

### 2.1 Database Schema
- [ ] Design tables:
  - `users` (chủ quán)
  - `venues` (cửa hàng/quán)
  - `qr_codes` (QR/NFC tags)
  - `scans` (lịch sử quét)
  - `reviews` (đánh giá)
  - `analytics` (thống kê)

### 2.2 Core Endpoints
- [ ] **Auth**
  - [ ] POST `/api/qr-nfc/auth/register`
  - [ ] POST `/api/qr-nfc/auth/login`
  - [ ] POST `/api/qr-nfc/auth/refresh`

- [ ] **QR Code Management**
  - [ ] POST `/api/qr-nfc/qr/create`
  - [ ] GET `/api/qr-nfc/qr/list`
  - [ ] PUT `/api/qr-nfc/qr/:id`
  - [ ] DELETE `/api/qr-nfc/qr/:id`

- [ ] **Redirect Service**
  - [ ] GET `/api/qr-nfc/resolve/:code`
  - [ ] POST `/api/qr-nfc/scan/log`

- [ ] **Analytics**
  - [ ] GET `/api/qr-nfc/analytics/overview`
  - [ ] GET `/api/qr-nfc/analytics/scans`
  - [ ] GET `/api/qr-nfc/analytics/reviews`

### 2.3 Middleware
- [ ] JWT authentication
- [ ] Rate limiting
- [ ] Error handling
- [ ] Request validation

---

## Phase 3: Redirect Service (Week 3)

### 3.1 mistysoft-qr-nfc-go
- [ ] Create PHP redirect logic
- [ ] Implement QR code resolution
- [ ] Log scan events to API
- [ ] Handle invalid codes
- [ ] Setup 301/302 redirects

### 3.2 Testing
- [ ] Test redirect flow
- [ ] Test scan logging
- [ ] Test error handling

---

## Phase 4: Dashboard Development (Week 4-5)

### 4.1 mistysoft-qr-nfc-app
- [ ] **Authentication**
  - [ ] Login page
  - [ ] Register page
  - [ ] Auth context

- [ ] **Layout**
  - [ ] Sidebar navigation
  - [ ] Header
  - [ ] Responsive design

- [ ] **QR Code Management**
  - [ ] List QR codes
  - [ ] Create new QR
  - [ ] Edit QR details
  - [ ] Delete QR
  - [ ] Download QR image

- [ ] **Analytics Dashboard**
  - [ ] Overview stats
  - [ ] Scan charts (Recharts)
  - [ ] Review summary
  - [ ] Date range filter

- [ ] **Settings**
  - [ ] Profile settings
  - [ ] Venue settings
  - [ ] Notification settings

### 4.2 Integration with API
- [ ] Setup API client (axios/fetch)
- [ ] Implement auth flow
- [ ] Handle API errors
- [ ] Loading states

---

## Phase 5: Landing Page (Week 5)

### 5.1 mistysoft-qr-nfc-review
- [ ] **Hero Section**
  - [ ] Headline
  - [ ] CTA buttons
  - [ ] Feature highlights

- [ ] **Features Section**
  - [ ] Feature cards
  - [ ] Icons

- [ ] **How It Works**
  - [ ] Step-by-step guide
  - [ ] Visual flow

- [ ] **Pricing**
  - [ ] Pricing tiers
  - [ ] Feature comparison

- [ ] **FAQ**
  - [ ] Accordion (Alpine.js)

- [ ] **Footer**
  - [ ] Links
  - [ ] Contact info

### 5.2 Integration
- [ ] Link to app.mistydev.id.vn (CTA)
- [ ] Link to MistySoft /saas (back to ecosystem)

---

## Phase 6: Integration & Testing (Week 6)

### 6.1 End-to-End Testing
- [ ] Test full user journey:
  - [ ] Landing → Register → Login → Create QR → Scan → Analytics
  - [ ] Redirect flow (go subdomain)
  - [ ] Scan logging
  - [ ] Analytics display

### 6.2 Cross-Subdomain Integration
- [ ] Link MistySoft /saas → review subdomain
- [ ] Link review → app subdomain
- [ ] Link app → API
- [ ] Link go → API

### 6.3 Performance Testing
- [ ] API response time
- [ ] Redirect speed
- [ ] Dashboard load time
- [ ] Landing page performance

---

## Phase 7: Deployment (Week 7)

### 7.1 Hosting Setup
- [ ] **InfinityFree**
  - [ ] Setup review.mistydev.id.vn
  - [ ] Setup go.mistydev.id.vn
  - [ ] Configure subdomains

- [ ] **Vercel**
  - [ ] Connect mistysoft-qr-nfc-app repo
  - [ ] Configure app.mistydev.id.vn
  - [ ] Setup environment variables

- [ ] **Railway**
  - [ ] Deploy mistysoft-api
  - [ ] Setup PostgreSQL database
  - [ ] Configure api.mistydev.id.vn
  - [ ] Setup environment variables

### 7.2 Database Migration
- [ ] Export local schema
- [ ] Import to Railway PostgreSQL
- [ ] Run migrations
- [ ] Seed initial data

### 7.3 Environment Variables
- [ ] Configure API keys
- [ ] Database URLs
- [ ] JWT secrets
- [ ] CORS settings

---

## Phase 8: Launch Preparation (Week 8)

### 8.1 Final Testing
- [ ] Production testing
- [ ] Mobile testing
- [ ] Cross-browser testing
- [ ] Security audit

### 8.2 Documentation
- [ ] Update README for each repo
- [ ] API documentation
- [ ] User guide
- [ ] Deployment guide

### 8.3 Marketing
- [ ] Finalize landing page copy
- [ ] Setup analytics (Google Analytics)
- [ ] Setup error tracking (Sentry)

---

## Priority Order

1. **API** (mistysoft-api/qr-nfc) - Foundation
2. **Redirect** (mistysoft-qr-nfc-go) - Core functionality
3. **Dashboard** (mistysoft-qr-nfc-app) - User interface
4. **Landing** (mistysoft-qr-nfc-review) - Marketing

---

## Estimated Timeline

- **Total:** 8 weeks
- **MVP:** 6 weeks (có thể launch sớm)
- **Full launch:** 8 weeks

---

## Notes

- Mỗi folder là repo Git riêng
- CI/CD setup sau khi có MVP
- Monitor performance sau launch
- Iterate dựa trên user feedback

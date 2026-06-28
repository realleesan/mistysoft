# MistySoft Development Roadmap

## Tổng quan chiến lược phát triển

**Mục tiêu:** Xây dựng MistySoft thành một Digital Solutions Ecosystem cung cấp:
- Custom development services (web, app, tool, software)
- Website rental services
- SaaS products
- Support services (maintenance, SEO, etc.)
- Digital products store
- Industry-specific solutions

**Chiến lược architecture:**
- **Main domain (mistysoft.com)**: Ecosystem Hub - Gateway, branding, SEO hub, navigation đến tất cả services
- **Subdomain (saas.mistysoft.com)**: SaaS platform (Python)
- **Subdirectory**: Services, landing pages, industry pages (tất cả trên main domain)
- **Subdomain tiềm năng**: Products có techstack khác hoặc cần scale độc lập

**Sự thay đổi quan trọng:**
- Domain chính không còn là landing page đơn thuần cho web design
- Domain chính trở thành **Ecosystem Hub** - central gateway đến toàn bộ digital solutions
- Homepage giới thiệu toàn bộ capabilities, không chỉ web design

---

## Cấu trúc Domain & Subdomain

### Main Domain: mistysoft.com

**Mục đích:** Ecosystem Hub - Central gateway đến toàn bộ digital solutions, branding, SEO hub

**Chức năng chính:**
- **Gateway**: Điểm nhập chính cho tất cả services (custom dev, SaaS, rental, support)
- **Branding**: Xây dựng MistySoft như Digital Solutions Partner (không chỉ web design)
- **SEO Hub**: Tất cả content về 1 domain → authority cao nhất cho toàn bộ ecosystem
- **Navigation**: Hướng user đến đúng service dựa trên needs
- **Trust**: Domain chính tạo trust cao hơn cho toàn bộ ecosystem

**Cấu trúc:**
```
mistysoft.com/                          → Ecosystem Hub Homepage
├── Hero: "Digital Solutions for Your Business"
├── Services Overview Section            → Overview tất cả services
├── Industry Solutions Section          → Industry-specific solutions
├── Featured SaaS Section              → Highlight SaaS products
├── Why Choose Us Section
├── Testimonials Section
└── CTA Section
├── services/                           → Overview tất cả dịch vụ
│   ├── web-development/               → Thiết kế website theo yêu cầu
│   ├── app-development/               → Thiết kế app theo yêu cầu
│   ├── tool-development/              → Thiết kế tool theo yêu cầu
│   ├── software-development/          → Thiết kế phần mềm theo yêu cầu
│   └── payment-process/               → Quy trình thanh toán 3 giai đoạn
│       ├── overview/
│       ├── installment/              → Hỗ trợ trả góp
│       └── faq/
├── rental/                            → Dịch vụ thuê website
│   ├── ready-made/                    → Website có sẵn
│   ├── custom-build/                  → Build từ đầu rồi thuê
│   └── pricing/
├── support-services/                   → Dịch vụ phụ
│   ├── maintenance/                   → Bảo trì website
│   ├── redesign/                      → Thiết kế lại website
│   ├── seo/                           → SEO website
│   ├── business-registration/        → Đăng ký bộ công thương
│   └── other/                         → Các dịch vụ khác
├── domain-hosting/                     → Domain & hosting
│   ├── domain/
│   ├── hosting/
│   └── packages/
├── store/                             → TMĐT sản phẩm số
│   ├── products/
│   ├── checkout/
│   └── orders/
├── app/                               → App showcase + docs
│   ├── overview/
│   ├── features/
│   ├── docs/
│   ├── api/
│   └── pricing/
├── saas/                              → SaaS overview (redirect hub)
│   ├── overview/
│   ├── products/
│   ├── pricing/
│   └── docs/
├── landing/                           → Landing pages cho quảng cáo
│   ├── web-design-sme/
│   ├── app-development-startup/
│   ├── saas-google-form/
│   └── [other campaigns]/
├── industries/                        → Industry-specific pages
│   ├── overview/
│   ├── logistics/
│   │   ├── overview/
│   │   ├── features/
│   │   ├── portfolio/
│   │   ├── pricing/
│   │   └── case-studies/
│   ├── spa/
│   │   ├── overview/
│   │   ├── features/
│   │   ├── portfolio/
│   │   ├── pricing/
│   │   └── case-studies/
│   ├── restaurant/
│   ├── ecommerce/
│   ├── education/
│   ├── healthcare/
│   ├── real-estate/
│   └── [other industries]/
├── projects/                          → Portfolio (đã có)
├── blog/                              → Content marketing
├── about/                             → Về chúng tôi
└── contact/                           → Contact (đã có)
```

**Lý do dùng subdirectory:**
- ✅ SEO tốt nhất (tất cả authority về 1 domain)
- ✅ Dễ quản lý (chung database, authentication, analytics)
- ✅ Chi phí thấp (dùng shared hosting hiện tại)
- ✅ Dễ cross-link giữa các services
- ✅ Dùng PHP (techstack hiện tại)

---

### Subdomain: saas.mistysoft.com

**Mục đích:** Platform cho tất cả SaaS products (Python)

**Cấu trúc:**
```
saas.mistysoft.com/                    → SaaS platform home
├── google-form-tool/                  → Autofill Google Form
├── survey-tool/                       → Tool khảo sát (tương lai)
├── automation-tool/                   → Tool automation (tương lai)
└── ...                                → Các SaaS khác
```

**Lý do dùng subdomain:**
- ✅ Python app cần external hosting (không chạy trên shared hosting PHP)
- ✅ Scale độc lập cho từng SaaS product
- ✅ Techstack khác (Python vs PHP)
- ✅ Dễ migrate sau này nếu cần tách thành domain riêng
- ✅ Authentication, billing riêng cho SaaS platform

**Hosting đề xuất:** Railway, PythonAnywhere, hoặc VPS

---

### Subdomain tiềm năng (tương lai)

**store.mistysoft.com** (nếu TMĐT cần techstack khác)
- Nếu source TMĐT hiện tại không phải PHP
- Nếu cần scale độc lập cho store
- Nếu có nhiều products và traffic lớn

**app.mistysoft.com** (nếu app có hệ thống riêng)
- Nếu app có web app riêng (không chỉ docs)
- Nếu app cần authentication riêng
- Nếu app scale lớn

**Lưu ý:** Hiện tại nên giữ trong subdirectory để tối ưu SEO và chi phí

---

## Chiến lược Landing Pages & Industry Pages

### Landing Pages cho Quảng cáo

**Mục đích:** Tạo landing pages riêng cho từng campaign quảng cáo với tệp khách hàng khác biệt

**Cấu trúc:**
```
/landing/
├── web-design-sme/                    → Target SME cần website
├── app-development-startup/           → Target startup cần app
├── saas-google-form/                  → Target SaaS product
└── [other campaigns]/
```

**Chiến lược:**
- ✅ **Dùng subdirectory** (không subdomain) vì:
  - SEO tốt nhất (tất cả authority về 1 domain)
  - Chi phí thấp (dùng shared hosting hiện tại)
  - Analytics đơn giản (tất cả trong 1 GA property)
  - Retargeting dễ dàng (Pixel tracking toàn domain)
  - Trust factor cao hơn (domain chính)

**Tracking với UTM parameters:**
```
mistysoft.com/landing/web-design-sme?
  utm_source=facebook
  utm_campaign=sme_web_design
  utm_medium=cpc
```

**Khi nào dùng subdomain cho landing page:**
- Chỉ khi campaign cực lớn, dài hạn (6-12 tháng+)
- Khi cần techstack khác
- Khi cần brand riêng hoàn toàn
- Ví dụ: `black-friday.mistysoft.com`

---

### Industry-Specific Pages

**Mục đích:** Target các ngành cụ thể (logistics, spa, restaurant, etc.) với content tailored

**Cấu trúc:**
```
/industries/
├── overview/                          → Overview tất cả industries
├── logistics/                         → Website cho logistics
│   ├── overview/
│   ├── features/
│   ├── portfolio/
│   ├── pricing/
│   └── case-studies/
├── spa/                              → Website cho spa
│   ├── overview/
│   ├── features/
│   ├── portfolio/
│   ├── pricing/
│   └── case-studies/
├── restaurant/
├── ecommerce/
├── education/
├── healthcare/
├── real-estate/
└── [other industries]/
```

**Chiến lược:**
- ✅ **Dùng subdirectory** vì:
  - SEO tốt cho industry keywords (ví dụ: "website cho logistics")
  - Authority tập trung
  - Dễ internal linking giữa industries
  - User có thể browse tất cả industries
  - Chi phí thấp

**Content cho mỗi industry page:**
1. Hero section với industry-specific headline
2. Industry-specific features (ví dụ: logistics có tracking system)
3. Portfolio/case studies trong industry đó
4. Pricing tailored cho industry
5. FAQ specific đến industry
6. CTA: "Get Quote for [Industry]"

**Quảng cáo cho industry pages:**
```
Facebook Ads - Logistics:
→ mistysoft.com/industries/logistics?utm_source=fb&utm_campaign=logistics

Google Ads - Spa:
→ mistysoft.com/industries/spa?utm_source=gg&utm_campaign=spa
```

**Khi nào dùng subdomain cho industry:**
- Chỉ khi industry cực lớn, cần platform riêng
- Ví dụ: `logistics-platform.mistysoft.com` (không chỉ landing page)

---

## Phân nhóm Services

### Nhóm 1: Custom Development Services

**Services:**
- Web development (đã có)
- App development
- Tool development
- Software development

**Đặc điểm chung:**
- Business model giống nhau (custom project)
- Quy trình thanh toán giống nhau (3 giai đoạn)
- Target audience giống nhau (businesses cần custom solution)
- Cần showcase portfolio

**Cấu trúc:**
```
/services/
├── overview/                          → Overview tất cả custom services
├── web-development/
│   ├── overview/
│   ├── process/
│   ├── pricing/
│   ├── portfolio/
│   └── payment-process/               → Link đến trang payment chung
├── app-development/
│   ├── overview/
│   ├── process/
│   ├── pricing/
│   ├── portfolio/
│   └── payment-process/
├── tool-development/
│   ├── overview/
│   ├── process/
│   ├── pricing/
│   ├── portfolio/
│   └── payment-process/
└── software-development/
    ├── overview/
    ├── process/
    ├── pricing/
    ├── portfolio/
    └── payment-process/
```

**Quy trình thanh toán chung:**
```
/services/payment-process/
├── overview/                          → Giải thích 3 giai đoạn
├── stage-1/                           → Giai đoạn 1: Bắt đầu dự án
├── stage-2/                           → Giai đoạn 2: Hoàn thiện giao diện
├── stage-3/                           → Giai đoạn 3: Backend + Go live
├── installment/                       → Hỗ trợ trả góp
    ├── eligibility/                   → Điều kiện
    ├── process/                       → Quy trình
    ├── interest-rate/                 → Lãi suất
    └── application/                  → Form đăng ký
└── faq/                               → Câu hỏi thường gặp
```

**Lưu ý về trả góp:**
- Có nên có: ✅ Có, vì giúp khách hàng dễ thanh toán hơn
- Yêu cầu: Cần partner với ngân hàng hoặc công ty tài chính
- Thông tin cần thu thập: CCCD, thu nhập, lịch sử tín dụng
- Lãi suất: Theo quy định pháp luật (không quá 20%/năm)
- Implement: Có thể tích hợp với các nền tảng như Kredivo, Momo Credit, etc.

---

### Nhóm 2: Website Rental Services

**Services:**
- Thuê website có sẵn
- Build từ đầu rồi thuê

**Đặc điểm:**
- Business model khác (subscription vs one-time)
- Pricing model khác (tháng/năm)
- Target audience có thể khác (SMEs cần website nhanh)

**Cấu trúc:**
```
/rental/
├── overview/                          → Overview rental services
├── ready-made/                        → Website có sẵn
│   ├── templates/
│   ├── features/
│   └── pricing/
├── custom-build/                      → Build từ đầu rồi thuê
│   ├── process/
│   ├── features/
│   └── pricing/
├── comparison/                        → So sánh rental vs mua đứt
├── pricing/                           → Bảng giá thuê
└── faq/
```

**Lý do tách riêng:**
- Business model khác custom development
- Cần marketing message khác
- Cần pricing page riêng
- Có thể cross-sell với custom development

---

### Nhóm 3: Support Services

**Services:**
- Bảo trì website
- Thiết kế lại website
- SEO website
- Đăng ký bộ công thương
- Các dịch vụ phụ khác

**Đặc điểm:**
- Services bổ trợ cho main services
- Có thể upsell từ existing customers
- Pricing model đơn giản hơn

**Cấu trúc:**
```
/support-services/
├── overview/                          → Overview support services
├── maintenance/
│   ├── packages/
│   ├── sla/
│   └── pricing/
├── redesign/
│   ├── process/
│   ├── portfolio/
│   └── pricing/
├── seo/
│   ├── packages/
│   ├── process/
│   └── pricing/
├── business-registration/
│   ├── services/
│   ├── pricing/
│   └── process/
└── other/                             → Các dịch vụ khác
```

**Lý do tách riêng:**
- Dễ quản lý content
- Dễ cross-sell
- Có thể bundle với main services

---

### Nhóm 4: Domain & Hosting

**Services:**
- Đăng ký domain
- Hosting services
- SSL certificates
- Email hosting

**Đặc điểm:**
- Infrastructure services
- Có thể upsell với web development
- Recurring revenue

**Cấu trúc:**
```
/domain-hosting/
├── overview/
├── domain/
│   ├── registration/
│   ├── transfer/
│   └── pricing/
├── hosting/
│   ├── shared/
│   ├── vps/
│   ├── dedicated/
│   └── pricing/
├── ssl/
│   ├── types/
│   └── pricing/
└── email/
    ├── hosting/
    └── pricing/
```

---

### Nhóm 5: SaaS Products

**Products:**
- Autofill Google Form (Python, đang phát triển)
- Survey tool (tương lai)
- Automation tools (tương lai)

**Đặc điểm:**
- SaaS model (subscription)
- Techstack khác (Python)
- Cần authentication, billing riêng
- Scale độc lập

**Cấu trúc:**
```
Main domain:
/saas/                                  → Overview hub
├── overview/                          → Giới thiệu tất cả SaaS
├── products/                          → Danh sách products
│   ├── google-form-tool/
│   │   ├── overview/
│   │   ├── features/
│   │   ├── pricing/
│   │   └── docs/
│   └── [other products]/
├── pricing/                           → Pricing plans
├── docs/                              → Documentation chung
└── case-studies/                      → Success stories

Subdomain:
saas.mistysoft.com/                    → Actual SaaS platform
├── google-form-tool/                  → App thực tế
├── survey-tool/
└── [other apps]/
```

**Lý do chia 2 nơi:**
- Main domain (/saas): Marketing, SEO, pricing, docs
- Subdomain (saas.mistysoft.com): App thực tế, authentication, billing

---

### Nhóm 6: Digital Store

**Services:**
- Bán sản phẩm số
- Đã có source hoàn thiện

**Đặc điểm:**
- E-commerce model
- Có thể có techstack khác
- Cần payment gateway riêng

**Cấu trúc:**
```
Option 1: Subdirectory (nếu source là PHP)
/store/
├── products/
├── categories/
├── checkout/
├── orders/
└── account/

Option 2: Subdomain (nếu source không phải PHP)
store.mistysoft.com/
├── products/
├── categories/
├── checkout/
├── orders/
└── account/
```

**Lời khuyên:**
- Nếu source là PHP → dùng subdirectory
- Nếu source khác (Node.js, Python, etc.) → dùng subdomain
- Nếu chưa chắc → deploy thử subdirectory trước

---

### Nhóm 7: App Showcase

**Services:**
- Giới thiệu app đang build
- Documentation
- API docs
- Pricing

**Đặc điểm:**
- Product showcase
- Technical documentation
- Có thể có web app riêng

**Cấu trúc:**
```
/app/
├── overview/                          → Giới thiệu app
├── features/                          → Features detail
├── use-cases/                         → Use cases
├── pricing/                           → Pricing plans
├── docs/                              → Documentation
│   ├── getting-started/
│   ├── api/
│   ├── sdk/
│   └── guides/
└── contact/                           → Contact for enterprise
```

**Lưu ý:**
- Nếu app có web app riêng → cân nhắc app.mistysoft.com
- Nếu chỉ docs + showcase → giữ subdirectory

---

## Lộ trình phát triển

### Giai đoạn 1: Củng cố nền tảng (1-2 tháng)

**Mục tiêu:** Hoàn thiện main domain với tất cả services overview

**Tasks:**
1. **Cấu trúc main navigation**
   - Home, Services, Rental, SaaS, Store, App, Contact
   - Dropdown cho từng category

2. **Tạo trang services overview**
   - /services/overview
   - Liệt kê tất cả custom development services
   - CTA đến từng service page

3. **Tạo trang payment process**
   - /services/payment-process
   - Giải thích 3 giai đoạn thanh toán
   - Thông tin về trả góp (nếu có partner)

4. **Tạo trang rental services**
   - /rental/overview
   - Pricing cho rental
   - Comparison với custom development

5. **Tạo trang support services**
   - /support-services/overview
   - Liệt kê tất cả support services
   - Pricing packages

6. **Tạo trang domain & hosting**
   - /domain-hosting/overview
   - Pricing packages
   - Integration với registrar (nếu có)

7. **Update homepage**
   - Thêm section cho từng service group
   - CTA đến respective pages
   - Featured SaaS product

8. **Tạo trang SaaS overview**
   - /saas/overview
   - Link đến saas.mistysoft.com
   - Pricing, features

9. **Tạo landing page templates**
   - /landing/web-design-sme
   - /landing/app-development-startup
   - /landing/saas-google-form
   - Template có thể clone cho campaign mới

10. **Tạo industry pages**
    - /industries/overview
    - /industries/logistics
    - /industries/spa
    - /industries/restaurant
    - Template cho các industries khác

**Priority:** High
**Techstack:** PHP (shared hosting hiện tại)

---

### Giai đoạn 2: Deploy SaaS Platform (1-2 tháng)

**Mục tiêu:** Deploy Python SaaS lên external hosting

**Tasks:**
1. **Chọn hosting cho Python SaaS**
   - Railway (khuyên dùng)
   - PythonAnywhere
   - Hoặc VPS

2. **Deploy autofill Google Form tool**
   - Setup production environment
   - Configure database
   - Setup authentication
   - Setup billing (nếu cần)

3. **Cấu hình subdomain**
   - DNS: CNAME saas.mistysoft.com → railway.app
   - SSL certificate
   - Test connectivity

4. **Tích hợp với main domain**
   - Link từ /saas → saas.mistysoft.com
   - Shared analytics (GA cross-domain)
   - Navigation consistency

5. **Tạo documentation**
   - /saas/products/google-form-tool/docs
   - Getting started guide
   - API docs (nếu có)

**Priority:** High
**Techstack:** Python (external hosting)

---

### Giai đoạn 3: Launch Digital Store (1 tháng)

**Mục tiêu:** Deploy TMĐT store

**Tasks:**
1. **Review source code hiện có**
   - Check techstack
   - Check dependencies
   - Check security

2. **Decide deployment strategy**
   - Nếu PHP → deploy vào /store
   - Nếu không phải PHP → deploy vào store.mistysoft.com

3. **Setup payment gateway**
   - Momo, VNPAY, etc.
   - Configure webhooks
   - Test transactions

4. **Upload products**
   - Digital products
   - Pricing
   - Descriptions

5. **Integrate with main site**
   - Link từ homepage
   - Cross-sell với services
   - Shared user authentication (nếu cần)

**Priority:** Medium
**Techstack:** Tùy thuộc source hiện có

---

### Giai đoạn 4: App Documentation (1 tháng)

**Mục tiêu:** Tạo documentation và showcase cho app

**Tasks:**
1. **Tạo trang app overview**
   - /app/overview
   - Features, benefits
   - Use cases

2. **Tạo documentation**
   - /app/docs
   - Getting started
   - API docs
   - SDK docs (nếu có)

3. **Tạo pricing page**
   - /app/pricing
   - Plans, features
   - Enterprise contact

4. **Setup interactive demo**
   - Nếu có web app
   - Embed demo
   - CTA để signup

**Priority:** Medium
**Techstack:** PHP (shared hosting)

---

### Giai đoạn 5: Content Marketing (Ongoing)

**Mục tiêu:** Build authority, SEO traffic

**Tasks:**
1. **Tạo blog structure**
   - /blog
   - Categories: tutorials, case studies, industry insights

2. **Write content**
   - Tutorial cho SaaS products
   - Case studies cho services
   - Industry insights

3. **SEO optimization**
   - Keyword research
   - On-page SEO
   - Technical SEO

4. **Lead generation**
   - Email capture
   - Free resources
   - Webinars

**Priority:** Medium
**Techstack:** PHP (shared hosting)

---

### Giai đoạn 6: Scale & Optimize (Ongoing)

**Mục tiêu:** Optimize performance, prepare for scale

**Tasks:**
1. **Performance optimization**
   - Caching
   - CDN (Cloudflare)
   - Image optimization

2. **Analytics setup**
   - Google Analytics 4
   - Heatmaps (Hotjar)
   - Conversion tracking

3. **Automation**
   - Email automation
   - Chatbot
   - Lead scoring

4. **A/B testing**
   - Landing pages
   - Pricing
   - CTAs

**Priority:** Low
**Techstack:** Third-party tools

---

## Chi phí ước tính

### Giai đoạn 1: Củng cố nền tảng
- Shared hosting PHP: ~$5-10/tháng (đã có)
- Development time: 40-60 hours
- **Tổng:** ~$5-10/tháng

### Giai đoạn 2: Deploy SaaS
- Railway (Python hosting): Free → $5-20/tháng
- Development time: 20-40 hours
- **Tổng:** ~$5-30/tháng

### Giai đoạn 3: Launch Store
- Nếu PHP: $0 (dùng shared hosting)
- Nếu external: $5-20/tháng
- Development time: 20-30 hours
- **Tổng:** ~$0-20/tháng

### Giai đoạn 4: App Docs
- Shared hosting: $0 (dùng shared hosting)
- Development time: 20-30 hours
- **Tổng:** ~$0

### Giai đoạn 5: Content Marketing
- Content creation: $0-500/tháng (tự viết hoặc hire)
- Email marketing: Free → $50/tháng (Mailchimp, etc.)
- **Tổng:** ~$0-550/tháng

### Giai đoạn 6: Scale & Optimize
- CDN (Cloudflare): Free
- Analytics: Free
- Automation tools: Free → $100/tháng
- **Tổng:** ~$0-100/tháng

---

## Tổng chi phí hàng tháng

**Minimum (tự làm mọi thứ):**
- Shared hosting: $5-10
- Railway (SaaS): Free
- **Tổng:** ~$5-10/tháng

**Recommended (có một số tools paid):**
- Shared hosting: $5-10
- Railway (SaaS): $5-20
- Email marketing: $20-50
- Automation: $20-50
- **Tổng:** ~$50-130/tháng

**Growth (scale lên):**
- Shared hosting: $10-20
- Railway (SaaS): $20-50
- Email marketing: $50-100
- Automation: $50-100
- Additional hosting: $20-50
- **Tổng:** ~$150-320/tháng

---

## Kết luận

### Cấu trúc final đề xuất:

```
Main Domain (mistysoft.com) - PHP Shared Hosting - Ecosystem Hub:
├── /                          → Ecosystem Hub Homepage
│   ├── Hero: "Digital Solutions for Your Business"
│   ├── Services Overview Section
│   ├── Industry Solutions Section
│   ├── Featured SaaS Section
│   ├── Why Choose Us Section
│   ├── Testimonials Section
│   └── CTA Section
├── /services/                 → Custom development services
│   ├── /web-development/
│   ├── /app-development/
│   ├── /tool-development/
│   ├── /software-development/
│   └── /payment-process/      → Quy trình thanh toán + trả góp
├── /rental/                   → Website rental services
├── /support-services/         → Support services (maintenance, SEO, etc.)
├── /domain-hosting/           → Domain & hosting
├── /store/                    → Digital products store (hoặc subdomain)
├── /app/                      → App showcase + docs
├── /saas/                     → SaaS overview hub
├── /landing/                  → Landing pages cho quảng cáo
│   ├── /web-design-sme/
│   ├── /app-development-startup/
│   └── /saas-google-form/
├── /industries/               → Industry-specific pages
│   ├── /logistics/
│   ├── /spa/
│   ├── /restaurant/
│   └── [other industries]/
├── /projects/                 → Portfolio
├── /blog/                     → Content marketing
├── /about/                    → About us
└── /contact/                  → Contact

Subdomain (saas.mistysoft.com) - Python External Hosting:
├── /google-form-tool/         → SaaS product 1
├── /survey-tool/              → SaaS product 2 (tương lai)
└── /...                       → Các SaaS khác
```

### Lợi ích của cấu trúc này:
- ✅ **Ecosystem Hub**: Domain chính là central gateway đến toàn bộ digital solutions
- ✅ **SEO tối ưu**: Tất cả main content trên 1 domain → authority cao nhất
- ✅ **Chi phí thấp**: Dùng shared hosting hiện tại cho main domain
- ✅ **Dễ quản lý**: Chung database, analytics cho main domain
- ✅ **Scale được**: SaaS có thể migrate dễ dàng sang subdomain riêng
- ✅ **Flexibility**: Có thể tách thành subdomain khi cần
- ✅ **Branding mạnh**: Xây dựng MistySoft như Digital Solutions Partner
- ✅ **User journey tốt**: Homepage hướng user đến đúng service

### Lộ trình implement:
1. **Giai đoạn 1 (1-2 tháng):** Build tất cả subdirectory trên main domain
2. **Giai đoạn 2 (1-2 tháng):** Deploy SaaS lên external hosting
3. **Giai đoạn 3 (1 tháng):** Launch digital store
4. **Giai đoạn 4 (1 tháng):** App documentation
5. **Giai đoạn 5+:** Content marketing, optimization, scale

### Next steps:
1. Review và approve roadmap này
2. Bắt đầu implement Giai đoạn 1
3. Chọn hosting cho Python SaaS
4. Setup development environment

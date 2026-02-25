# There to Here - Date Distance Calculator

A high-precision, production-grade Laravel application engineered to compute the exact span between dates with a premium, futuristic cyber-aesthetic.

![Laravel 11](https://img.shields.io/badge/Laravel-11-FF2D20?style=flat-square&logo=laravel)
![TypeScript](https://img.shields.io/badge/TypeScript-5.9-3178C6?style=flat-square&logo=typescript)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.4-38B2AC?style=flat-square&logo=tailwind-css)

## 🎯 Features

- **High-Precision Calculations**: Compute years, months, days, weeks, hours, and seconds between any two dates.
- **Bi-directional Engine**: Seamlessly handles both historical and future date spans.
- **Deep Linking**: Share specific calculations instantly via encrypted-style URL parameters.
- **State Persistence**: Remembers your recent calculations and preferences across sessions.
- **Premium Cyber Design**: High-fidelity glassmorphism UI with custom digital hourglass branding.
- **Accessibility Optimized**: Full keyboard support (`Cmd+K` focus), screen reader compatibility, and reduced motion settings.
- **SEO Engineered**: Optimized metadata and server-side rendering for maximum discoverability.

## 🏗️ Architecture

### Technology Stack

**Backend:**
- Laravel 11 (PHP 8.3+)
- Carbon for robust date manipulation
- Service-oriented business logic isolation

**Frontend:**
- TypeScript 5.9
- Vite for modern asset orchestration
- Tailwind CSS 3.4
- date-fns v4 (efficient date utilities)

**Design:**
- Cyber-minimalist aesthetic
- High-contrast typography (Outfit/Inter)
- Animated gradient blurs and glassmorphism
- Custom digital hourglass branding

### Architectural Decisions

#### 1. **Server-Rendered Blade + TypeScript**
Ensures perfect SEO and instant initial load, while using TypeScript for high-performance, real-time client-side calculations.

#### 2. **Service Layer Pattern**
All temporal logic is encapsulated in `DateDistanceService.php`, ensuring the core engine is decoupled from HTTP concerns and fully testable.

#### 3. **Dual State Persistence**
State is synchronized between URL parameters (for sharing) and browser cookies (for session memory), ensuring a seamless user experience.

## 🚀 Getting Started

### Prerequisites
- PHP 8.3+
- Composer
- Node.js 18+

### Quick Deployment
To initialize the system and build fresh assets:
```bash
./deploy.sh
```

### Manual Installation
1. `composer install`
2. `npm install`
3. `cp .env.example .env && php artisan key:generate`
4. `php artisan migrate`
5. `npm run build`

## 🎨 Design System

### Colors
- **Primary**: Sky Blue (#38bdf8)
- **Secondary**: Indigo (#4f46e5)
- **Background**: Slate Deep (#020617) with animated sky-glow blurs.

### Typography
- **Primary Font**: Inter / Outfit
- **Monospace**: JetBrains Mono / SF Mono (for data readouts)

## 🔒 Security & Performance
- Full CSRF, XSS, and SQL Injection protection via Laravel core.
- Asset minification and tree-shaking via Vite.
- Efficient cache management for low-latency delivery.

## 📄 License
Open source under the MIT License.

---

**Developed with precision by [Abdur Rahman Emon](https://github.com/abdur-emon)**
*Engineered at the intersection of time and technology.*
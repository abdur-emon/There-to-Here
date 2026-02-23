# There to here? - Date Distance Calculator

A modern, production-grade Laravel application that calculates the precise time between any two dates with beautiful visualizations and fun facts.

![Laravel 11](https://img.shields.io/badge/Laravel-11-FF2D20?style=flat-square&logo=laravel)
![TypeScript](https://img.shields.io/badge/TypeScript-5.9-3178C6?style=flat-square&logo=typescript)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.4-38B2AC?style=flat-square&logo=tailwind-css)

## 🎯 Features

- **Precise Calculations**: Calculate years, months, days, weeks, hours, and seconds between dates
- **Bidirectional**: Handles both past and future dates
- **Deep Linking**: Share calculations via URL parameters
- **State Persistence**: Remembers your preferences using cookies
- **Dark/Light Mode**: Toggle between themes with persistence
- **Accessibility First**: Full keyboard navigation, ARIA labels, reduced motion support
- **SEO Friendly**: Server-side rendering for optimal search engine indexing
- **Fun Facts**: Deterministic contextual facts based on the time span
- **Responsive Design**: Beautiful glassmorphism UI that works on all devices

## 🏗️ Architecture

### Technology Stack

**Backend:**
- Laravel 11 (PHP 8.3+)
- Carbon for date manipulation
- Service-oriented architecture

**Frontend:**
- TypeScript 5.9
- Vite (for blazing-fast HMR)
- Tailwind CSS 3.4
- date-fns v4 (tree-shakeable date utilities)
- js-cookie (state persistence)

**Design:**
- Glassmorphism aesthetic
- Inter font family
- Animated gradient backgrounds
- Mobile-first responsive design

### Architectural Decisions

#### 1. **Server-Rendered Blade + TypeScript** (Not SPA)

**Why?**
- ✅ **SEO**: Full HTML on first paint
- ✅ **Performance**: No JS bundle required for initial render
- ✅ **Progressive Enhancement**: Works without JavaScript
- ✅ **Simplicity**: No complex state management frameworks
- ✅ **Deep Linking**: URL parameters work natively

**Tradeoffs:**
- ❌ No SPA-like page transitions (not needed for single-page app)

#### 2. **Service Layer Pattern**

Business logic lives in `app/Services/DateDistanceService.php`, not in controllers.

**Why?**
- **Testability**: Pure functions with no HTTP dependencies
- **Reusability**: Can be used in controllers, commands, jobs, queues
- **Maintainability**: All date logic in one place
- **Single Responsibility**: Controllers handle HTTP, services handle business logic

#### 3. **Client-Side Calculations**

TypeScript handles calculations in the browser using `date-fns`.

**Why?**
- **Instant Feedback**: No server round-trip
- **Reduced Server Load**: Calculations happen on the client
- **Better UX**: Real-time updates as you type
- **Offline Capable**: Works without network connection

#### 4. **Dual State Persistence**

State is persisted in both **cookies** and **URL parameters**.

**Why?**
- **Cookies**: Remember preferences across sessions
- **URL Params**: Enable sharing and deep linking
- **Priority System**: URL > Cookies > Defaults

**Example:**
```
?date=2030-01-01&from=2025-01-01&theme=dark
```

#### 5. **Deterministic Fun Facts**

Fun facts are generated using `totalDays % factsArray.length`.

**Why?**
- **Idempotent**: Same input always produces same output
- **Shareable**: URLs show the same fact to everyone
- **Predictable**: Users expect consistency
- **Testable**: Easy to write unit tests

### Project Structure

```
app/
├── Http/
│   └── Controllers/
│       └── DateDistanceController.php    # HTTP orchestration
└── Services/
    └── DateDistanceService.php           # Business logic

resources/
├── css/
│   └── app.css                            # Tailwind + custom styles
├── js/
│   ├── app.ts                             # Main application
│   ├── types/
│   │   └── index.ts                       # TypeScript interfaces
│   └── utils/
│       ├── dateDistance.ts                # Date calculations
│       ├── funFact.ts                     # Fun fact generator
│       └── state.ts                       # State management
└── views/
    ├── layouts/
    │   └── app.blade.php                  # Base layout
    ├── components/
    │   ├── date-input.blade.php           # Reusable date input
    │   ├── theme-toggle.blade.php         # Theme switcher
    │   └── result-display.blade.php       # Results UI
    └── date-distance/
        └── index.blade.php                # Main page

tests/
└── Feature/
    └── DateDistanceTest.php               # Feature tests
```

## 🚀 Getting Started

### Prerequisites

- PHP 8.3+
- Composer
- Node.js 18+
- npm or yarn

### Deployment

To ensure a fresh start for the UI after pulling updates (e.g., from xCloud), run the deployment script:

```bash
./deploy.sh
```

This script will:
- Install backend and frontend dependencies
- Build fresh UI assets using Vite
- Clear Laravel view, cache, route, and config caches
- Run database migrations

### Installation

1. **Install PHP dependencies:**
```bash
composer install
```

2. **Install JavaScript dependencies:**
```bash
npm install
```

3. **Set up environment:**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Initialize Database (Required for Admin Features):**
```bash
php artisan migrate
```

5. **Build assets:**
```bash
npm run build
```

### Development

Run both servers concurrently:

```bash
# Terminal 1: Laravel dev server
php artisan serve

# Terminal 2: Vite dev server (with HMR)
npm run dev
```

Visit: `http://localhost:8000`

### Accessing Admin Features (Copy/Share/Reset)

This application includes protected features behind an authentication wall.
1. Navigate to `http://localhost:8000/register` to create a local account.
2. Once logged in, return to the main calculator to access the **Copy, Share, and Reset** actions.

### Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=DateDistanceTest
```

## 🎨 Design System

### Colors

- **Primary**: Purple (#a855f7)
- **Secondary**: Pink (#ec4899)
- **Background**: Animated gradient (purple → pink → blue)

### Glassmorphism

```css
.glass {
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(24px);
  border: 1px solid rgba(255, 255, 255, 0.1);
}
```

### Typography

- **Font**: Inter (Google Fonts)
- **Weights**: 300, 400, 500, 600, 700

## ♿ Accessibility

- **Keyboard Navigation**: Full support with visible focus rings
- **Screen Readers**: ARIA labels on all interactive elements
- **Reduced Motion**: Respects `prefers-reduced-motion`
- **Color Contrast**: WCAG AA compliant
- **Keyboard Shortcuts**: `Cmd+K` to focus date input

## 📱 Responsive Design

- **Mobile First**: Designed for small screens, enhanced for large
- **Breakpoints**: sm (640px), md (768px), lg (1024px)
- **Touch Friendly**: Large tap targets (44x44px minimum)

## 🔒 Security

- **CSRF Protection**: Laravel's built-in CSRF middleware
- **Input Validation**: Server-side validation on all inputs
- **XSS Prevention**: Blade's automatic escaping
- **SQL Injection**: Eloquent ORM prevents SQL injection

## 📈 Performance

- **Vite**: Lightning-fast HMR during development
- **Code Splitting**: Automatic chunk splitting
- **Tree Shaking**: Only import what you use
- **Asset Optimization**: Minification and compression in production

## 🧪 Testing Strategy

- **Feature Tests**: Test HTTP endpoints and integration
- **Unit Tests**: Test business logic in isolation
- **Edge Cases**: Leap years, same dates, invalid inputs

## 📚 Learning Resources

This project demonstrates:

1. **Clean Architecture**: Separation of concerns
2. **Service Pattern**: Business logic isolation
3. **Progressive Enhancement**: Works without JS
4. **State Management**: Cookies + URL params
5. **TypeScript**: Type-safe frontend code
6. **Accessibility**: WCAG compliance
7. **Testing**: Feature and unit tests

## 🤝 Contributing

This is an educational project. Feel free to fork and experiment!

## 📄 License

Open source under the MIT License.

---

**Built with ❤️ using Laravel 11, TypeScript, and Tailwind CSS**
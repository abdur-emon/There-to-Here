import './bootstrap';
import { calculateDateDistance, isValidDateString } from '@/utils/dateDistance';
import { getInitialState, saveState, applyTheme } from '@/utils/state';
import type { AppState, DateDistanceResult } from '@/types';

/**
 * Main Application
 *
 * Architecture:
 * 1. Hydrate state from server-rendered data
 * 2. Set up event listeners
 * 3. Handle form submission
 * 4. Update UI reactively
 * 5. Persist state to cookies and URL
 */

// Extend Window interface for initial state
declare global {
  interface Window {
    __INITIAL_STATE__?: AppState;
  }
}

class DateDistanceApp {
  private state: AppState;

  // DOM Elements
  private form: HTMLFormElement;
  private targetDateInput: HTMLInputElement;
  private fromDateInput: HTMLInputElement;
  private useFromDateCheckbox: HTMLInputElement;
  private fromDateContainer: HTMLElement;
  private themeToggle: HTMLButtonElement;
  private resultContainer: HTMLElement;

  constructor() {
    // Initialize state from server or URL/cookies
    this.state = window.__INITIAL_STATE__ || getInitialState();

    // Get DOM elements
    this.form = document.getElementById('date-form') as HTMLFormElement;
    this.targetDateInput = document.getElementById('target-date') as HTMLInputElement;
    this.fromDateInput = document.getElementById('from-date') as HTMLInputElement;
    this.useFromDateCheckbox = document.getElementById('use-from-date') as HTMLInputElement;
    this.fromDateContainer = document.getElementById('from-date-container') as HTMLElement;
    this.themeToggle = document.getElementById('theme-toggle') as HTMLButtonElement;
    this.resultContainer = document.getElementById('result-container') as HTMLElement;

    this.init();
  }

  private init(): void {
    // Apply initial theme
    applyTheme(this.state.theme);

    // Set up event listeners
    this.setupEventListeners();
  }

  private setupEventListeners(): void {
    // Form submission
    this.form.addEventListener('submit', (e) => {
      e.preventDefault();
      this.handleCalculate();
    });

    // From date checkbox toggle
    this.useFromDateCheckbox.addEventListener('change', () => {
      this.toggleFromDate();
    });

    // Theme toggle
    this.themeToggle.addEventListener('click', () => {
      this.toggleTheme();
    });

    // Keyboard shortcut: Cmd+K to focus target date
    document.addEventListener('keydown', (e) => {
      if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
        e.preventDefault();
        this.targetDateInput.focus();
      }
    });

    // Auto-calculate on date change (for better UX)
    this.targetDateInput.addEventListener('change', () => {
      if (this.targetDateInput.value) {
        this.handleCalculate();
      }
    });

    this.fromDateInput.addEventListener('change', () => {
      if (this.targetDateInput.value) {
        this.handleCalculate();
      }
    });
  }

  private handleCalculate(): void {
    const targetDate = this.targetDateInput.value;

    if (!targetDate || !isValidDateString(targetDate)) {
      return;
    }

    const fromDate = this.useFromDateCheckbox.checked && this.fromDateInput.value
      ? this.fromDateInput.value
      : null;

    // Validate from date if provided
    if (fromDate && !isValidDateString(fromDate)) {
      return;
    }

    // Calculate distance
    const result = calculateDateDistance(targetDate, fromDate || undefined);

    // Update state
    this.state.targetDate = targetDate;
    this.state.fromDate = fromDate;
    this.state.result = result;

    // Save state
    saveState({
      targetDate,
      fromDate,
    });

    // Update UI
    this.updateUI(result);
  }

  private updateUI(result: DateDistanceResult): void {
    // Show result container
    this.resultContainer.classList.remove('hidden');

    // Update human readable
    const humanReadable = document.getElementById('human-readable');
    if (humanReadable) {
      humanReadable.textContent = result.humanReadable;
    }

    // Update direction text
    const directionText = document.getElementById('direction-text');
    if (directionText) {
      if (result.direction === 'past') {
        directionText.textContent = 'In the past';
      } else if (result.direction === 'future') {
        directionText.textContent = 'In the future';
      } else {
        directionText.textContent = 'Right now';
      }
    }

    // Update breakdown
    this.updateElement('years', result.years.toString());
    this.updateElement('months', result.months.toString());
    this.updateElement('days', result.days.toString());

    // Update totals
    this.updateElement('total-days', result.totalDays.toLocaleString());
    this.updateElement('total-weeks', result.totalWeeks.toLocaleString());
    this.updateElement('total-hours', result.totalHours.toLocaleString());
    this.updateElement('total-seconds', result.totalSeconds.toLocaleString());
  }

  private updateElement(id: string, value: string): void {
    const element = document.getElementById(id);
    if (element) {
      element.textContent = value;
    }
  }

  private toggleFromDate(): void {
    if (this.useFromDateCheckbox.checked) {
      this.fromDateContainer.classList.remove('hidden');
    } else {
      this.fromDateContainer.classList.add('hidden');
      this.fromDateInput.value = '';
      this.state.fromDate = null;
      saveState({ fromDate: null });

      // Recalculate if we have a target date
      if (this.targetDateInput.value) {
        this.handleCalculate();
      }
    }
  }

  private toggleTheme(): void {
    const newTheme = this.state.theme === 'dark' ? 'light' : 'dark';
    this.state.theme = newTheme;

    applyTheme(newTheme);
    saveState({ theme: newTheme });

    // Update theme icons
    const darkIcon = document.getElementById('theme-icon-dark');
    const lightIcon = document.getElementById('theme-icon-light');

    if (darkIcon && lightIcon) {
      if (newTheme === 'dark') {
        darkIcon.classList.remove('hidden');
        lightIcon.classList.add('hidden');
      } else {
        darkIcon.classList.add('hidden');
        lightIcon.classList.remove('hidden');
      }
    }
  }
}

// Initialize app when DOM is ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => {
    new DateDistanceApp();
  });
} else {
  new DateDistanceApp();
}

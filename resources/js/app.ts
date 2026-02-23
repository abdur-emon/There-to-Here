import './bootstrap';
import { calculateDateDistance, isValidDateString } from '@/utils/dateDistance';
import { getInitialState, saveState, clearState } from '@/utils/state';
import type { AppState, DateDistanceResult } from '@/types';

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
  private resultContainer: HTMLElement;

  // Auth only elements
  private resetButton: HTMLButtonElement | null;
  private copyButton: HTMLButtonElement | null;
  private shareButton: HTMLButtonElement | null;

  constructor() {
    this.state = window.__INITIAL_STATE__ || getInitialState();

    this.form = document.getElementById('date-form') as HTMLFormElement;
    this.targetDateInput = document.getElementById('target-date') as HTMLInputElement;
    this.fromDateInput = document.getElementById('from-date') as HTMLInputElement;
    this.useFromDateCheckbox = document.getElementById('use-from-date') as HTMLInputElement;
    this.fromDateContainer = document.getElementById('from-date-container') as HTMLElement;
    this.resultContainer = document.getElementById('result-container') as HTMLElement;

    this.resetButton = document.getElementById('reset-button') as HTMLButtonElement | null;
    this.copyButton = document.getElementById('copy-button') as HTMLButtonElement | null;
    this.shareButton = document.getElementById('share-button') as HTMLButtonElement | null;

    this.init();
  }

  private init(): void {
    this.setupEventListeners();
  }

  private setupEventListeners(): void {
    this.form.addEventListener('submit', (e) => {
      e.preventDefault();
      this.handleCalculate();
    });

    this.useFromDateCheckbox.addEventListener('change', () => {
      this.toggleFromDate();
    });

    document.addEventListener('keydown', (e) => {
      if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
        e.preventDefault();
        this.targetDateInput.focus();
      }
    });

    // Automatic calculations removed as per request.
    // Calculations only trigger on form submit (Process button).

    if (this.resetButton) {
      this.resetButton.addEventListener('click', () => this.handleReset());
    }

    if (this.copyButton) {
      this.copyButton.addEventListener('click', () => this.handleCopy());
    }

    if (this.shareButton) {
      this.shareButton.addEventListener('click', () => this.handleShare());
    }
  }

  private handleCalculate(): void {
    const targetDate = this.targetDateInput.value;

    if (!targetDate || !isValidDateString(targetDate)) {
      return;
    }

    const fromDate = this.useFromDateCheckbox.checked && this.fromDateInput.value
      ? this.fromDateInput.value
      : null;

    if (fromDate && !isValidDateString(fromDate)) {
      return;
    }

    const result = calculateDateDistance(targetDate, fromDate || undefined);

    this.state.targetDate = targetDate;
    this.state.fromDate = fromDate;
    this.state.result = result;

    saveState({
      targetDate,
      fromDate,
    });

    this.updateUI(result);
  }

  private updateUI(result: DateDistanceResult): void {
    this.resultContainer.classList.remove('hidden');

    const humanReadable = document.getElementById('human-readable');
    if (humanReadable) humanReadable.textContent = result.humanReadable;

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

    this.updateElement('years', result.years.toString());
    this.updateElement('months', result.months.toString());
    this.updateElement('days', result.days.toString());

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
    }
  }

  private handleReset(): void {
    clearState();

    // Clear inputs
    this.targetDateInput.value = '';
    this.fromDateInput.value = '';
    this.useFromDateCheckbox.checked = false;
    this.fromDateContainer.classList.add('hidden');

    // Reset state
    this.state = getInitialState();

    // Hide results
    this.resultContainer.classList.add('hidden');

    // Remove query params from URL without reload
    window.history.pushState({}, '', window.location.pathname);
  }

  private async handleCopy(): Promise<void> {
    if (!this.state.result) return;

    const textToCopy = `${this.state.result.humanReadable}\n\n` +
      `Breakdown:\n` +
      `- ${this.state.result.years} Years\n` +
      `- ${this.state.result.months} Months\n` +
      `- ${this.state.result.days} Days\n\n` +
      `Totals:\n` +
      `- ${this.state.result.totalDays.toLocaleString()} Days\n` +
      `- ${this.state.result.totalWeeks.toLocaleString()} Weeks\n` +
      `- ${this.state.result.totalHours.toLocaleString()} Hours`;

    try {
      await navigator.clipboard.writeText(textToCopy);
      const copyText = document.getElementById('copy-text');
      if (copyText) {
        const originalText = copyText.textContent;
        copyText.textContent = 'Copied!';
        setTimeout(() => {
          copyText.textContent = originalText;
        }, 2000);
      }
    } catch (err) {
      console.error('Failed to copy text: ', err);
    }
  }

  private async handleShare(): Promise<void> {
    const url = window.location.href;
    const title = 'Date Distance Calculator Result';
    let text = 'Check out this date calculation!';
    if (this.state.result) {
      text = this.state.result.humanReadable;
    }

    if (navigator.share) {
      try {
        await navigator.share({
          title,
          text,
          url,
        });
      } catch (err) {
        console.error('Error sharing:', err);
      }
    } else {
      try {
        await navigator.clipboard.writeText(url);
        const shareText = document.getElementById('share-text');
        if (shareText) {
          const originalText = shareText.textContent;
          shareText.textContent = 'Link Copied!';
          setTimeout(() => {
            shareText.textContent = originalText;
          }, 2000);
        }
      } catch (err) {
        console.error('Failed to copy link: ', err);
      }
    }
  }
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => {
    new DateDistanceApp();
  });
} else {
  new DateDistanceApp();
}

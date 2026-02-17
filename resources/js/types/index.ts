/**
 * Type definitions for the date distance calculator
 */

export interface DateDistanceResult {
  years: number;
  months: number;
  days: number;
  totalDays: number;
  totalWeeks: number;
  totalHours: number;
  totalSeconds: number;
  direction: 'past' | 'future' | 'same';
  humanReadable: string;
}

export interface AppState {
  targetDate: string | null;
  fromDate: string | null;
  theme: 'dark' | 'light';
  result: DateDistanceResult | null;
}


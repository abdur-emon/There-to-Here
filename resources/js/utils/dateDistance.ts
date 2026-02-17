/**
 * Date Distance Utility
 * 
 * Client-side date calculations using date-fns v4
 * 
 * Why client-side calculations?
 * - Instant feedback (no server round-trip)
 * - Reduces server load
 * - Works offline
 * - Better UX
 * 
 * Why date-fns?
 * - Tree-shakeable (only import what we use)
 * - Immutable (prevents bugs)
 * - TypeScript native
 * - Handles edge cases (leap years, DST, etc.)
 */

import { 
  differenceInYears, 
  differenceInMonths, 
  differenceInDays,
  differenceInHours,
  differenceInSeconds,
  differenceInWeeks,
  startOfDay,
  parseISO,
  isBefore,
  isSameDay,
  isValid
} from 'date-fns';
import type { DateDistanceResult } from '@/types';

/**
 * Calculate the distance between two dates
 * 
 * @param targetDateStr - Target date in ISO format (YYYY-MM-DD)
 * @param fromDateStr - From date in ISO format (defaults to today)
 * @returns DateDistanceResult object
 */
export function calculateDateDistance(
  targetDateStr: string,
  fromDateStr?: string
): DateDistanceResult {
  // Parse dates and normalize to start of day
  const targetDate = startOfDay(parseISO(targetDateStr));
  const fromDate = fromDateStr 
    ? startOfDay(parseISO(fromDateStr)) 
    : startOfDay(new Date());
  
  // Determine direction
  const direction = getDirection(fromDate, targetDate);
  
  // Calculate years, months, days
  // We need to calculate these step by step to get accurate results
  const totalYears = Math.abs(differenceInYears(targetDate, fromDate));
  
  // Get the date after subtracting years
  const afterYears = new Date(fromDate);
  afterYears.setFullYear(afterYears.getFullYear() + (isBefore(fromDate, targetDate) ? totalYears : -totalYears));
  
  // Calculate remaining months
  const totalMonths = Math.abs(differenceInMonths(targetDate, afterYears));
  
  // Get the date after subtracting months
  const afterMonths = new Date(afterYears);
  afterMonths.setMonth(afterMonths.getMonth() + (isBefore(afterYears, targetDate) ? totalMonths : -totalMonths));
  
  // Calculate remaining days
  const remainingDays = Math.abs(differenceInDays(targetDate, afterMonths));
  
  // Calculate totals
  const totalDays = Math.abs(differenceInDays(targetDate, fromDate));
  const totalWeeks = parseFloat((totalDays / 7).toFixed(2));
  const totalHours = Math.abs(differenceInHours(targetDate, fromDate));
  const totalSeconds = Math.abs(differenceInSeconds(targetDate, fromDate));
  
  return {
    years: totalYears,
    months: totalMonths,
    days: remainingDays,
    totalDays,
    totalWeeks,
    totalHours,
    totalSeconds,
    direction,
    humanReadable: formatHumanReadable(totalYears, totalMonths, remainingDays, direction),
  };
}

/**
 * Determine the direction of the date difference
 */
function getDirection(from: Date, target: Date): 'past' | 'future' | 'same' {
  if (isSameDay(from, target)) {
    return 'same';
  }
  return isBefore(target, from) ? 'past' : 'future';
}

/**
 * Format a human-readable duration string
 * 
 * Examples:
 * - "2 years, 3 months, 10 days ago"
 * - "1 year, 5 months from now"
 * - "Today"
 */
function formatHumanReadable(
  years: number,
  months: number,
  days: number,
  direction: 'past' | 'future' | 'same'
): string {
  if (direction === 'same') {
    return 'Today';
  }
  
  const parts: string[] = [];
  
  if (years > 0) {
    parts.push(`${years} ${years === 1 ? 'year' : 'years'}`);
  }
  
  if (months > 0) {
    parts.push(`${months} ${months === 1 ? 'month' : 'months'}`);
  }
  
  if (days > 0) {
    parts.push(`${days} ${days === 1 ? 'day' : 'days'}`);
  }
  
  if (parts.length === 0) {
    return 'Today';
  }
  
  const formatted = parts.join(', ');
  return `${formatted} ${direction === 'past' ? 'ago' : 'from now'}`;
}

/**
 * Validate a date string
 */
export function isValidDateString(dateStr: string): boolean {
  try {
    const date = parseISO(dateStr);
    return isValid(date);
  } catch {
    return false;
  }
}


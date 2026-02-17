/**
 * State Management Utility
 * 
 * Handles state persistence via:
 * 1. Cookies (for preferences like theme)
 * 2. URL Search Params (for shareable state)
 * 
 * Why both?
 * - Cookies: Persist across sessions, good for preferences
 * - URL Params: Shareable, good for application state
 * 
 * Architecture:
 * - Lazy initialization: Read state only when needed
 * - Sync both ways: URL ↔ Cookies
 * - Type-safe: TypeScript ensures correctness
 */

import Cookies from 'js-cookie';
import type { AppState } from '@/types';

const COOKIE_KEYS = {
  TARGET_DATE: 'howlong_target_date',
  FROM_DATE: 'howlong_from_date',
  THEME: 'howlong_theme',
} as const;

const URL_PARAMS = {
  DATE: 'date',
  FROM: 'from',
  THEME: 'theme',
} as const;

/**
 * Get initial state from URL params and cookies
 * 
 * Priority: URL params > Cookies > Defaults
 * 
 * Why this priority?
 * - URL params are explicit user intent (shared link)
 * - Cookies are user preferences
 * - Defaults are fallback
 */
export function getInitialState(): AppState {
  const urlParams = new URLSearchParams(window.location.search);
  
  // Get target date (URL > Cookie > null)
  const targetDate = 
    urlParams.get(URL_PARAMS.DATE) || 
    Cookies.get(COOKIE_KEYS.TARGET_DATE) || 
    null;
  
  // Get from date (URL > Cookie > null)
  const fromDate = 
    urlParams.get(URL_PARAMS.FROM) || 
    Cookies.get(COOKIE_KEYS.FROM_DATE) || 
    null;
  
  // Get theme (URL > Cookie > 'dark')
  const themeParam = urlParams.get(URL_PARAMS.THEME) || Cookies.get(COOKIE_KEYS.THEME);
  const theme = (themeParam === 'light' ? 'light' : 'dark') as 'dark' | 'light';
  
  return {
    targetDate,
    fromDate,
    theme,
    result: null,
  };
}

/**
 * Save state to cookies and URL
 * 
 * @param state - Application state to persist
 * @param updateUrl - Whether to update the URL (default: true)
 */
export function saveState(state: Partial<AppState>, updateUrl: boolean = true): void {
  // Save to cookies (30 days expiry)
  if (state.targetDate !== undefined) {
    if (state.targetDate) {
      Cookies.set(COOKIE_KEYS.TARGET_DATE, state.targetDate, { expires: 30 });
    } else {
      Cookies.remove(COOKIE_KEYS.TARGET_DATE);
    }
  }
  
  if (state.fromDate !== undefined) {
    if (state.fromDate) {
      Cookies.set(COOKIE_KEYS.FROM_DATE, state.fromDate, { expires: 30 });
    } else {
      Cookies.remove(COOKIE_KEYS.FROM_DATE);
    }
  }
  
  if (state.theme !== undefined) {
    Cookies.set(COOKIE_KEYS.THEME, state.theme, { expires: 365 });
  }
  
  // Update URL if requested
  if (updateUrl) {
    updateUrlParams(state);
  }
}

/**
 * Update URL search parameters without page reload
 * 
 * Uses History API to update URL without triggering navigation
 */
function updateUrlParams(state: Partial<AppState>): void {
  const url = new URL(window.location.href);
  const params = url.searchParams;
  
  // Update or remove date param
  if (state.targetDate !== undefined) {
    if (state.targetDate) {
      params.set(URL_PARAMS.DATE, state.targetDate);
    } else {
      params.delete(URL_PARAMS.DATE);
    }
  }
  
  // Update or remove from param
  if (state.fromDate !== undefined) {
    if (state.fromDate) {
      params.set(URL_PARAMS.FROM, state.fromDate);
    } else {
      params.delete(URL_PARAMS.FROM);
    }
  }
  
  // Update theme param
  if (state.theme !== undefined) {
    params.set(URL_PARAMS.THEME, state.theme);
  }
  
  // Update URL without reload
  window.history.replaceState({}, '', url.toString());
}

/**
 * Apply theme to document
 * 
 * @param theme - 'dark' or 'light'
 */
export function applyTheme(theme: 'dark' | 'light'): void {
  if (theme === 'dark') {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
  }
}


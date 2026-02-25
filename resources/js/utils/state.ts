import Cookies from 'js-cookie';
import type { AppState } from '@/types';

const COOKIE_KEYS = {
  TARGET_DATE: 'howlong_target_date',
  FROM_DATE: 'howlong_from_date',
} as const;

const URL_PARAMS = {
  DATE: 'date',
  FROM: 'from',
} as const;

export function getInitialState(): AppState {
  const urlParams = new URLSearchParams(window.location.search);

  const targetDate =
    urlParams.get(URL_PARAMS.DATE) ||
    Cookies.get(COOKIE_KEYS.TARGET_DATE) ||
    null;

  const fromDate =
    urlParams.get(URL_PARAMS.FROM) ||
    Cookies.get(COOKIE_KEYS.FROM_DATE) ||
    null;

  return {
    targetDate,
    fromDate,
    result: null,
  };
}

export function saveState(state: Partial<AppState>, updateUrl: boolean = true): void {
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

  if (updateUrl) {
    updateUrlParams(state);
  }
}

function updateUrlParams(state: Partial<AppState>): void {
  const url = new URL(window.location.href);
  const params = url.searchParams;

  if (state.targetDate !== undefined) {
    if (state.targetDate) {
      params.set(URL_PARAMS.DATE, state.targetDate);
    } else {
      params.delete(URL_PARAMS.DATE);
    }
  }

  if (state.fromDate !== undefined) {
    if (state.fromDate) {
      params.set(URL_PARAMS.FROM, state.fromDate);
    } else {
      params.delete(URL_PARAMS.FROM);
    }
  }

  window.history.replaceState({}, '', url.toString());
}

export function clearState(): void {
  Cookies.remove(COOKIE_KEYS.TARGET_DATE);
  Cookies.remove(COOKIE_KEYS.FROM_DATE);

  const url = new URL(window.location.href);
  url.searchParams.delete(URL_PARAMS.DATE);
  url.searchParams.delete(URL_PARAMS.FROM);
  window.history.replaceState({}, '', url.toString());
}

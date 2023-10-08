// Check if dark mode is stored in a cookie and apply it
(() => {
  'use strict';

  const getStoredTheme = () => localStorage.getItem('theme');
  const setStoredTheme = (theme) => localStorage.setItem('theme', theme);

  const getPreferredTheme = () => {
    const storedTheme = getStoredTheme();
    if (storedTheme) {
      return storedTheme;
    }

    return window.matchMedia('(prefers-color-scheme: dark)').matches
      ? 'dark'
      : 'light';
  };

  const setTheme = (theme) => {
    if (
      theme === 'auto' &&
      window.matchMedia('(prefers-color-scheme: dark)').matches
    ) {
      document.documentElement.setAttribute('theme', 'dark');
    } else {
      document.documentElement.setAttribute('theme', theme);
    }
  };

  setTheme(getPreferredTheme());

  const showActiveTheme = (theme, focus = false) => {
    const themeSwitcher = document.getElementById('darkModeToggle');

    if (!themeSwitcher) {
      return;
    }

    if (theme === 'dark') {
      themeSwitcher.checked = true;
    } else {
      themeSwitcher.checked = false;
    }

    if (focus) {
      themeSwitcher.focus();
    }
  };

  showActiveTheme(getPreferredTheme());

  window
    .matchMedia('(prefers-color-scheme: dark)')
    .addEventListener('change', () => {
      const storedTheme = getStoredTheme();
      if (storedTheme !== 'light' && storedTheme !== 'dark') {
        setTheme(getPreferredTheme());
      }
    });

  window.addEventListener('DOMContentLoaded', () => {
    showActiveTheme(getPreferredTheme());

    document.getElementById('darkModeToggle').addEventListener('change', () => {
      const themeSwitcher = document.getElementById('darkModeToggle');
      var theme = 'light';
      if (themeSwitcher.checked) {
        theme = 'dark';
      }

      setStoredTheme(theme);
      setTheme(theme);
      showActiveTheme(theme, true);
    });
  });
})();

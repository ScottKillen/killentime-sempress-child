// Check if dark mode is stored in a cookie and apply it
const darkModeCookie = getCookie('darkMode');
if (darkModeCookie === 'true') {
  document.documentElement.setAttribute('theme', 'dark');
  document.getElementById('darkModeToggle').checked = true;
}

// Event listener for the toggle button
document
  .getElementById('darkModeToggle')
  .addEventListener('change', function () {
    if (this.checked) {
      document.documentElement.setAttribute('theme', 'dark');
      setCookie('darkMode', 'true', 365); // Store dark mode in a cookie for 365 days
    } else {
      document.documentElement.setAttribute('theme', 'light');
      setCookie('darkMode', 'false', 365);
    }
  });

// Function to set a cookie
function setCookie(name, value, days) {
  const expires = new Date();
  expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
  document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
}

// Function to get a cookie value
function getCookie(name) {
  const cookieName = `${name}=`;
  const cookies = document.cookie.split(';');
  for (let i = 0; i < cookies.length; i++) {
    let cookie = cookies[i];
    while (cookie.charAt(0) === ' ') {
      cookie = cookie.substring(1);
    }
    if (cookie.indexOf(cookieName) === 0) {
      return cookie.substring(cookieName.length, cookie.length);
    }
  }
  return '';
}

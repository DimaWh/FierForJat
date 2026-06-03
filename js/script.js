// ===== THEME =====
const themeToggle = document.getElementById('themeToggle');

function setTheme(mode) {
    document.body.classList.toggle('light', mode === 'light');
    if (themeToggle) themeToggle.textContent = mode === 'light' ? '☀️' : '🌙';
    localStorage.setItem('theme', mode);
}

if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        setTheme(document.body.classList.contains('light') ? 'dark' : 'light');
    });
}

// ===== HAMBURGER =====
const hamburger = document.getElementById('hamburger');
const navLinks   = document.querySelector('.nav-links');
if (hamburger && navLinks) {
    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('open');
        hamburger.textContent = navLinks.classList.contains('open') ? '✕' : '☰';
    });
    // Close menu when clicking a link
    navLinks.querySelectorAll('a').forEach(a => {
        a.addEventListener('click', () => {
            navLinks.classList.remove('open');
            hamburger.textContent = '☰';
        });
    });
}

// ===== AUTO HIDE MESSAGES =====
document.querySelectorAll('.msg').forEach(msg => {
    setTimeout(() => {
        msg.style.transition = 'opacity 0.5s';
        msg.style.opacity = '0';
        setTimeout(() => msg.remove(), 500);
    }, 4000);
});

// ===== INIT =====
setTheme(localStorage.getItem('theme') || 'dark');
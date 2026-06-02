const body = document.body;
const themeToggle = document.getElementById('themeToggle');
const langToggle = document.getElementById('langToggle');
const supportedLanguages = ['ro', 'en', 'ru'];
const defaultLanguage = 'ro';

function setTheme(mode) {
    if(mode === 'light') {
        body.classList.add('light');
        themeToggle.textContent = '☀️';
    } else {
        body.classList.remove('light');
        themeToggle.textContent = '🌙';
    }
    localStorage.setItem('theme', mode);
}

function setLang(lang) {
    if(!supportedLanguages.includes(lang)) {
        lang = defaultLanguage;
    }
    document.documentElement.lang = lang;
    langToggle.textContent = lang.toUpperCase();
    localStorage.setItem('lang', lang);

    document.querySelectorAll('[data-ro]').forEach(element => {
        const value = element.dataset[lang];
        if(value !== undefined) {
            element.textContent = value;
        }
    });

    document.querySelectorAll('[data-placeholder-ro]').forEach(element => {
        const value = element.dataset[lang + 'Placeholder'];
        if(value !== undefined) {
            element.placeholder = value;
        }
    });
}

function initThemeAndLang() {
    const storedTheme = localStorage.getItem('theme') || 'dark';
    const storedLang = localStorage.getItem('lang') || defaultLanguage;
    setTheme(storedTheme);
    setLang(storedLang);
}

if(themeToggle) {
    themeToggle.addEventListener('click', () => {
        const nextTheme = body.classList.contains('light') ? 'dark' : 'light';
        setTheme(nextTheme);
    });
}

if(langToggle) {
    langToggle.addEventListener('click', () => {
        const current = localStorage.getItem('lang') || defaultLanguage;
        const nextIndex = (supportedLanguages.indexOf(current) + 1) % supportedLanguages.length;
        setLang(supportedLanguages[nextIndex]);
    });
}

initThemeAndLang();

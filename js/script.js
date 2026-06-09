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

// ===== LANGUAGE =====
const languageSelect = document.getElementById('langSelect');
const translations = {
    en: {
        home: 'Home',
        plans: 'Plans',
        contact: 'Contact',
        dashboard: 'Dashboard',
        logout: 'Logout',
        login: 'Login',
        register: 'Register',
        'hero.title': 'Rust Server Hosting',
        'hero.sub': 'Maximum performance. Guaranteed uptime. Online in 60 seconds.',
        'hero.action.start': 'Get Started',
        'hero.action.view': 'View plans',
        'panel.label': 'Instant plans',
        'panel.heading': 'Choose the perfect server',
        'panel.note': 'Order fast, get dashboard access immediately, and manage the server from one place.',
        'feature.servers': 'European Servers',
        'feature.billing': 'Monthly billing',
        'feature.rust': 'Rust only',
        'feature.support': '24/7 Support',
        'plans.heading': 'Our Plans',
        'plans.subtitle': 'Choose the right plan for your community',
        'plan.chooseStarter': 'Choose Starter',
        'plan.choosePro': 'Choose Pro',
        'plan.chooseElite': 'Choose Elite',
        'plan.popular': 'Popular',
        'footer.copyright': '© 2026 FierForjat. All rights reserved.',
        'login.title': 'Login',
        'login.subtitle': 'Welcome back!',
        'login.email': 'EMAIL',
        'login.password': 'PASSWORD',
        'login.password.placeholder': '••••••••',
        'login.submit': 'LOGIN',
        'login.noAccount': "Don't have an account? ",
        'login.register': 'Register',
        'register.title': 'Register',
        'register.subtitle': 'Create your free account',
        'register.username': 'USERNAME',
        'register.email': 'EMAIL',
        'register.password': 'PASSWORD',
        'register.confirmPassword': 'CONFIRM PASSWORD',
        'register.passwordHint': '(at least 6 characters)',
        'register.submit': 'CREATE ACCOUNT',
        'register.haveAccount': 'Already have an account? ',
        'register.login': 'Log in',
        'contact.title': 'Contact',
        'contact.subtitle': "We're here to help",
        'contact.name': 'NAME',
        'contact.email': 'EMAIL',
        'contact.subject': 'SUBJECT',
        'contact.message': 'MESSAGE',
        'contact.message.placeholder': 'Describe your issue or question...',
        'contact.subject.placeholder': 'Choose a subject...',
        'contact.option.technical': 'Technical support',
        'contact.option.billing': 'Billing',
        'contact.option.general': 'General question',
        'contact.option.other': 'Other topic',
        'contact.submit': 'SEND MESSAGE',
        'contact.helpEmail': 'support@fierforjat.md',
        'contact.helpHours': 'Mon–Fri, 09:00 - 18:00',
        'order.heading': 'Order Confirmation',
        'order.subtitle': 'Complete your Rust server order.',
        'order.selectedPlan': 'Selected plan:',
        'order.serverName': 'Server name',
        'order.serverName.placeholder': 'Ex: RustClan01',
        'order.submit': 'Place order',
        'order.back': 'Back to Dashboard',
        'dashboard.header': 'Dashboard',
        'dashboard.greeting': '👋',
        'dashboard.card.username': 'Username',
        'dashboard.card.email': 'Email',
        'dashboard.card.servers': 'Active servers',
        'dashboard.card.status': 'Status',
        'dashboard.status.online': 'Online',
        'dashboard.servers': '🖥️ My Servers',
        'dashboard.terminal.title': 'CMD Dashboard',
        'dashboard.terminal.subtitle': 'Type help for quick commands.',
        'dashboard.terminal.placeholder': 'help, status, servers, details <id>, clear',
        'dashboard.empty': 'You have no active servers.',
        'dashboard.buy': 'Buy a server',
        'dashboard.rename': 'Rename',
        'dashboard.delete': 'Delete',
        'dashboard.cancel': 'Cancel',
        'dashboard.save': 'Save',
        'dashboard.plan': 'Plan:',
        'dashboard.noServers': 'You have no servers in your account.',
        'dashboard.statusMessage': 'You have not created any servers yet.',
        'dashboard.unknownCommand': 'Unknown command: {cmd}. Type help for a list.'
    },
    ro: {
        home: 'Acasă',
        plans: 'Planuri',
        contact: 'Contact',
        dashboard: 'Panou',
        logout: 'Deconectare',
        login: 'Autentificare',
        register: 'Înregistrare',
        'hero.title': 'Găzduire servere Rust',
        'hero.sub': 'Performanță maximă. Garanție uptime. Online în 60 de secunde.',
        'hero.action.start': 'Începe acum',
        'hero.action.view': 'Vezi planuri',
        'panel.label': 'Planuri instant',
        'panel.heading': 'Alege serverul perfect',
        'panel.note': 'Comandă rapid, primești acces la panou imediat și administrezi serverul dintr-un singur loc.',
        'feature.servers': 'Servere europene',
        'feature.billing': 'Facturare lunară',
        'feature.rust': 'Doar Rust',
        'feature.support': 'Suport 24/7',
        'plans.heading': 'Planurile noastre',
        'plans.subtitle': 'Alege planul potrivit pentru comunitatea ta',
        'plan.chooseStarter': 'Alege Starter',
        'plan.choosePro': 'Alege Pro',
        'plan.chooseElite': 'Alege Elite',
        'plan.popular': 'Popular',
        'footer.copyright': '© 2026 FierForjat. Toate drepturile rezervate.',
        'login.title': 'Autentificare',
        'login.subtitle': 'Bine ai revenit!',
        'login.email': 'EMAIL',
        'login.password': 'PAROLĂ',
        'login.password.placeholder': '••••••••',
        'login.submit': 'AUTENTIFICARE',
        'login.noAccount': 'Nu ai un cont? ',
        'login.register': 'Înregistrează-te',
        'register.title': 'Înregistrare',
        'register.subtitle': 'Creează-ți contul gratuit',
        'register.username': 'USERNAME',
        'register.email': 'EMAIL',
        'register.password': 'PAROLĂ',
        'register.confirmPassword': 'CONFIRMĂ PAROLA',
        'register.passwordHint': '(cel puțin 6 caractere)',
        'register.submit': 'CREAZĂ CONT',
        'register.haveAccount': 'Ai deja un cont? ',
        'register.login': 'Autentifică-te',
        'contact.title': 'Contact',
        'contact.subtitle': 'Suntem aici pentru tine',
        'contact.name': 'NUME',
        'contact.email': 'EMAIL',
        'contact.subject': 'SUBIECT',
        'contact.message': 'MESAJ',
        'contact.message.placeholder': 'Descrie problema sau întrebarea ta...',
        'contact.subject.placeholder': 'Alege un subiect...',
        'contact.option.technical': 'Asistență tehnică',
        'contact.option.billing': 'Facturare',
        'contact.option.general': 'Întrebare generală',
        'contact.option.other': 'Alt subiect',
        'contact.submit': 'TRIMITE MESAJ',
        'contact.helpEmail': 'support@fierforjat.md',
        'contact.helpHours': 'Lun–Vin, 09:00 - 18:00',
        'order.heading': 'Confirmare comandă',
        'order.subtitle': 'Finalizează comanda serverului Rust.',
        'order.selectedPlan': 'Plan selectat:',
        'order.serverName': 'Numele serverului',
        'order.serverName.placeholder': 'Ex: RustClan01',
        'order.submit': 'Plasează comanda',
        'order.back': 'Înapoi la Panou',
        'dashboard.header': 'Panou',
        'dashboard.greeting': '👋',
        'dashboard.card.username': 'Username',
        'dashboard.card.email': 'Email',
        'dashboard.card.servers': 'Servere active',
        'dashboard.card.status': 'Stare',
        'dashboard.status.online': 'Online',
        'dashboard.servers': '🖥️ Serverele mele',
        'dashboard.terminal.title': 'Panou CMD',
        'dashboard.terminal.subtitle': 'Tastează help pentru comenzi rapide.',
        'dashboard.terminal.placeholder': 'help, status, servers, details <id>, clear',
        'dashboard.empty': 'Nu ai servere active.',
        'dashboard.buy': 'Cumpără un server',
        'dashboard.rename': 'Redenumește',
        'dashboard.delete': 'Șterge',
        'dashboard.cancel': 'Anulează',
        'dashboard.save': 'Salvează',
        'dashboard.plan': 'Plan:',
        'dashboard.noServers': 'Nu ai servere în contul tău.',
        'dashboard.statusMessage': 'Nu ai creat încă servere.',
        'dashboard.unknownCommand': 'Comandă necunoscută: {cmd}. Tastează help pentru listă.'
    },
    ru: {
        home: 'Главная',
        plans: 'Тарифы',
        contact: 'Контакты',
        dashboard: 'Панель',
        logout: 'Выйти',
        login: 'Войти',
        register: 'Регистрация',
        'hero.title': 'Хостинг серверов Rust',
        'hero.sub': 'Максимальная производительность. Гарантированное время работы. Онлайн за 60 секунд.',
        'hero.action.start': 'Начать',
        'hero.action.view': 'Посмотреть тарифы',
        'panel.label': 'Мгновенные планы',
        'panel.heading': 'Выберите идеальный сервер',
        'panel.note': 'Заказывайте быстро, получайте доступ к панели сразу и управляйте сервером в одном месте.',
        'feature.servers': 'Европейские серверы',
        'feature.billing': 'Ежемесячная оплата',
        'feature.rust': 'Только Rust',
        'feature.support': 'Поддержка 24/7',
        'plans.heading': 'Наши тарифы',
        'plans.subtitle': 'Выберите подходящий план для вашего сообщества',
        'plan.chooseStarter': 'Выбрать Starter',
        'plan.choosePro': 'Выбрать Pro',
        'plan.chooseElite': 'Выбрать Elite',
        'plan.popular': 'Популярно',
        'footer.copyright': '© 2026 FierForjat. Все права защищены.',
        'login.title': 'Войти',
        'login.subtitle': 'С возвращением!',
        'login.email': 'EMAIL',
        'login.password': 'ПАРОЛЬ',
        'login.password.placeholder': '••••••••',
        'login.submit': 'ВОЙТИ',
        'login.noAccount': 'Нет аккаунта? ',
        'login.register': 'Зарегистрироваться',
        'register.title': 'Регистрация',
        'register.subtitle': 'Создайте бесплатный аккаунт',
        'register.username': 'USERNAME',
        'register.email': 'EMAIL',
        'register.password': 'ПАРОЛЬ',
        'register.confirmPassword': 'ПОДТВЕРДИТЕ ПАРОЛЬ',
        'register.passwordHint': '(не менее 6 символов)',
        'register.submit': 'СОЗДАТЬ АККАУНТ',
        'register.haveAccount': 'Уже есть аккаунт? ',
        'register.login': 'Войти',
        'contact.title': 'Контакты',
        'contact.subtitle': 'Мы готовы помочь',
        'contact.name': 'ИМЯ',
        'contact.email': 'EMAIL',
        'contact.subject': 'ТЕМА',
        'contact.message': 'СООБЩЕНИЕ',
        'contact.message.placeholder': 'Опишите вашу проблему или вопрос...',
        'contact.subject.placeholder': 'Выберите тему...',
        'contact.option.technical': 'Техническая поддержка',
        'contact.option.billing': 'Биллинг',
        'contact.option.general': 'Общий вопрос',
        'contact.option.other': 'Другая тема',
        'contact.submit': 'ОТПРАВИТЬ СООБЩЕНИЕ',
        'contact.helpEmail': 'support@fierforjat.md',
        'contact.helpHours': 'Пн–Пт, 09:00 - 18:00',
        'order.heading': 'Подтверждение заказа',
        'order.subtitle': 'Завершите заказ сервера Rust.',
        'order.selectedPlan': 'Выбранный план:',
        'order.serverName': 'Название сервера',
        'order.serverName.placeholder': 'Пример: RustClan01',
        'order.submit': 'Оформить заказ',
        'order.back': 'Назад к панели',
        'dashboard.header': 'Панель',
        'dashboard.greeting': '👋',
        'dashboard.card.username': 'Username',
        'dashboard.card.email': 'Email',
        'dashboard.card.servers': 'Активные серверы',
        'dashboard.card.status': 'Статус',
        'dashboard.status.online': 'Онлайн',
        'dashboard.servers': '🖥️ Мои серверы',
        'dashboard.terminal.title': 'CMD Панель',
        'dashboard.terminal.subtitle': 'Введите help для списка команд.',
        'dashboard.terminal.placeholder': 'help, status, servers, details <id>, clear',
        'dashboard.empty': 'У вас нет активных серверов.',
        'dashboard.buy': 'Купить сервер',
        'dashboard.rename': 'Переименовать',
        'dashboard.delete': 'Удалить',
        'dashboard.cancel': 'Отмена',
        'dashboard.save': 'Сохранить',
        'dashboard.plan': 'План:',
        'dashboard.noServers': 'У вас нет серверов в аккаунте.',
        'dashboard.statusMessage': 'Вы ещё не создали серверы.',
        'dashboard.unknownCommand': 'Неизвестная команда: {cmd}. Введите help для списка.'
    }
};

const messageTranslation = {
    'Passwords do not match!': {
        ro: 'Parolele nu se potrivesc!',
        ru: 'Пароли не совпадают!'
    },
    'Account created successfully! You can now log in.': {
        ro: 'Cont creat cu succes! Te poți autentifica acum.',
        ru: 'Аккаунт успешно создан! Теперь вы можете войти.'
    },
    'Please fill out all required fields!': {
        ro: 'Completează toate câmpurile obligatorii!',
        ru: 'Пожалуйста, заполните все поля!'
    },
    'The email address is not valid!': {
        ro: 'Adresa de email nu este validă!',
        ru: 'Адрес электронной почты недействителен!'
    },
    'Invalid plan. Please choose a valid plan.': {
        ro: 'Plan invalid. Te rugăm să alegi un plan valid.',
        ru: 'Неверный план. Пожалуйста, выберите действительный план.'
    },
    'Your message has been sent successfully! We will contact you shortly.': {
        ro: 'Mesajul a fost trimis cu succes! Te vom contacta în scurt timp.',
        ru: 'Ваше сообщение успешно отправлено! Мы свяжемся с вами в ближайшее время.'
    }
};

function translatePage(lang) {
    document.documentElement.lang = lang;
    document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.dataset.i18n;
        if (translations[lang] && translations[lang][key]) {
            el.textContent = translations[lang][key];
        }
    });
    document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
        const key = el.dataset.i18nPlaceholder;
        if (translations[lang] && translations[lang][key]) {
            el.placeholder = translations[lang][key];
        }
    });
    document.querySelectorAll('[data-i18n-option]').forEach(option => {
        const key = option.dataset.i18nOption;
        if (translations[lang] && translations[lang][key]) {
            option.textContent = translations[lang][key];
        }
    });
    document.querySelectorAll('.msg').forEach(msg => {
        const original = msg.textContent.trim();
        const translated = messageTranslation[original] ? messageTranslation[original][lang] : null;
        if (translated) {
            msg.textContent = translated;
        }
    });
}

function setLanguage(lang) {
    if (!translations[lang]) {
        lang = 'en';
    }
    if (languageSelect) {
        languageSelect.value = lang;
    }
    localStorage.setItem('language', lang);
    translatePage(lang);
}

if (languageSelect) {
    languageSelect.addEventListener('change', event => {
        setLanguage(event.target.value);
    });
}

// ===== HAMBURGER =====
const hamburger = document.getElementById('hamburger');
const navLinks = document.querySelector('.nav-links');
if (hamburger && navLinks) {
    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('open');
        hamburger.textContent = navLinks.classList.contains('open') ? '✕' : '☰';
    });
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
setLanguage(localStorage.getItem('language') || 'en');
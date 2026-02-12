import './bootstrap';

import Alpine from 'alpinejs';

// Check for saved theme preference or respect OS setting
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark');
}

window.Alpine = Alpine;

Alpine.start();

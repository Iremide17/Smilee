require('./bootstrap');

import Nouislider from 'nouislider';
window.nouislider = require('nouislider');

import AOS from 'aos';
AOS.init();

import Choices from 'choices.js';
window.choices = (element) => {
    return new Choices(element, {
        maxItemCount: 3,
        removeItemButton: true,
    });
};

import persist from '@alpinejs/persist';
Alpine.plugin(persist);

import Alpine from 'alpinejs';
Alpine.data('demo', () => ({
    open: false,

    toggle() {
        this.open = !this.open
    }
}));
window.Alpine = Alpine;
Alpine.start();

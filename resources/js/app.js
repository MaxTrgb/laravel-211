import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import {
    Dropdown,
    Ripple,
    initTWE,
} from "tw-elements";

initTWE({
    Dropdown,
    Ripple
});
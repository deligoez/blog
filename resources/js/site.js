import mediumZoom from 'medium-zoom'
import 'vite/dynamic-import-polyfill';
import '../css/tailwind.css';
import Alpine from 'alpinejs';

Alpine.start();

mediumZoom(document.querySelectorAll('[data-zoomable]'), {
    margin: 25,
    background: "rgba(33, 37, 48, 0.50)",
})
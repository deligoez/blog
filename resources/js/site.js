import mediumZoom from 'medium-zoom'
import 'alpinejs'
import 'vite/dynamic-import-polyfill';
import '../css/site.css';

mediumZoom(document.querySelectorAll('[data-zoomable]'), {
    margin: 25,
    background: "rgba(33, 37, 48, 0.50)",
})
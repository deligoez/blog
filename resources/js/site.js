import '../css/site.css';
import 'vite/dynamic-import-polyfill';
import 'alpinejs'
import mediumZoom from "medium-zoom";
import Alpine from 'alpinejs';

Alpine.start();

mediumZoom(document.querySelectorAll('[data-zoomable]'), {
    margin: 25,
    background: "rgba(33, 37, 48, 0.50)",
})
import '../css/site.css';
import 'vite/dynamic-import-polyfill';
import 'alpinejs'
import Zooming from 'zooming'

const zooming = new Zooming({
    customSize: '90%',
    bgOpacity: 0.9,
})

zooming.listen('.img-zoomable')
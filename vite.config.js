import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default {
    plugins: [
        laravel({
            input: ['resources/js/site.js'],
            refresh: [
                'resources/views/**',
                'resources/css/**',
            ],
        }),
        tailwindcss(),
    ],
};

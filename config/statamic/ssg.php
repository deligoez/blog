<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    |
    | This informs the generator where the static site will eventually be hosted.
    | For instance, if you are relying on absolute URLs in your app, this one
    | will be used. It should be an absolute URL, eg. "http://my-app.com"
    |
    */

    'base_url' => config('app.url'),

    /*
    |--------------------------------------------------------------------------
    | Destination Directory
    |--------------------------------------------------------------------------
    |
    | This option defines where the static files will be saved.
    |
    */

    'destination' => storage_path('app/static'),

    /*
    |--------------------------------------------------------------------------
    | Files and Symlinks
    |--------------------------------------------------------------------------
    |
    | You are free to define a set of directories to be copied along with the
    | generated HTML files. For example, you may want to link your CSS,
    | JavaScript, static images, and perhaps any uploaded assets.
    | You may choose to symlink rather than copy.
    |
    */

    'copy' => [
        public_path('build') => 'build',
        public_path('assets') => 'assets',

        public_path('android-chrome-192x192.png') => 'android-chrome-192x192.png',
        public_path('android-chrome-512x512.png') => 'android-chrome-512x512.png',
        public_path('apple-touch-icon.png') => 'apple-touch-icon.png',
        public_path('browserconfig.xml') => 'browserconfig.xml',
        public_path('favicon.ico') => 'favicon.ico',
        public_path('favicon.svg') => 'favicon.svg',
        public_path('favicon-16x16.png') => 'favicon-16x16.png',
        public_path('favicon-32x32.png') => 'favicon-32x32.png',
        public_path('mstile-150x150.png') => 'mstile-150x150.png',
        public_path('robots.txt') => 'robots.txt',
        public_path('safari-pinned-tab.svg') => 'safari-pinned-tab.svg',
        public_path('site.webmanifest') => 'site.webmanifest',

        storage_path('app/public/sitemap') => '/',
    ],

    'symlinks' => [
        // public_path('css') => 'css',
        // public_path('js') => 'js',
    ],

    /*
    |--------------------------------------------------------------------------
    | Additional URLs
    |--------------------------------------------------------------------------
    |
    | Here you may define a list of additional URLs to be generated,
    | such as manually created routes.
    |
    */

    'urls' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Exclude URLs
    |--------------------------------------------------------------------------
    |
    | Here you may define a list of URLs that should not be generated.
    |
    */

    'exclude' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Glide
    |--------------------------------------------------------------------------
    |
    | Glide images are dynamically resized server-side when requesting a URL.
    | On a static site, you would just be serving HTML files without PHP.
    | Glide images will be pre-generated into the given directory.
    |
    */

    'glide' => [
        'directory' => 'img',
    ],

];

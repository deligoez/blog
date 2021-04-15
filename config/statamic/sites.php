<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Sites
    |--------------------------------------------------------------------------
    |
    | Each site should have root URL that is either relative or absolute. Sites
    | are typically used for localization (eg. English/French) but may also
    | be used for related content (eg. different franchise locations).
    |
    */

    'sites' => [

        'en' => [
            'name' => '🇺🇸 English',
            'locale' => 'en_US',
            'url' => '/',
        ],

        'tr' => [
            'name' => '🇹🇷 Türkçe',
            'locale' => 'tr_TR',
            'url' => '/tr/',
        ],

    ],
];

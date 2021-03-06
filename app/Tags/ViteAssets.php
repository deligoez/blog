<?php

namespace App\Tags;

use Illuminate\Support\HtmlString;
use Statamic\Tags\Tags;

class ViteAssets extends Tags
{
    /**
     * The {{ vite_assets }} tag.
     *
     * @return \Illuminate\Support\HtmlString
     * @throws \JsonException
     */
    public function index(): HtmlString
    {
        if (app()->environment('local')) {
            return new HtmlString(<<<HTML
            <script type="module" src="http://localhost:3000/@vite/client"></script>
            <script type="module" src="http://localhost:3000/resources/js/site.js"></script>
        HTML
            );
        }

        $manifest = json_decode(file_get_contents(
            public_path('build/manifest.json')
        ), true, 512, JSON_THROW_ON_ERROR);

        $file = $manifest['resources/js/site.js']['file'];
        $css = $manifest['resources/js/site.js']['css'][0];

        return new HtmlString(<<<HTML
        <script type="module" src="/build/$file"></script>
        <link rel="stylesheet" href="/build/$css">
    HTML
        );
    }
}

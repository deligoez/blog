<?php

namespace App\Tags;

use Statamic\Tags\Tags;
use App\Overrides\OgGeneratorImage as Image;
use State\OgGenerator\Settings;

class OgGenerator extends Tags
{

    public function image()
    {
        $title = $this->context->get('title');
        $filename = $this->context->get('slug') . '.png';

        if(!$title || !$filename) {
            return "";
        }

        $url = asset("assets/{$filename}");

        $this->makeImageIfNotExists($title, $filename);

        return "<img src='{$url}' alt='{$title}' class='{$this->params->get('class', '')}'>";
    }

    public function ogImage()
    {
        $title = $this->context->get('title');
        $filename = $this->context->get('slug') . '.png';

        if(!$title || !$filename) {
            return "";
        }

        $url = asset("assets/{$filename}");

        $this->makeImageIfNotExists($title, $filename);

        return "<meta property='og:image' content='{$url}' />\n" .
               "<meta property='og:image:width' content='1920' />\n" .
               "<meta property='og:image:height' content='1080' />\n" .
               "<meta property='og:image:type' content='image/png' />\n" .
               "<meta name='twitter:image' content='{$url}' />";
    }

    private function makeImageIfNotExists(string $title, string $filename)
    {
        if (file_exists(public_path("assets/{$filename}"))) {
            return;
        }

        Image::fromSettings(Settings::load())->text($title)->save("assets/{$filename}");
    }
}

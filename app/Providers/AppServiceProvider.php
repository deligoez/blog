<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Statamic\Facades\Markdown;
use Statamic\Statamic;
use Statamic\Fieldtypes\Bard\Augmentor;
use App\Tiptap\Nodes\CodeBlockShiki;
use App\Tags\OgGenerator;
use Spatie\CommonMarkShikiHighlighter\HighlightCodeExtension;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        // Override vendor's OgGenerator tag with our custom one that includes twitter:image
        Statamic::booted(function () {
            OgGenerator::register();
        });

        // Register custom Bard button for typographic quotes
        Statamic::script('app', 'cp');

        // Server-side syntax highlighting for Bard codeBlock nodes using Shiki
        Augmentor::replaceExtension('codeBlock', new CodeBlockShiki());

        // Server-side syntax highlighting for Markdown fenced code blocks using Shiki
        // Supports line highlighting with {1,2-5} syntax
        Markdown::addExtension(function () {
            return new HighlightCodeExtension([
                'light' => 'github-light',
                'dark' => 'github-dark',
            ]);
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}

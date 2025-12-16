<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Statamic\Facades\Markdown;
use Statamic\Fieldtypes\Bard\Augmentor;
use Tiptap\Nodes\CodeBlockHighlight;

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

        // Server-side syntax highlighting for Bard codeBlock nodes (Tiptap)
        Augmentor::replaceExtension('codeBlock', new CodeBlockHighlight());

        // Server-side syntax highlighting for Markdown fenced code blocks
        // Add the highlight extension to the default parser
        Markdown::addExtension(function () {
            return new \App\Markdown\HighlightExtension();
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

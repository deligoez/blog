<?php

namespace App\Providers;

use Statamic\Markdown\Parser;
use Statamic\Facades\Markdown;
use Phiki\CommonMark\PhikiExtension;
use Illuminate\Support\ServiceProvider;
use Statamic\Statamic;
use League\CommonMark\Environment\Environment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Statamic::script('app', 'cp');
        // Statamic::style('app', 'cp');

        Markdown::extend('phiki', function (Parser $parser) {
            // Environment'a erişim için parser nesnesini kullanmalıyız
            $environment = $parser->environment();
            $environment->addExtension(new PhikiExtension('github-dark'));

            return $parser;
        });
    }
}

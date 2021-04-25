<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use WithCandour\AardvarkSeo\Http\Controllers\Web\SitemapController;
use WithCandour\AardvarkSeo\Sitemaps\Sitemap;

class GenerateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap.xml using Aardvark SEO';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemapController = new SitemapController();

        Storage::disk('public')->put('sitemap/sitemap.xml', $sitemapController->index()->original);

        foreach (Sitemap::all() as $sitemap) {
            Storage::disk('public')->put('sitemap/' .$sitemap->route, $sitemapController->single($sitemap->handle)->original);
        }

        return 0;
    }
}

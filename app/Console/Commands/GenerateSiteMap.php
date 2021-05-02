<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
    protected $description = 'Rename/Move sitemap.xml';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {

        rename(storage_path('app/static/sitemap.xml'),storage_path('app/static/sitemap'));
        rename(storage_path('app/static/sitemap/index.html'),storage_path('app/static/sitemap.xml'));
        rmdir(storage_path('app/static/sitemap'));

        return 0;
    }
}

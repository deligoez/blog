<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Statamic\Facades\Entry;
use App\Overrides\OgGeneratorImage as Image;
use State\OgGenerator\Settings;

class GenerateOgImages extends Command
{
    protected $signature = 'og:generate {--force : Regenerate all images}';
    protected $description = 'Generate missing OG images for all entries';

    public function handle()
    {
        $force = $this->option('force');
        $entries = Entry::query()
            ->whereIn('collection', ['articles', 'snippets', 'pages', 'projects'])
            ->get();

        $generated = 0;
        $skipped = 0;

        foreach ($entries as $entry) {
            $title = $entry->get('title');
            $slug = $entry->slug();
            $filename = "assets/{$slug}.png"; // Will be saved as .jpg by OgGeneratorImage
            $jpgFilepath = public_path("assets/{$slug}.jpg");

            if (!$title) {
                $this->line("Skipping {$slug} - no title");
                $skipped++;
                continue;
            }

            if (file_exists($jpgFilepath) && !$force) {
                $this->line("Skipping {$slug}.jpg - already exists");
                $skipped++;
                continue;
            }

            try {
                Image::fromSettings(Settings::load())
                    ->text($title)
                    ->save($filename);

                $this->info("Generated: {$slug}.jpg");
                $generated++;
            } catch (\Exception $e) {
                $this->error("Failed to generate {$slug}.jpg: " . $e->getMessage());
            }
        }

        $this->newLine();
        $this->info("Generated: {$generated} images");
        $this->info("Skipped: {$skipped} images");
    }
}

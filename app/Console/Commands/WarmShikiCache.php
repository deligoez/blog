<?php

namespace App\Console\Commands;

use App\Support\ShikiCache;
use Illuminate\Console\Command;
use Spatie\ShikiPhp\Shiki;
use Statamic\Facades\Entry;

class WarmShikiCache extends Command
{
    protected $signature = 'shiki:warm {--article= : Specific article slug to warm}';

    protected $description = 'Pre-warm the Shiki syntax highlighting cache for all articles';

    protected ?Shiki $shiki = null;

    public function handle(): int
    {
        $this->shiki = new Shiki([
            'light' => 'github-light',
            'dark' => 'github-dark',
        ]);

        $query = Entry::query()->where('collection', 'articles');

        if ($slug = $this->option('article')) {
            $query->where('slug', $slug);
        }

        $entries = $query->get();

        $this->info("Processing {$entries->count()} articles...");

        $totalBlocks = 0;
        $cachedBlocks = 0;

        foreach ($entries as $entry) {
            $content = $entry->get('content');
            if (!is_array($content)) {
                continue;
            }

            $this->line("  Processing: {$entry->slug()}");
            [$processed, $cached] = $this->processContent($content);
            $totalBlocks += $processed;
            $cachedBlocks += $cached;
        }

        $this->newLine();
        $this->info("Done! Processed {$totalBlocks} code blocks, {$cachedBlocks} newly cached.");

        return Command::SUCCESS;
    }

    protected function processContent(array $content): array
    {
        $processed = 0;
        $cached = 0;

        foreach ($content as $node) {
            if (($node['type'] ?? null) === 'codeBlock') {
                $code = $node['content'][0]['text'] ?? '';
                $language = $node['attrs']['language'] ?? 'php';
                $highlightLines = [];
                $focusLines = [];

                if (empty($code)) {
                    continue;
                }

                // Parse fence syntax if present (same logic as CodeBlockShiki)
                if (preg_match('/^```(\w+)?(\{[^}]+\})?(\{[^}]+\})?\s*\n/', $code, $matches)) {
                    if (!empty($matches[1])) {
                        $language = $matches[1];
                    }
                    if (!empty($matches[2])) {
                        $highlightLines = $this->parseLineNumbers(trim($matches[2], '{}'));
                    }
                    if (!empty($matches[3])) {
                        $focusLines = $this->parseLineNumbers(trim($matches[3], '{}'));
                    }
                    $code = preg_replace('/^```[^\n]*\n/', '', $code);
                    $code = preg_replace('/\n```\s*$/', '', $code);
                }

                $processed++;

                // Same cache key format as CodeBlockShiki
                $cacheKey = $code . $language . json_encode($highlightLines) . json_encode($focusLines);

                if (!ShikiCache::has($cacheKey)) {
                    try {
                        $highlighted = $this->shiki->highlightCode($code, $language, options: [
                            'highlightLines' => $highlightLines,
                            'focusLines' => $focusLines,
                        ]);
                        ShikiCache::put($cacheKey, $highlighted);
                        $cached++;
                        $this->output->write('.');
                    } catch (\Exception $e) {
                        $this->output->write('x');
                    }
                } else {
                    $this->output->write('c');
                }
            }

            // Process nested content (e.g., in sets)
            if (isset($node['content']) && is_array($node['content'])) {
                [$nestedProcessed, $nestedCached] = $this->processContent($node['content']);
                $processed += $nestedProcessed;
                $cached += $nestedCached;
            }
        }

        return [$processed, $cached];
    }

    protected function parseLineNumbers(string $spec): array
    {
        $lines = [];
        foreach (explode(',', $spec) as $part) {
            $part = trim($part);
            if (str_contains($part, '-')) {
                [$start, $end] = explode('-', $part);
                for ($i = (int) $start; $i <= (int) $end; $i++) {
                    $lines[] = $i;
                }
            } elseif (is_numeric($part)) {
                $lines[] = (int) $part;
            }
        }
        return $lines;
    }
}

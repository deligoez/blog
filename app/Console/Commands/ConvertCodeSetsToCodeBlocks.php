<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Statamic\Facades\Entry;
use Statamic\Facades\YAML;

class ConvertCodeSetsToCodeBlocks extends Command
{
    protected $signature = 'content:convert-code-sets {--dry-run : Show what would be changed without saving}';

    protected $description = 'Convert custom code sets to native Bard codeBlocks';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');

        $entries = Entry::query()->where('collection', 'articles')->get();

        $this->info("Processing {$entries->count()} articles...");

        $totalConverted = 0;

        foreach ($entries as $entry) {
            $content = $entry->get('content');
            if (!is_array($content)) {
                continue;
            }

            $converted = 0;
            $newContent = $this->processContent($content, $converted);

            if ($converted > 0) {
                $this->line("  {$entry->slug()}: {$converted} code set(s) converted");
                $totalConverted += $converted;

                if (!$dryRun) {
                    // Get the file path and update directly
                    $path = $entry->path();
                    $fileContent = File::get($path);

                    // Parse existing YAML front matter
                    if (preg_match('/^---\n(.*?)\n---\n?/s', $fileContent, $matches)) {
                        $data = YAML::parse($matches[1]);
                        $data['content'] = $newContent;

                        $newFileContent = "---\n" . YAML::dump($data) . "---\n";
                        File::put($path, $newFileContent);
                    }
                }
            }
        }

        $this->newLine();
        if ($dryRun) {
            $this->info("Dry run complete. Would convert {$totalConverted} code set(s).");
        } else {
            $this->info("Done! Converted {$totalConverted} code set(s).");
        }

        return Command::SUCCESS;
    }

    protected function processContent(array $content, int &$converted): array
    {
        $newContent = [];

        foreach ($content as $node) {
            // Check if this is a custom code set
            if (($node['type'] ?? null) === 'set' &&
                ($node['attrs']['values']['type'] ?? null) === 'code') {

                $codeMarkdown = $node['attrs']['values']['code'] ?? '';

                // Convert markdown code block to native codeBlock
                $codeBlock = $this->convertToCodeBlock($codeMarkdown);

                if ($codeBlock) {
                    $newContent[] = $codeBlock;
                    $converted++;
                } else {
                    // Keep original if conversion fails
                    $newContent[] = $node;
                }
            } else {
                $newContent[] = $node;
            }
        }

        return $newContent;
    }

    protected function convertToCodeBlock(string $markdown): ?array
    {
        // Match markdown fence: ```lang{meta}\ncode\n```
        if (!preg_match('/^```(\w*[^\n]*)\n(.*?)```\s*$/s', trim($markdown), $matches)) {
            return null;
        }

        $langLine = trim($matches[1]); // e.g., "php{2,4-6}" or "php" or ""
        $code = $matches[2];

        // Remove trailing newline from code
        $code = rtrim($code, "\n");

        // Extract base language (without meta info)
        $language = 'php'; // default
        if (preg_match('/^(\w+)/', $langLine, $langMatch)) {
            $language = $langMatch[1];
        }

        // If there's meta info (like {2,4-6}), prepend it to the code
        // so our CodeBlockShiki extension can parse it
        if (preg_match('/\{[^}]+\}/', $langLine)) {
            $code = "```{$langLine}\n{$code}\n```";
        }

        return [
            'type' => 'codeBlock',
            'attrs' => [
                'language' => $language,
            ],
            'content' => [
                [
                    'type' => 'text',
                    'text' => $code,
                ],
            ],
        ];
    }
}

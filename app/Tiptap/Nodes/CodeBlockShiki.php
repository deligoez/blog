<?php

namespace App\Tiptap\Nodes;

use App\Support\ShikiCache;
use Exception;
use Spatie\ShikiPhp\Shiki;
use Tiptap\Nodes\CodeBlock;

class CodeBlockShiki extends CodeBlock
{
    protected static ?Shiki $shiki = null;

    public function renderHTML($node, $HTMLAttributes = [])
    {
        $code = $node->content[0]->text ?? '';
        $language = $node->attrs->language ?? 'php';
        $highlightLines = [];
        $focusLines = [];

        // Check if code starts with markdown fence syntax (```lang{lines})
        // This allows line highlighting in Bard's native codeBlock
        if (preg_match('/^```(\w+)?(\{[^}]+\})?(\{[^}]+\})?\s*\n/', $code, $matches)) {
            // Extract language if specified
            if (!empty($matches[1])) {
                $language = $matches[1];
            }

            // Extract highlight lines {1,2-5}
            if (!empty($matches[2])) {
                $highlightLines = $this->parseLineNumbers(trim($matches[2], '{}'));
            }

            // Extract focus lines (second braces)
            if (!empty($matches[3])) {
                $focusLines = $this->parseLineNumbers(trim($matches[3], '{}'));
            }

            // Remove the fence line from code
            $code = preg_replace('/^```[^\n]*\n/', '', $code);

            // Also remove closing fence if present
            $code = preg_replace('/\n```\s*$/', '', $code);
        }

        // Create cache key based on code content, language, and options
        $cacheKey = $code . $language . json_encode($highlightLines) . json_encode($focusLines);

        try {
            // Check file-based cache first (git-tracked)
            $cached = ShikiCache::get($cacheKey);
            if ($cached !== null) {
                return ['content' => $cached];
            }

            // Generate and cache
            $shiki = static::getShiki();
            $highlighted = $shiki->highlightCode($code, $language, options: [
                'highlightLines' => $highlightLines,
                'focusLines' => $focusLines,
            ]);

            ShikiCache::put($cacheKey, $highlighted);

            return ['content' => $highlighted];
        } catch (Exception $e) {
            // Fallback to plain code if Shiki fails
            $escapedCode = htmlentities($code);

            return [
                'content' => "<pre><code class=\"language-{$language}\">{$escapedCode}</code></pre>",
            ];
        }
    }

    /**
     * Parse line number specification like "1,2-5,8" into array of line numbers
     */
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

    protected static function getShiki(): Shiki
    {
        if (static::$shiki === null) {
            static::$shiki = new Shiki([
                'light' => 'github-light',
                'dark' => 'github-dark',
            ]);
        }

        return static::$shiki;
    }
}

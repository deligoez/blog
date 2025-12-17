<?php

namespace App\Tags;

use Statamic\Tags\Tags;

class TocAuto extends Tags
{
    /**
     * The {{ toc_auto }} tag.
     *
     * Generates a table of contents from bard content headings.
     *
     * Usage: {{ toc_auto :levels="levels" }}
     */
    public function index(): array
    {
        // Get levels from params (array from checkboxes) or default to [1, 2]
        $levels = $this->params->get('levels');

        if (empty($levels)) {
            $levels = [1, 2];
        } elseif (is_string($levels)) {
            // If pipe-separated string
            $levels = array_map('intval', explode('|', $levels));
        } elseif (is_array($levels)) {
            // Statamic checkboxes return array of objects with key/value/label
            // Extract the 'value' from each if it's an object/array
            $levels = array_map(function ($item) {
                if (is_array($item) && isset($item['value'])) {
                    return (int) $item['value'];
                } elseif (is_object($item) && isset($item->value)) {
                    return (int) $item->value;
                }
                return (int) $item;
            }, $levels);
        }

        // Try multiple ways to get the entry's content
        $content = null;

        // Method 1: Direct from context
        $content = $this->context->get('content');

        // Method 2: From page in context
        if (empty($content) || !is_array($content)) {
            $page = $this->context->get('page');
            if ($page && method_exists($page, 'get')) {
                $content = $page->get('content');
            }
        }

        // Method 3: From id in context, fetch entry
        if (empty($content) || !is_array($content)) {
            $id = $this->context->get('id');
            if ($id) {
                $entry = \Statamic\Facades\Entry::find($id);
                if ($entry) {
                    $content = $entry->get('content');
                }
            }
        }

        // If content is a Value object, get its raw value
        if ($content instanceof \Statamic\Fields\Value) {
            $content = $content->raw();
        }

        // Convert to array if needed
        if ($content && !is_array($content)) {
            $content = $content->toArray();
        }

        // If content is still not an array, return empty
        if (!is_array($content)) {
            return ['items' => []];
        }

        $headings = $this->extractHeadings($content, $levels);

        return ['items' => $headings];
    }

    /**
     * Extract headings from bard content recursively.
     */
    protected function extractHeadings(array $content, array $levels): array
    {
        $headings = [];

        foreach ($content as $block) {
            // Check if this is a heading block
            if (isset($block['type']) && $block['type'] === 'heading') {
                $level = (int) ($block['attrs']['level'] ?? 1);

                // Use in_array with strict=false since levels might be strings from YAML
                if (in_array($level, $levels, false)) {
                    $text = $this->extractText($block['content'] ?? []);
                    $slug = $this->slugify($text);

                    $headings[] = [
                        'text' => $text,
                        'slug' => $slug,
                        'level' => $level,
                        'indent' => $level > min($levels),
                    ];
                }
            }
        }

        return $headings;
    }

    /**
     * Extract text content from bard content array.
     */
    protected function extractText(array $content): string
    {
        $text = '';

        foreach ($content as $item) {
            if (isset($item['text'])) {
                $text .= $item['text'];
            }
            if (isset($item['content'])) {
                $text .= $this->extractText($item['content']);
            }
        }

        return $text;
    }

    /**
     * Generate a URL-safe slug from text.
     */
    protected function slugify(string $text): string
    {
        // Convert to lowercase
        $slug = mb_strtolower($text, 'UTF-8');

        // Replace non-alphanumeric characters with hyphens
        $slug = preg_replace('/[^\w\s-]/u', '', $slug);

        // Replace whitespace with hyphens
        $slug = preg_replace('/\s+/', '-', $slug);

        // Remove duplicate hyphens
        $slug = preg_replace('/-+/', '-', $slug);

        // Trim hyphens from ends
        return trim($slug, '-');
    }
}

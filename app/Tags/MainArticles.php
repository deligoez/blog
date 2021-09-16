<?php

namespace App\Tags;

use Illuminate\Support\Collection;
use Statamic\Facades\Entry;
use Statamic\Tags\Tags;

class MainArticles extends Tags
{
    /**
     * The {{ main_articles }} tag.
     */
    public function index(): Collection
    {
        $query = Entry::query()
                      ->where('collection', 'articles')
                      ->where('published', true)
                      ->orderBy('date', 'desc');

        if ($this->params->int('limit') !== 0) {
            $query->limit($this->params->int('limit'));
        }

        return $query
            ->get()
            ->filter(fn($value, $args) => $value->parent() === null);
    }
}

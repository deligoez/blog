<?php

namespace App\Tags;

use Carbon\Carbon;
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
        $limit = $this->params->int('limit');

        $entries = Entry::query()
                      ->where('collection', 'articles')
                      ->where('published', true)
                      ->where('locale', $this->context->get('locale'))
                      ->get()
                      ->filter(fn($entry) => $entry->parent() === null)
                      ->sortByDesc(function ($entry) {
                          $displayDate = $entry->get('display_date');
                          if ($displayDate) {
                              return $displayDate instanceof Carbon
                                  ? $displayDate
                                  : Carbon::parse($displayDate);
                          }
                          return $entry->date();
                      });

        if ($limit !== 0) {
            $entries = $entries->take($limit);
        }

        return $entries;
    }
}

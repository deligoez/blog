<?php

namespace App\Scopes;

use Statamic\Query\Scopes\Scope;

class MainArticles extends Scope
{
    /**
     * Apply the scope.
     *
     * @param \Statamic\Query\Builder $query
     * @param array $values
     * @return void
     */
    public function apply($query, $values): void
    {
        $query
            ->orderBy('date', 'desc')
            ->offset(2)
            ->limit(5);
    }
}

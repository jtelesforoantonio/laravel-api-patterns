<?php

namespace App\Traits;

trait RequestSearchable
{
    /**
     * Bind searchable columns.
     */
    protected function bindWheres(string $search): array
    {
        $wheres = [];
        foreach ($this->searchable as $column) {
            $wheres[] = [$column, 'like', "%$search%", 'or'];
        }

        return $wheres;
    }
}

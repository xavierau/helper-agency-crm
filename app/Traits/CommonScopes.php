<?php

/**
 * Author: A & A Creation
 * Date: 13/8/2019
 * Time: 10:35 AM
 */


namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;

trait CommonScopes
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null                           $keyword
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRequestWith(Builder $query, string $keyword = null): Builder
    {

        return $keyword === null ?
            $query :
            $query->with(array_map(
                'trim',
                explode(
                    ',',
                    $keyword
                )
            ));
    }

    /**
     * example $searchColumns = ['name', 'salesperson.user' => ['name', 'email']];
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array                                 $searchColumns
     * @param string|null                           $keyword
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(
        Builder $query,
        array $searchColumns,
        string $keyword = null
    ): Builder {

        if ($keyword === null) {
            return $query;
        }

        $or = false;
        foreach ($searchColumns ?? [] as $key => $searchColumn) {
            $query = is_int($key) ?
                $this->compileWhere(
                    $query,
                    $searchColumn,
                    $keyword,
                    $or
                ) :
                $this->compileWhereHas(
                    $searchColumn,
                    $query,
                    $key,
                    $keyword,
                    $or
                );

            $or = true;
        }


        return $query;
    }

    private function appendWhereHas(
        $query,
        string $relation,
        string $column,
        string $keyword,
        bool $or = false
    ): Builder {


        if ($or === false) {
            $query->whereHas(
                $relation,
                fn ($q) => $q->where(
                    $column,
                    'like',
                    "%{$keyword}%"
                )
            );
        } else {
            $query->orWhereHas(
                $relation,
                fn ($q) => $q->where(
                    $column,
                    'like',
                    "%{$keyword}%"
                )
            );
        }

        return $query;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param                                       $searchColumn
     * @param string                                $keyword
     */
    private function standardAndWhere(
        Builder $query,
        $searchColumn,
        string $keyword
    ): Builder {
        return $query->where(
            $searchColumn,
            'like',
            "%{$keyword}%"
        );
    }

    /**
     * @param                                       $searchColumn
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param                                       $key
     * @param string                                $keyword
     * @param bool                                  $or
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private
    function compileWhereHas(
        $searchColumn,
        Builder $query,
        $key,
        string $keyword,
        bool $or
    ): Builder {

        $cs = is_array($searchColumn) ? $searchColumn : array_map(
            'trim',
            explode(
                ',',
                $searchColumn
            )
        );

        foreach ($cs as $index => $c) {

            $query = $this->appendWhereHas(
                $query,
                $key,
                $c,
                $keyword,
                ($or or $index > 0)
            );
        }

        return $query;
    }

    /**
     * @param        $query
     * @param        $searchColumn
     * @param string $keyword
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private
    function standardOrWhere(
        $query,
        $searchColumn,
        string $keyword
    ): Builder {
        return $query->orWhere(
            $searchColumn,
            'like',
            "%{$keyword}%"
        );
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $searchColumn
     * @param string                                $keyword
     * @param bool                                  $or
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function compileWhere(
        Builder $query,
        string $searchColumn,
        string $keyword,
        bool $or = false
    ): Builder {
        return $or ?
            $this->standardOrWhere(
                $query,
                $searchColumn,
                $keyword
            ) :
            $this->standardAndWhere(
                $query,
                $searchColumn,
                $keyword
            );
    }
}

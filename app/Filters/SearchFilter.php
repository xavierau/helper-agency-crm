<?php
/**
 * Author: A & A Creation Co.
 * Date: 13/8/2020
 * Time: 10:36 AM
 */

namespace App\Filters;


use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class SearchFilter implements Filter
{
    private $columns;

    public function __construct(array $columns) {
        $this->columns = $columns;
    }

    public function __invoke(Builder $query, $value, string $property) {

        if($value !== null) {
            $query->where(function($sq) use ($value) {
                $or = false;
                foreach($this->columns ?? [] as $key => $searchColumn) {
                    $sq = is_int($key) ?
                        $this->compileWhere($sq,
                                            $searchColumn,
                                            $value,
                                            $or):

                        $this->compileWhereHas($searchColumn,
                                               $sq,
                                               $key,
                                               $value,
                                               $or);

                    $or = true;
                }


                return $sq;
            });
        }

    }

    private function appendWhereHas($query, string $relation, string $column, string $keyword,
        bool $or = false
    ): Builder {


        if($or === false) {
            $query->whereHas($relation,
                fn($q) => $q->where($column,
                                    'like',
                                    "%{$keyword}%"));
        } else {
            $query->orWhereHas($relation,
                fn($q) => $q->where($column,
                                    'like',
                                    "%{$keyword}%"));
        }

        return $query;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param                                       $searchColumn
     * @param string                                $keyword
     */
    private function standardAndWhere(Builder $query, $searchColumn, string $keyword
    ): Builder {
        return $query->where($searchColumn,
                             'like',
                             "%{$keyword}%");
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
    function compileWhereHas($searchColumn, Builder $query, $key, string $keyword, bool $or
    ): Builder {

        $cs = is_array($searchColumn) ? $searchColumn: array_map('trim',
                                                                 explode(',',
                                                                         $searchColumn));

        foreach($cs as $index => $c) {

            $query = $this->appendWhereHas($query,
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
    private function standardOrWhere($query, $searchColumn, string $keyword
    ): Builder {
        return $query->orWhere($searchColumn,
                               'like',
                               "%{$keyword}%");
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $searchColumn
     * @param string                                $keyword
     * @param bool                                  $or
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function compileWhere(Builder $query, string $searchColumn, string $keyword,
        bool $or = false
    ): Builder {
        return $or ?
            $this->standardOrWhere($query,
                                   $searchColumn,
                                   $keyword):
            $this->standardAndWhere($query,
                                    $searchColumn,
                                    $keyword);
    }
}

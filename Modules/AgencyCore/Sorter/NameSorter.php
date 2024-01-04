<?php
/**
 * Author: A & A Creation Co.
 * Date: 22/8/2020
 * Time: 3:47 PM
 */

namespace Modules\AgencyCore\Sorter;


use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class NameSorter implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $ordering = $descending ? 'DESC' : 'ASC';
        return $query->orderByRaw("concat(given_name,' ',middle_name,' ',surname) {$ordering}");
    }
}

<?php
/**
 * Author: A & A Creation Co.
 * Date: 21/9/2020
 * Time: 1:53 AM
 */

namespace Modules\AgencyCore\Filters;


use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class PaymentClientNameFilter implements Filter
{

    public function __invoke(Builder $query, $value, string $property) {
        if($value === null) {
            return $query;
        }

        return $query->whereHas('invoice.client',
            function(Builder $sq) use ($value) {
                return $sq->where('first_name',
                                  'like',
                                  "%{$value}%")
                          ->orWhere('last_name',
                                    'like',
                                    "%{$value}%");
            });
    }
}

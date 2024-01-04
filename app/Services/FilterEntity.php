<?php
/**
 * A & A Creation Co.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    A & A Creation
 * @package
 * @Date        : 8/1/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace App\Services;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class
FilterEntity
{
    private ?array $request_filters;
    private array $table_columns = [];
    private array $exact_table_columns = [];
    private array $scopes = [];
    private Model $entity;
    private Builder $query;

    public static function model(string $modelClass): FilterEntity {
        $instance = new static;

        $instance->request_filters = request()->get('filter',
                                                    null);

        $instance->entity = app($modelClass);
        $instance->query = $instance->entity->query();

        return $instance;
    }

    public function addFilter(string $table_column): FilterEntity {
        $this->table_columns[] = $table_column;

        return $this;
    }

    public function addExactFilter(string $table_column): FilterEntity {
        $this->exact_table_columns[] = $table_column;

        return $this;
    }

    public function addScopeFilter(string $scope): FilterEntity {
        $this->scopes[] = $scope;

        return $this;
    }

    public function getQuery(): Builder {

        $first = true;

        if($this->request_filters and count($this->request_filters)) {
            $this->simpleFilters($first);
            $this->exactFilters($first);
            $this->scopeFilters($first);
        }


        return $this->query;

    }

    private function simpleFilters(bool &$first) {
        foreach($this->request_filters as $filter => $keyword) {

            if(in_array($filter,
                        $this->table_columns)) {
                if($first) {
                    $first = false;
                    $this->query->where($filter,
                                        'like',
                                        "%{$keyword}%");
                } else {
                    $this->query->orWhere($filter,
                                          'like',
                                          "%{$keyword}%");
                }
            }
        }
    }

    private function exactFilters(bool &$first) {
        foreach($this->request_filters as $filter => $keyword) {

            if(in_array($filter,
                        $this->exact_table_columns)) {
                if($first) {
                    $first = false;
                    $this->query->where($filter,
                                        $keyword);
                } else {
                    $this->query->orWhere($filter,
                                          $keyword);
                }
            }
        }
    }

    private function scopeFilters(bool $first) {

        foreach($this->request_filters as $filter => $keyword) {
            if($keyword) {
                if(in_array($filter,
                            $this->scopes)) {
                    $this->query->$filter($keyword);
                }
            }
        }
    }
}

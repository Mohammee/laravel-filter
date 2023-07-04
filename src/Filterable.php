<?php

namespace Mohammadabusultan\LaravelFilter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Filterable
{

    public function scopeFilter(Builder $builder)
    {
        if (!$this->filters) {
            throw new \Exception('Please defined the filters attribute');
        }

        foreach ($this->filters as $filter => $condition) {

            $pad = $condition == 'like' ? '%' : '';

            if (str_contains($filter, '.')) {
                $relation = Str::beforeLast($filter, '.');
                $column = Str::afterLast($filter, '.');

                $builder->when(\request()->query($column), fn($q, $v) => $q->whereRelation($relation, $column, $condition, $pad.$v.$pad));
                continue;
            }


            $builder->when(\request()->query($filter), fn($q, $v) => $q->where($filter, $condition, $pad.$v.$pad));
        }

    }
}

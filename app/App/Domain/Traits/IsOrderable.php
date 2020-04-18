<?php

namespace App\App\Domain\Traits;
use Illuminate\Database\Eloquent\Builder;

trait isOrderable
{
    public function scopeOrdered(Builder $builder , $direction = 'asc')
    {
        $builder->orderBy('order', $direction);
    }
}
<?php

namespace App\App\Domain\Traits;
use App\App\Domain\Cart\Money;
use Money\Currency;

trait HasPrice
{
    public function getPriceAttribute($value)
    {
        // the main value which is stored in the DB
        return new Money($value);      
    }
}
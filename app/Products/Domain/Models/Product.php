<?php

namespace App\Products\Domain\Models;

use App\App\Domain\Traits\HasPrice;
use App\App\Domain\Traits\CanBeScoped;
use Illuminate\Database\Eloquent\Model;
use App\Categories\Domain\Models\Category;
use App\ProductVariation\Domain\Models\ProductVariation;

class Product extends Model
{
    use CanBeScoped, HasPrice;

    // public function getFormattedPriceAttribute($value)
    // {
    //     $formatter = new IntlMoneyFormatter(
    //         new NumberFormatter('en_GB', NumberFormatter::CURRENCY),
    //         new ISOCurrencies
    //     );

    //     return $formatter->format($this->price);
    // }

    /**
     * @return mixed
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return mixed
     */
    public function variations()
    {
        return $this->hasMany(ProductVariation::class)->orderBy('order', 'asc');
    }
}

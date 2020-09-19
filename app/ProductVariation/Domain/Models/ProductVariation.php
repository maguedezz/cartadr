<?php

namespace App\ProductVariation\Domain\Models;

use App\App\Domain\Cart\Money;
use App\App\Domain\Traits\HasPrice;
use App\Stocks\Domain\Models\Stock;
use App\Products\Domain\Models\Product;
use Illuminate\Database\Eloquent\Model;
use App\ProductVariationType\Domain\Models\ProductVariationType;

class ProductVariation extends Model
{
    use HasPrice;

    /**
     * @param $value
     * @return mixed
     */
    public function getPriceAttribute($value)
    {
        if ($value === null) {
            return $this->product->price;
        }

        return new Money($value);
    }

    /**
     * @return mixed
     */
    public function inStock()
    {
        return $this->stockCount() > 0;
    }

    /**
     * @return mixed
     */
    public function priceVaries()
    {
        return $this->price->amount() !== $this->product->price->amount();
    }

    /**
     * @return mixed
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return mixed
     */
    public function stock()
    {
        // second argument is db table
        return $this->belongsToMany(
            ProductVariation::class, 'product_variation_stock_view'
        )
            ->withPivot([
                'stock',
                'in_stock',
            ]);
    }

    /**
     * @return mixed
     */
    public function stockCount()
    {
        // accessing the stock relationship then withPivot then the stock you passed in the pivot array
        return $this->stock->sum('pivot.stock');
    }

    /**
     * @return mixed
     */
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    /**
     * @return mixed
     */
    public function type()
    {
        // We want to have foreign key id and local key of PVTI
        return $this->hasOne(ProductVariationType::class, 'id', 'product_variation_type_id');
    }
}

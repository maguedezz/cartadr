<?php

namespace App\ProductVariation\Domain\Collections;

class ProductVariationCollection extends Collection
{
    /**
     * @return mixed
     */
    public function forSyncing()
    {
        return $this->keyBy('id')->map(function ($product) {
            return [
                'quantity' => $product->pivot->quantity,
            ];
        })->toArray();
    }
}

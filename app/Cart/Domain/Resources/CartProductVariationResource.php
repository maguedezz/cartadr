<?php

namespace App\Cart\Domain\Resources;

use App\App\Domain\Cart\Money;
use App\Products\Domain\Resources\ProductIndexResource;
use App\ProductVariation\Domain\Resources\ProductVariationResource;

class CartProductVariationResource extends ProductVariationResource
{
    /**
     * Transform the resources into an array.
     *
     *
     * @param $request
     */
    public function toArray($request)
    {
        $total = new Money($this->pivot->quantity * $this->price->amount());

        return array_merge(Parent::toArray($request), [
            'product' => new ProductIndexResource($this->product),
            'quantity' => $this->pivot->quantity,
            'total' => $total->formatted(),
        ]);
    }
}

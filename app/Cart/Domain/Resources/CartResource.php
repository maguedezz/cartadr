<?php

namespace App\Cart\Domain\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Cart\Domain\Resources\CartProductVariationResource;

class CartResource extends JsonResource
{
    /**
     * @param $request
     */
    public function toArray($request)
    {
        return [
            'products' => CartProductVariationResource::collection($this->cart),
        ];
    }
}

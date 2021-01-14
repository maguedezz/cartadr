<?php

namespace App\Cart\Domain\Services;

use App\App\Domain\Cart\Cart;
use App\App\Domain\Services\BaseService;
use App\ProductVariation\Domain\Models\ProductVariation;

class UpdateCartService extends BaseService
{
    /**
     * @param array $data
     * @param ProductVariation $productVariation
     * @param nullCart $cart
     */
    public function handle($data = [], ProductVariation $productVariation = null, Cart $cart = null)
    {
        $cart->update($productVariation->id, $data['quantity']);
    }
}

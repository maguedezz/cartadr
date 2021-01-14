<?php

namespace App\Cart\Domain\Services;

use App\App\Domain\Services\BaseService;

class DeleteCartService extends BaseService
{
    /**
     * @param $productVariation
     * @param null $cart
     */
    public function handle($productVariation = null, $cart = null)
    {
        $cart->delete($productVariation->id);
    }
}

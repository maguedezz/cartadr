<?php

namespace App\Cart\Domain\Services;

use App\App\Domain\Cart\Cart;
use App\App\Domain\Services\BaseService;

class StoreCartService extends BaseService
{
    /**
     * @param array $data
     * @param Cart $cart
     */
    public function handle($data = [], Cart $cart = null)
    {
        $cart->add($data['products']);
    }
}

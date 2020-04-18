<?php

namespace App\Cart\Domain\Models\Services;

use App\App\Domain\Services\BaseService;

class IndexCartService extends BaseService
{
    /**
     * @var mixed
     */
    private $cart;

    /**
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }
}

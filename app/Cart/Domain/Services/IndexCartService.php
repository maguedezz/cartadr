<?php

namespace App\Cart\Domain\Services;

use App\App\Domain\Cart\Cart;
use App\App\Domain\Services\BaseService;
use App\App\Domain\Payloads\GenericPayload;

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

    /**
     * @param array $request
     */
    public function handle($request = [])
    {
        $this->cart->sync();
        $request->user()->load(['cart', 'cart.type', 'cart.stock', 'cart.product', 'cart.type']);

        return new GenericPayload($request->user());
    }
}

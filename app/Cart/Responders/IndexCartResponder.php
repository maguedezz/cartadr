<?php

namespace App\Cart\Responders;

use App\App\Domain\Cart\Cart;
use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Cart\Domain\Resources\CartResource;

class IndexCartResponder extends Responder implements ResponderInterface
{
    /**
     * @var mixed
     */
    protected $cart;

    /**
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function respond()
    {
        return (new CartResource($this->response->getData()))->additional([
            'meta',
        ]);
    }
}

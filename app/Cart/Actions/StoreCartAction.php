<?php

namespace App\Cart\Actions;

use App\App\Domain\Cart\Cart;
use App\Cart\Responders\StoreCartResponder;
use App\Cart\Domain\Services\StoreCartService;
use App\Cart\Domain\Requests\StoreCartRequestForm;

class StoreCartAction
{
    /**
     * @var mixed
     */
    private $responder;

    /**
     * @var mixed
     */
    private $services;

    /**
     * @param StoreCartResponder $responder
     * @param StoreCartService $services
     */
    public function __construct(StoreCartResponder $responder, StoreCartService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    /**
     * @param StoreCartRequestForm $request
     * @param Cart $cart
     */
    public function __invoke(StoreCartRequestForm $request, Cart $cart)
    {
        return $this->responder->withResponse($this->services->handle($request->validated(), $cart))->respond();
    }
}

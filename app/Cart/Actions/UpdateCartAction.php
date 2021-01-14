<?php

namespace App\Cart\Actions;

use App\App\Domain\Cart\Cart;
use App\Cart\Responders\UpdateCartResponder;
use App\Cart\Domain\Services\UpdateCartService;
use App\Cart\Domain\Requests\UpdateCartFormRequest;
use App\ProductVariation\Domain\Models\ProductVariation;

class UpdateCartAction
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
     * @param UpdateCartResponder $responder
     * @param UpdateCartService $services
     */
    public function __construct(UpdateCartResponder $responder, UpdateCartService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    /**
     * @return mixed
     */
    public function __invoke(UpdateCartFormRequest $request, ProductVariation $productVariation, Cart $cart)
    {
        return $this->responder->withResponse($this->services->handle($request->validated(), $productVariation, $cart))->respond();
    }
}

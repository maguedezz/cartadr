<?php

namespace App\Cart\Actions;

use App\App\Domain\Cart\Cart;
use App\Cart\Responders\DeleteCartResponder;
use App\Cart\Domain\Services\DeleteCartService;
use App\ProductVariation\Domain\Models\ProductVariation;

class DeleteCartAction
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
     * @param $responder
     * @param $services
     */
    public function __construct(DeleteCartResponder $responder, DeleteCartService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    /**
     * @param ProductVariation $productVariation
     * @param Cart $cart
     * @return mixed
     */
    public function __invoke(ProductVariation $productVariation, Cart $cart)
    {
        return $this->responder->withResponse($this->services->handle($productVariation, $cart))->respond();
    }
}

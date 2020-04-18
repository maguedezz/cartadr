<?php

namespace App\Products\Actions;

use App\Products\Domain\Models\Product;
use App\Products\Domain\Services\ShowProductService;
use App\Products\Responders\ShowProductResponder;

class ShowProductAction
{
    private $responder;
    private $services;

    public function __construct(ShowProductResponder $responder,ShowProductService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    public function __invoke(Product $product)
    {
        return $this->responder->withResponse($this->services->handle($product))->respond();
    }


}
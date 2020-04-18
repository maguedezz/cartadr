<?php

namespace App\Products\Actions;

use App\Products\Responders\IndexProductsResponder;
use App\Products\Domain\Services\IndexProductsService;

class IndexProductsAction
{
    protected $responder;
    protected $services;

    public function __construct(IndexProductsResponder $responder,IndexProductsService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    public function __invoke()
    {
        return $this->responder->withResponse($this->services->handle())->respond();
    }


}
<?php

namespace App\Addresses\Actions;

use App\Addresses\Responders\StoreAddressesResponder;
use App\Addresses\Domain\Services\StoreAddressesService;
use App\Addresses\Domain\Requests\StoreAddressRequestForm;

class StoreAddressAction
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
    public function __construct(StoreAddressesResponder $responder, StoreAddressesService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    /**
     * @param StoreAddressRequestForm $request
     */
    public function __invoke(StoreAddressRequestForm $request)
    {
        return $this->responder->withResponse($this->services->handle($request->validated()))->respond();
    }
}

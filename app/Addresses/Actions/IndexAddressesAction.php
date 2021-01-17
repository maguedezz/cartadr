<?php

namespace App\Addresses\Actions;

use Illuminate\Http\Request;
use App\Addresses\Responders\IndexAddressesResponder;
use App\Addresses\Domain\Services\IndexAddressesService;

class IndexAddressesAction
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
     * @param IndexAddressesResponder $responder
     * @param IndexAddressesService $services
     */
    public function __construct(IndexAddressesResponder $responder, IndexAddressesService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return $this->responder->
            withResponse($this->services->handle($request->user()))->respond();
    }
}

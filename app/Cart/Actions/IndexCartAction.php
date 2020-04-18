<?php

namespace App\Cart\Actions;

use Illuminate\Http\Request;
use App\Cart\Responders\IndexCartResponder;
use App\Cart\Domain\Services\IndexCartService;

class IndexCartAction
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
     * @param $PROPERTY
     */
    public function __construct(IndexCartResponder $responder, IndexCartService $services)
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
        return $this->responder->withResponse($this->services->handle($request))->respond();
    }
}

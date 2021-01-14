<?php

namespace App\Users\Actions;

use App\Users\Responders\LoginUserResponder;
use App\Users\Domain\Requests\LoginRequestForm;
use App\Users\Domain\Services\LoginUserService;

class LoginUserAction
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
    public function __construct(LoginUserResponder $responder, LoginUserService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    /**
     * @return mixed
     */
    public function __invoke(LoginRequestForm $request)
    {

        return $this->responder->withResponse($this->services->handle($request->validated()))->respond();
    }
}

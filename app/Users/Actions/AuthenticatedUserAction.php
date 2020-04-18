<?php

namespace App\Users\Actions;

use App\Users\Responders\AuthenticatedUserResponder;
use App\Users\Domain\Services\AuthenticatedUserService;

class AuthenticatedUserAction
{
    /**
     * @var mixed
     */
    private $responders;

    /**
     * @var mixed
     */
    private $services;

    /**
     * @param AuthenticatedUserResponder $responder
     * @param AuthenticatedUserService $services
     */
    public function __construct(AuthenticatedUserResponder $responder, AuthenticatedUserService $services)
    {
        $this->responder = $responder;
        $this->services = $services;
    }

    /**
     * @return mixed
     */
    public function __invoke()
    {
        return $this->responder->withResponse($this->services->handle())->respond();
    }
}

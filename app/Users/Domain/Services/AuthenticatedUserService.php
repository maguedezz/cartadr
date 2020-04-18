<?php

namespace App\Users\Domain\Services;

use App\App\Domain\Services\BaseService;
use App\App\Domain\Payloads\GenericPayload;

class AuthenticatedUserService extends BaseService
{
    /**
     * @param array $user
     */
    public function handle()
    {
        return new GenericPayload(auth()->user());
    }
}

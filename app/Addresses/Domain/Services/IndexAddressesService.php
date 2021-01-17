<?php

namespace App\Addresses\Domain\Services;

use App\App\Domain\Services\BaseService;
use App\App\Domain\Payloads\GenericPayload;

class IndexAddressesService extends BaseService
{
    /**
     * @param $user
     */
    public function handle($user = null)
    {
        return new GenericPayload($user->addresses);
    }
}

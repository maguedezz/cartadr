<?php

namespace App\Addresses\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Addresses\Domain\Resources\AddressResource;

class StoreAddressesResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        return new AddressResource($this->response->getData());
    }
}

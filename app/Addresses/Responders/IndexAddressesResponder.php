<?php

namespace App\Addresses\Responders;

use App\App\Responders\Responder;
use App\App\Responders\ResponderInterface;
use App\Addresses\Domain\Resources\AddressResource;

class IndexAddressesResponder extends Responder implements ResponderInterface
{
    public function respond()
    {
        return AddressResource::collection($this->response->getData());
    }
}

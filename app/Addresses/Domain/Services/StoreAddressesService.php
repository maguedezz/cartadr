<?php

namespace App\Addresses\Domain\Services;

use App\App\Domain\Services\BaseService;
use App\App\Domain\Payloads\GenericPayload;
use App\Addresses\Domain\Repositories\AddressRepository;

class StoreAddressesService extends BaseService
{
    /**
     * @var mixed
     */
    protected $addresses;

    /**
     * @param AddressRepository $addresses
     */
    public function __construct(AddressRepository $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * @param array $data
     */
    public function handle($data = [])
    {
        $address = $this->addresses->make($data);

        auth()->user()->addresses()->save($address);

        return new GenericPayload($address);
    }
}

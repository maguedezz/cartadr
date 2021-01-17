<?php

namespace App\Addresses\Domain\Repositories;

use App\Addresses\Domain\Models\Address;
use App\App\Domain\Repositories\Repository;

class AddressRepository extends Repository
{
    /**
     * @var mixed
     */
    protected $model;

    /**
     * @param Address $address
     */
    public function __construct(Address $address)
    {
        $this->model = $address;
    }
}

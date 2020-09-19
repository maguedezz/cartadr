<?php

namespace App\Cart\Domain\Repositories;

use App\App\Domain\Cart\Cart;
use App\App\Domain\Repositories\Repository;

class CartRepository extends Repository
{
    /**
     * @var mixed
     */
    protected $model;

    /**
     * @param Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }
}

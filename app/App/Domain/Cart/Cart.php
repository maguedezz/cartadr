<?php

namespace App\App\Domain\Cart;

use App\Users\Domain\Models\User;

class Cart
{
    /**
     * @var mixed
     */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    /**
     * @param $products
     */
    public function add($products)
    {
        $this->user->cart()->syncWithoutDetaching($this->getStorePayload($products)
        );
    }

    /**
     * @param $products
     */
    public function getStorePayload($products)
    {
        return collect($products)->keyBy('id')->map(function ($product) {
            return [
                'quantity' => $product['quantity'],
            ];
        })
            ->toArray();
    }

    /**
     * @return mixed
     */
    public function products()
    {
        return $this->user->cart;
    }
}

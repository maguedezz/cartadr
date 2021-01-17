<?php

namespace App\App\Domain\Cart;

use App\App\Domain\Cart\Money;
use App\Users\Domain\Models\User;

class Cart
{
    /**
     * @var mixed
     */
    protected $changed = false;

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

    public function blank()
    {
        $this->user->cart()->detach();
    }

    /**
     * @param $productId
     */
    public function delete($productId)
    {
        $this->user->cart()->detach($productId);
    }

    /**
     * @param $products
     */
    public function getStorePayload($products)
    {
        return collect($products)->keyBy('id')->map(function ($product) {
            return [
                'quantity' => $product['quantity'] + $this->getCurrentQuantity($product['id']),
            ];
        })
            ->toArray();
    }

    /**
     * @return mixed
     */
    public function hasChanged()
    {
        return $this->changed;
    }

    /**
     * @return mixed
     */
    public function isEmpty()
    {
        return $this->user->cart->sum('pivot.quantity') <= 0;
    }

    /**
     * @return mixed
     */
    public function products()
    {
        return $this->user->cart;
    }

    /**
     * @return mixed
     */
    public function subtotal()
    {
        $subtotal = $this->user->cart->sum(function ($product) {
            return $product->price->amount() * $product->pivot->quantity;
        });

        return new Money($subtotal);
    }

    /**
     * @return null
     */
    public function sync()
    {
        $this->user->cart->each(function ($product) {
            $quantity = $product->minStock($product->pivot->quantity);

            $this->changed = $quantity !== $product->pivot->quantity;

            $product->pivot->update([
                'quantity' => $quantity,
            ]);
        });
    }

    /**
     * @return mixed
     */
    public function total()
    {
        return $this->subtotal();
    }

    /**
     * @param $productId
     * @param $quantity
     */
    public function update($productId, $quantity)
    {
        $this->user->cart()->updateExistingPivot($productId, [
            'quantity' => $quantity,
        ]);
    }

    /**
     * @param $productId
     * @return int
     */
    protected function getCurrentQuantity($productId)
    {
        if ($product = $this->user->cart->where('id', $productId)->first()) {
            return $product->pivot->quantity;
        }

        return 0;
    }
}

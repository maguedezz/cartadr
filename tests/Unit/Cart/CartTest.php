<?php

namespace Tests\Unit\Cart;

use Tests\TestCase;
use App\App\Domain\Cart\Cart;
use App\Users\Domain\Models\User;
use App\ProductVariation\Domain\Models\ProductVariation;

class CartTest extends TestCase
{
    public function test_it_can_add_products_to_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $product = factory(ProductVariation::class)->create();

        $cart->add([
            ['id' => $product->id, 'quantity' => 1],
        ]);

        $this->assertCount(1, $user->fresh()->cart);
    }
}

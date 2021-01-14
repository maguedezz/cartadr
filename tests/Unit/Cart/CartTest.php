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

    public function test_it_can_delete_a_product_from_the_cart()
    {
        $cart = new Cart($user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(), [
                'quantity' => 1,
            ]
        );

        $cart->delete($product->id);

        $this->assertCount(0, $user->fresh()->cart);
    }

    public function test_it_can_empty_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );
        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create()
        );

        $cart->blank($product->id);
        $this->assertCount(0, $user->fresh()->cart);
    }

    public function test_it_can_update_quantities_in_the_cart()
    {
        $cart = new Cart($user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(), [
                'quantity' => 1,
            ]
        );

        $cart->update($product->id, 2);

        $this->assertEquals($user->fresh()->cart->first()->pivot->quantity, 2);
    }

    public function test_it_increments_quantity_when_adding_more_products()
    {
        // Simulating two different requests !
        $product = factory(ProductVariation::class)->create();

        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $cart->add([
            ['id' => $product->id, 'quantity' => 1],
        ]);

        $cart = new Cart($user->fresh());

        $cart->add([
            ['id' => $product->id, 'quantity' => 1],
        ]);

        $this->assertEquals($user->fresh()->cart->first()->pivot->quantity, 2);
    }
}

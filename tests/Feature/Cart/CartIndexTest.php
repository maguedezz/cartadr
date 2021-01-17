<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Users\Domain\Models\User;
use App\ProductVariation\Domain\Models\ProductVariation;

class CartIndexTest extends TestCase
{
    public function it_shows_products_in_the_user_cart()
    {
        $user = factory(User::class)->create();

        $user->cart()->sync(
            $product = factory(ProductVariation::class)->create()
        );
        $this->jsonAs($user, 'GET', 'api/cart')->assertJsonFragment([
            'id' => $product->id,
        ]);
    }

    public function test_it_fails_if_unauthenticated()
    {
        $this->get('/api/cart')->assertStatus(401);
    }

    public function test_it_shows_a_formatted_subtotal()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'GET', 'api/cart')->assertJsonFragment([
            'subtotal' => '£0.00',
        ]);
    }

    public function test_it_shows_a_formatted_total()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'GET', 'api/cart')->assertJsonFragment([
            'total' => '£0.00',
        ]);
    }

    public function test_it_shows_if_the_cart_is_empty()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'GET', 'api/cart')->assertJsonFragment([
            'empty' => true,
        ]);
    }

    public function test_it_syncs_the_cart()
    {
        $user = factory(User::class)->create();

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(), [
                'quantity' => 2,
            ]
        );

        $this->jsonAs($user, 'GET', 'api/cart')->assertJsonFragment([
            'changed' => true,
        ]);
    }
}

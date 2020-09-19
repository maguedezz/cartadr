<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Users\Domain\Models\User;
use App\ProductVariation\Domain\Models\ProductVariation;

class CartStoreTest extends TestCase
{
    public function test_it_can_add_products_to_the_users_cart()
    {
        $user = factory(User::class)->create();
        $product = factory(ProductVariation::class)->create();
        $response = $this->jsonAs($user, 'POST', '/api/cart', [
            'products' => [
                ['id' => $product->id, 'quantity' => 2],
            ],
        ]);

        dd($response->getContent());
        $this->assertDatabaseHas('cart_user', [
            'product_variation_id' => $product->id,
            'quantity' => 3,
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_fails_if_user_is_unauthenticated()
    {
        $this->post('api/cart')->assertStatus(401);
    }

    public function test_it_requires_products()
    {
        // User Authenticated
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', '/api/cart')
            ->assertJsonStructure([
                'data' => ['products'],
            ]);
    }

    public function test_it_requires_products_quantity_to_be_at_least_one()
    {
        // User Authenticated
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', '/api/cart', [
            'products' => [
                ['id' => 1, 'quantity' => 0],
            ],
        ])
            ->assertJsonStructure([
                'data' => ['products'],
            ]);
    }

    public function test_it_requires_products_quantity_to_be_numeric()
    {
        // User Authenticated
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', '/api/cart', [
            'products' => [
                ['id' => 1, 'quantity' => 'one'],
            ],
        ])
            ->assertJsonStructure([
                'data' => ['products'],
            ]);
    }

    public function test_it_requires_products_to_be_an_array()
    {
        // User Authenticated
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', '/api/cart', [
            'products' => 1,
        ])
            ->assertJsonStructure([
                'data' => ['products'],
            ]);
    }

    public function test_it_requires_products_to_be_have_an_id()
    {
        // User Authenticated
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', '/api/cart', [
            'products' => [
                ['quantity' => 1],
            ],
        ])
            ->assertJsonStructure([
                'data' => ['products'],
            ]);
    }

    public function test_it_requires_products_to_exist()
    {
        // User Authenticated
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', '/api/cart', [
            'products' => [
                ['id' => 1, 'quantity' => 1],
            ],
        ])
            ->assertJsonStructure([
                'data' => ['products'],
            ]);
    }
}

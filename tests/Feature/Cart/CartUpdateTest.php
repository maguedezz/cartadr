<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Users\Domain\Models\User;
use App\ProductVariation\Domain\Models\ProductVariation;

class CartUpdateTest extends TestCase
{
    public function test_it_fails_if_product_cant_be_found()
    {
        $user = factory(User::class)->create();

        $this->put('/api/cart/1')->assertStatus(404);
    }

    /** @test */
    public function test_it_fails_if_user_is_unauthenticated()
    {
        $this->put('/api/cart/1')->assertStatus(404);
    }

    /** @test */
    public function test_it_requires_a_numeric_quanitity()
    {
        $user = factory(User::class)->create();

        $product = factory(ProductVariation::class)->create();

        $response = $this->jsonAs($user, 'PUT', "api/cart/{$product->id}", [
            'quantity' => 0,
        ]);

        $this->assertJsonValidationMessages($response, [
            'quantity' => 'The quantity must be at least 1.',
        ]);
    }

    /** @test */
    public function test_it_requires_a_quanitity()
    {
        $user = factory(User::class)->create();

        $product = factory(ProductVariation::class)->create();

        $response = $this->jsonAs($user, 'PUT', "api/cart/{$product->id}");
        $this->assertJsonValidationMessages($response, [
            'quantity' => "The quantity field is required.",
        ]);
    }

    /** @test */
    public function test_it_updates_the_quantity_of_a_product()
    {
        $user = factory(User::class)->create();
        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(), [
                'quantity' => 1,
            ]
        );
        $response = $this->jsonAs($user, 'PUT', "api/cart/{$product->id}", [
            'quantity' => $quantity = 5,
        ]);
        $this->assertDatabaseHas('cart_user', [
            'product_variation_id' => $product->id,
            'quantity' => $quantity,
        ]);
    }
}

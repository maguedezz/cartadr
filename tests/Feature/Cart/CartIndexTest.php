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
        $response = $this->json('GET', 'api/cart')
            ->assertStatus(401);
    }
}

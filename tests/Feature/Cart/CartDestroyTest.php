<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Users\Domain\Models\User;
use App\ProductVariation\Domain\Models\ProductVariation;

class CartDestroyTest extends TestCase
{
    public function test_it_deletes_an_item_from_the_cart()
    {
        $user = factory(User::class)->create();
        $user->cart()->sync(
            $product = factory(ProductVariation::class)->create()
        );

        $this->jsonAs($user, 'DELETE', "api/cart/{$product->id}");

        $this->assertDatabaseMissing('cart_user', [
            'product_variation_id' => $product->id,
        ]);
    }

    public function test_it_fails_if_product_variation_not_found()
    {
        $this->delete('api/cart/1')->assertStatus(404);
    }
}

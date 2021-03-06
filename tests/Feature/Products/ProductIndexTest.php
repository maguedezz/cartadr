<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Products\Domain\Models\Product;

class ProductIndexTest extends TestCase
{
    /** @test */
    public function test_it_has_paginated_data()
    {

        $this->get('/api/products')
            ->assertJsonStructure([
                'links',
                'data',
            ]);
    }

    /** @test */
    public function test_it_shows_a_collection_of_products()
    {
        $product = factory(Product::class)->create();

        $this->get('/api/products')
            ->assertJsonFragment([
                'id' => $product->id,
            ]);
    }
}

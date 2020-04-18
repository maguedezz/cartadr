<?php

namespace Tests\Feature\Products;

use App\Categories\Domain\Models\Category;
use App\Products\Domain\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductScopingTest extends TestCase
{
      /** @test */
    public function test_it_can_scope_by_category()
    {
        // attach a category to this product and create ather product that is not attached to that particular category

        $product = factory(Product::class)->create();
        $product->categories()->save(
            $category = factory(Category::class)->create()
        );
        $anotherproduct = factory(Product::class)->create();
        $this->get("api/products?category={$category->slug}")
            ->assertJsonCount(1, 'data');
    }
}

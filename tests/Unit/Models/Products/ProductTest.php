<?php

namespace Tests\Unit\Models\Products;

use Tests\TestCase;
use App\App\Domain\Cart\Money;
use App\Products\Domain\Models\Product;
use App\Categories\Domain\Models\Category;
use App\ProductVariation\Domain\Models\ProductVariation;

class ProductTest extends TestCase
{
    // public function test_it_returns_a_price()
    // {
    //     $product =  factory(Product::class)->create([
    //         'price' => 1000
    //     ]);
    //     $this->assertEquals(Money::class, $product->price, '1000');
    // }

    public function test_it_has_many_categories()
    {
        $product = factory(Product::class)->create();

        $product->categories()->save(factory(Category::class)->create());

        $this->assertInstanceOf(Category::class, $product->categories->first());
    }

    public function test_it_returns_a_money_instance_for_the_price()
    {
        $product = factory(Product::class)->create();

        $this->assertInstanceOf(Money::class, $product->price);
    }

    public function test_it_uses_the_slug_for_the_route_key_name()
    {
        $product = new Product();
        $this->assertEquals($product->getRouteKeyName(), 'slug');
    }

    public function test_product_should_have_many_variations()
    {
        $product = factory(Product::class)->create();

        $product->variations()->save(factory(ProductVariation::class)->create());

        $this->assertInstanceOf(ProductVariation::class, $product->variations->first());
    }
}

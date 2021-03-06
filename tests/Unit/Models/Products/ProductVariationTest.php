<?php

namespace Tests\Unit\Models\Products;

use Tests\TestCase;
use App\App\Domain\Cart\Money;
use App\Stocks\Domain\Models\Stock;
use App\Products\Domain\Models\Product;
use App\ProductVariation\Domain\Models\ProductVariation;
use App\ProductVariationType\Domain\Models\ProductVariationType;

class ProductVariationTest extends TestCase
{
    public function test_it_belongs_to_a_product()
    {
        $variation = factory(ProductVariation::class)->create();

        $this->assertInstanceOf(Product::class, $variation->product);
    }

    public function test_it_can_check_if_its_in_stock()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make()
        );
        $this->assertTrue($variation->inStock());
    }

    public function test_it_can_check_if_the_variation_price_is_different_to_the_product()
    {
        $product = factory(Product::class)->create([
            'price' => 1000,
        ]);

        $variation = factory(ProductVariation::class)->create([
            'price' => 2000,
            'product_id' => $product->id,
        ]);

        $this->assertTrue($variation->priceVaries());
    }

    public function test_it_can_get_stock_count()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 5,
            ])
        );

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 5,
            ])
        );
        $this->assertEquals($variation->stockCount(), $quantity * 2);
    }

    public function test_it_can_get_the_minimum_stock_for_a_given_value()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 5,
            ])
        );
        $this->assertEquals($variation->minStock(200), $quantity);
    }

    public function test_it_has_in_stock_pivot_within_stock_information()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make()
        );
        $this->assertTrue($variation->stock->first()->pivot->in_stock);
    }

    public function test_it_has_many_stocks()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make()
        );
        $this->assertInstanceOf(Stock::class, $variation->stocks->first());
    }

    public function test_it_has_one_variation()
    {
        $variation = factory(ProductVariation::class)->create();

        $this->assertInstanceOf(ProductVariationType::class, $variation->type);
    }

    public function test_it_has_stock_count_pivot_within_stock_information()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 5,
            ])
        );
        $this->assertEquals($variation->stock->first()->pivot->stock, $quantity);
    }

    public function test_it_has_stock_information()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make()
        );
        $this->assertInstanceOf(ProductVariation::class, $variation->stock->first());
    }

    public function test_it_returns_a_money_instance_for_the_price()
    {
        $variation = factory(ProductVariation::class)->create();

        $this->assertInstanceOf(Money::class, $variation->price);
    }

    public function test_it_returns_the_product_price_if_price_is_null()
    {
        $product = factory(Product::class)->create([
            'price' => 1000,
        ]);

        $variation = factory(ProductVariation::class)->create([
            'price' => null,
            'product_id' => $product->id,
        ]);
        $this->assertEquals($product->price->amount(), $variation->price->amount());
    }
}

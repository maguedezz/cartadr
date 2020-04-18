<?php

namespace Tests\Unit\Models\Categories;

use App\Categories\Domain\Models\Category;
use App\Products\Domain\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    public function test_it_has_many_children()
    {
        $category = factory(Category::class)->create();

        $category->children()->save(
            factory(Category::class)->create()
        );

        $this->assertInstanceOf(Category::class, $category->children->first());
    }

    public function test_it_can_fetch_only_parents()
    {
        //  Create a category
        $category = factory(Category::class)->create();

        $category->children()->save(
            factory(Category::class)->create()
        );

        $this->assertEquals(1, Category::parents()->count());
    }

    public function test_it_is_ordered_by_a_numbered_order()
    {
        //  Create a category
        $category = factory(Category::class)->create([
            'order' => 2
        ]);

        $anothercategory = factory(Category::class)->create([
            'order' => 1
        ]);


        $this->assertEquals($anothercategory->name, Category::ordered()->first()->name);
    }

    public function test_it_has_many_products()
    {
        $category = factory(Category::class)->create();

        $category->products()->save(factory(Product::class)->create()
        );

        $this->assertInstanceOf(Product::class, $category->products->first());
    }
}

<?php

namespace Tests\Feature\Categories;

use Tests\TestCase;
use App\Categories\Domain\Models\Category;

class CategoryIndexTest extends TestCase
{
    /** @test */
    public function test_it_returns_a_collection_of_categories()
    {
        $categories = factory(Category::class, 2)->create();
        $response = $this->get('/api/categories');
        $categories->each(function ($category) use ($response) {
            $response->assertJsonFragment([
                'slug' => $category->slug,
            ]);
        });
    }

    /** @test */
    public function test_it_returns_categories_ordered_by_their_given_order()
    {
        $category = factory(Category::class)->create([
            'order' => 2,

        ]);

        $anothercategory = factory(Category::class)->create([
            'order' => 1,

        ]);

        $category->children()->save(factory(Category::class)->create());

        $this->get('api/categories')
            ->assertSeeInOrder([
                $anothercategory->slug, $category->slug,
            ]);
    }

    /** @test */
    public function test_it_returns_only_parent_categories()
    {
        $category = factory(Category::class)->create();
        $category->children()->save(factory(Category::class)->create());

        $this->get('api/categories')->assertJsonCount(1, 'data');
    }
}

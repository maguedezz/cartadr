<?php

use Illuminate\Database\Seeder;
use App\ProductVariation\Domain\Models\ProductVariation;

class Product_VariationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductVariation::create([
            'product_id' => '1',
            'name' => '250g',
            'price' => null,
            'order' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW(),
            'product_variation_type_id' => '1',
        ]);

        ProductVariation::create([
            'product_id' => '1',
            'name' => '500g',
            'price' => null,
            'order' => 2,
            'created_at' => NOW(),
            'updated_at' => NOW(),
            'product_variation_type_id' => '1',
        ]);

        ProductVariation::create([
            'product_id' => '1',
            'name' => '1kg',
            'price' => null,
            'order' => 3,
            'created_at' => NOW(),
            'updated_at' => NOW(),
            'product_variation_type_id' => '1',
        ]);
    }
}

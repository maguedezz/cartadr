<?php

use Illuminate\Database\Seeder;
use App\Stocks\Domain\Models\Stock;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stock::create([
            'quantity' => '100',
            'product_variation_id' => '1',
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);
    }
}

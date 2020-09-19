<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Stocks\Domain\Models\Stock;

$factory->define(Stock::class, function (Faker $faker) {
    return [
        'quantity' => 2,
    ];
});

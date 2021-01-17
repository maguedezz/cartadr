<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Countries\Domain\Models\Country;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'code' => 'GB',
        'name' => 'United Kingdom',
    ];
});

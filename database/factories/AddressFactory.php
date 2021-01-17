<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Addresses\Domain\Models\Address;
use App\Countries\Domain\Models\Country;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address_1' => $faker->address,
        'city' => $faker->city,
        'postal_code' => $faker->postcode,
        'country_id' => factory(Country::class)->create()->id,
    ];
});

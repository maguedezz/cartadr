<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categories\Domain\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::
class , function (Faker $faker) {
		return [
			'name' => $name = $faker->unique()->name,
			'slug' => ($name),
		];
	});

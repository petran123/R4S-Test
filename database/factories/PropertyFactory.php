<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Property;
use Faker\Generator as Faker;

$factory->define(Property::class, function (Faker $faker) {
    return [
        'manager_id' => factory('App\User')->create(),
        'address_line_1' => $faker->address,
        'address_line_2' => $faker->address,
        'town' => $faker->city,
        'county' => $faker->city,
        'postcode' => $faker->postcode,
        'monthly_rent_in_gbp' => 600
    ];
});

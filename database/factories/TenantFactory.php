<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tenant;
use Faker\Generator as Faker;

$factory->define(Tenant::class, function (Faker $faker) {
    return [
        'property_id' => factory('App\Property')->create()->id,
        'given_name' => $faker->firstName,
        'family_name' => $faker->lastName,
        'share_of_rent_in_gbp' => 300
    ];
});

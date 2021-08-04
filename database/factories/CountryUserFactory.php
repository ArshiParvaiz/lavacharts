<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CountryUser;
use Faker\Generator as Faker;

$factory->define(CountryUser::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->country,
         'total_users' =>rand(100,1000),
    ];
});
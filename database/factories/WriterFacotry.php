<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Writer;
use Faker\Generator as Faker;

$factory->define(Writer::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});

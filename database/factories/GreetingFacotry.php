<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Greeting;
use App\Writer;
use Faker\Generator as Faker;

$factory->define(Greeting::class, function (Faker $faker) {
    return [
        'body' => $faker->text,
		'writer_id' => function (){
			return factory(Writer::class)->create()->id;
		}
    ];
});

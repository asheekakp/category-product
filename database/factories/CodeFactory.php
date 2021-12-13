<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Code;
use Faker\Generator as Faker;

$factory->define(Code::class, function (Faker $faker) {
    $type = $faker->numberBetween(1, 5);
    return [
        'code' => $type . $faker->unique()->numerify('#########'),
        'type' => $type,
        'assigned' => false,
        'image_url' => $faker->imageUrl(250, 250, 'abstract'),
    ];
});

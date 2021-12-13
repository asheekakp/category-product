<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Notification;
use App\User;
use Faker\Generator as Faker;

$factory->define(Notification::class, function (Faker $faker) {
    return [
        'user_id' => User::inRandomOrder()->first()->id,
        'message' => $faker->sentence(10, true),
        'read' => 0
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Business;
use App\User;
use Faker\Generator as Faker;

$factory->define(Business::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'category' => $faker->randomElement($array = array('Pub', 'Restaurant', 'Grocery Shop', 'Super Market', 'Pharmacy', 'IT Company', 'Vehicle Service')),
        'email' => $faker->safeEmail,
        'address_line_1' => $faker->streetName,
        'full_address' => $faker->streetAddress . ' ' . $this->faker->city,
        'pin' => $faker->numerify('######'),
        // 'user_id' => factory(App\User::class)->create(['user_type' => 2]),
        'user_id' => User::where('user_type', 2)->inRandomOrder()->first()->id,
    ];
});

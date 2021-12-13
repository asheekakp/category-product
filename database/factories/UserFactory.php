<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'mobile' => $faker->unique()->numerify('##########'),
        'mobile_verified_at' => now(),
        'user_type' => $faker->numberBetween(1, 2),
        'dob' => $faker->date,
        'gender' => $faker->randomElement($array = array('man', 'woman', 'non-binary')),
        'pin' => $faker->numerify('######'),
        'address' => $faker->streetName . ' ' . $faker->streetAddress . ' ' . $this->faker->city,
        'profile_photo' => $faker->imageUrl(250, 250, 'cats'),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

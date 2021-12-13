<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Business;
use App\Code;
use App\CodeLink;
use Faker\Generator as Faker;

$factory->define(CodeLink::class, function (Faker $faker) {
    $code = Code::where('assigned', false)->first();
    $business = Business::inRandomOrder()->first();
    $code->assigned = true;
    $code->save();
    return [
        'code_id' => $code->id,
        'business_id' => $business->id,
    ];
});

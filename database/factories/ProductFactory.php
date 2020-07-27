<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    $randomNumbers = [];
    for ($i = 0; $i < 2; $i++) {
        $randomNumbers[] = $faker->numberBetween($min = 1, $max = 13);
    }

    return [
        'sku' => $faker->bothify('??-??'),
        'name' => $faker->text($min = 10, $max = 30),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 200),
        'weather_conditions' => json_encode($randomNumbers),
    ];
});

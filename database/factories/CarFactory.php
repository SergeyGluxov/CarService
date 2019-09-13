<?php

use Faker\Generator as Faker;

$factory->define(App\Car::class, function (Faker $faker) {
    return [
        'brand'=>$faker->title,
        'model'=>$faker->title,
        'image'=>'default.png',
    ];
});

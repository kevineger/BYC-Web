<?php
/*
|--------------------------------------------------------------------------
| Course Factories
|--------------------------------------------------------------------------
*/
// Generic Course
$factory->define(App\Category::class, function (Faker\Generator $faker)
{
    return [
        'text' => $faker->randomElement(['Sports','Art','Education', 'Dance', 'Music']),
    ];
});
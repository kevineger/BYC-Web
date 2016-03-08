<?php

/*
|--------------------------------------------------------------------------
| School Factories
|--------------------------------------------------------------------------
*/

// Generic User
$factory->define(App\School::class, function (Faker\Generator $faker)
{
    return [
        'name'        => $faker->company . " School",
        'description' => $faker->paragraph(8),
        'address'     => $faker->address,
    ];
});
<?php

/*
|--------------------------------------------------------------------------
| Course Factories
|--------------------------------------------------------------------------
*/

// Generic Course
$factory->define(App\Course::class, function (Faker\Generator $faker)
{
    return [
        'name'        => 'Learn ' . $faker->word,
        'description' => $faker->paragraph(3),
        'active'      => true,
        'min_age'     => $faker->numberBetween(3, 8),
        'max_age'     => $faker->numberBetween(8, 19),
        'price'       => $faker->randomFloat(2, 10, 50),
    ];
});

// Inactive Course
$factory->defineAs(App\Course::class, 'inactive', function ($faker) use ($factory)
{
    $course = $factory->raw(App\Course::class);

    return array_merge($course, ['active' => false]);
});
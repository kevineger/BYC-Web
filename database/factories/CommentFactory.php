<?php

/*
|--------------------------------------------------------------------------
| Comment Factories
|--------------------------------------------------------------------------
*/

$factory->define(App\Comment::class, function (Faker\Generator $faker)
{
    return [
        'text' => $faker->paragraph(3),
    ];
});
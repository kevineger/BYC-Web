<?php

/*
|--------------------------------------------------------------------------
| User Factories
|--------------------------------------------------------------------------
*/

// Generic User
$factory->define(App\User::class, function (Faker\Generator $faker)
{
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});

// A Consumer User
$factory->defineAs(App\User::class, 'consumer', function ($faker) use ($factory)
{
    $user = $factory->raw(App\User::class);

    return array_merge($user, ['school' => false]);
});

// A School User
$factory->defineAs(App\User::class, 'school', function ($faker) use ($factory)
{
    $user = $factory->raw(App\User::class);

    return array_merge($user, ['school' => true]);
});
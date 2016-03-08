<?php

/*
|--------------------------------------------------------------------------
| Time Factories
|--------------------------------------------------------------------------
*/

// Generic Course
$factory->define(App\Time::class, function (Faker\Generator $faker) {
    return [
        'time_of_day'    => $faker->dateTimeBetween('-1 years', 'now'),
        'beginning_date' => $faker->dateTimeBetween('-1 years', 'now'),
        'end_date'       => $faker->dateTimeBetween('now', '2 years')
    ];
});

/*
|--------------------------------------------------------------------------
| Days of the week
|--------------------------------------------------------------------------
*/

// Weekly
$factory->defineAs(App\Time::class, 'w', function ($faker) use ($factory) {
    $time = $factory->raw(App\Time::class);
    $days_of_the_week = [
        'mon'   => false,
        'tues'  => false,
        'wed'   => false,
        'thurs' => false,
        'fri'   => false,
        'sat'   => false,
        'sun'   => false,
    ];
    // Assign days of week with 25% probability
    foreach ( $days_of_the_week as $day => $value ) {
        if ( rand(1,4) == 1 ) {
            $days_of_the_week[$day] = true;
        }
    }
    $assigned_random_day = array_rand($days_of_the_week);
    if ( $days_of_the_week[$assigned_random_day] == false)
        $days_of_the_week[$assigned_random_day] = true;

    return array_merge($time, $days_of_the_week, ['repeats' => 'w']);
});
// Biweekly
$factory->defineAs(App\Time::class, 'b', function ($faker) use ($factory) {
    $time = $factory->raw(App\Time::class);
    $days_of_the_week = [
        'mon'   => false,
        'tues'  => false,
        'wed'   => false,
        'thurs' => false,
        'fri'   => false,
        'sat'   => false,
        'sun'   => false,
    ];
    // Assign days of week with 25% probability
    foreach ( $days_of_the_week as $day => $value ) {
        if ( rand(1,4) == 1 ) {
            $days_of_the_week[$day] = true;
        }
    }
    $assigned_random_day = array_rand($days_of_the_week);
    if ( $days_of_the_week[$assigned_random_day] == false)
        $days_of_the_week[$assigned_random_day] = true;

    return array_merge($time, $days_of_the_week, ['repeats' => 'b']);
});
// Monthly
$factory->defineAs(App\Time::class, 'm', function ($faker) use ($factory) {
    $time = $factory->raw(App\Time::class);
    $days_of_the_week = [
        'mon'   => false,
        'tues'  => false,
        'wed'   => false,
        'thurs' => false,
        'fri'   => false,
        'sat'   => false,
        'sun'   => false,
    ];
    // Assign days of week with 25% probability
    foreach ( $days_of_the_week as $day => $value ) {
        if ( rand(1,4) == 1 ) {
            $days_of_the_week[$day] = true;
        }
    }
    $assigned_random_day = array_rand($days_of_the_week);
    if ( $days_of_the_week[$assigned_random_day] == false)
        $days_of_the_week[$assigned_random_day] = true;

    return array_merge($time, $days_of_the_week, ['repeats' => 'm']);
});
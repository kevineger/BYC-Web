<?php

/*
|--------------------------------------------------------------------------
| Time Factories
|--------------------------------------------------------------------------
*/
use Carbon\Carbon;

// Generic Course

$factory->define(App\Time::class, function (Faker\Generator $faker) {
    $start_time = Carbon::createFromTime(8, 30);
    $end_time = Carbon::createFromTime(9, 30);

    return [
        'start_time'     => $start_time,
        'end_time'       => $end_time,
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
        'mon' => false,
        'tue' => false,
        'wed' => false,
        'thu' => false,
        'fri' => false,
        'sat' => false,
        'sun' => false,
    ];
    // Assign days of week with 25% probability
    foreach ( $days_of_the_week as $day => $value ) {
        if ( rand(1, 4) == 1 ) {
            $days_of_the_week[$day] = true;
        }
    }
    $assigned_random_day = array_rand($days_of_the_week);
    if ( $days_of_the_week[$assigned_random_day] == false )
        $days_of_the_week[$assigned_random_day] = true;

    return array_merge($time, $days_of_the_week, ['repeats' => 'w']);
});
// Biweekly
$factory->defineAs(App\Time::class, 'b', function ($faker) use ($factory) {
    $time = $factory->raw(App\Time::class);
    $days_of_the_week = [
        'mon' => false,
        'tue' => false,
        'wed' => false,
        'thu' => false,
        'fri' => false,
        'sat' => false,
        'sun' => false,
    ];
    // Assign days of week with 25% probability
    foreach ( $days_of_the_week as $day => $value ) {
        if ( rand(1, 4) == 1 ) {
            $days_of_the_week[$day] = true;
        }
    }
    $assigned_random_day = array_rand($days_of_the_week);
    if ( $days_of_the_week[$assigned_random_day] == false )
        $days_of_the_week[$assigned_random_day] = true;

    return array_merge($time, $days_of_the_week, ['repeats' => 'b']);
});
// Monthly
$factory->defineAs(App\Time::class, 'm', function ($faker) use ($factory) {
    $time = $factory->raw(App\Time::class);
    $days_of_the_week = [
        'mon' => false,
        'tue' => false,
        'wed' => false,
        'thu' => false,
        'fri' => false,
        'sat' => false,
        'sun' => false,
    ];
    // Assign days of week with 25% probability
    foreach ( $days_of_the_week as $day => $value ) {
        if ( rand(1, 4) == 1 ) {
            $days_of_the_week[$day] = true;
        }
    }
    $assigned_random_day = array_rand($days_of_the_week);
    if ( $days_of_the_week[$assigned_random_day] == false )
        $days_of_the_week[$assigned_random_day] = true;

    return array_merge($time, $days_of_the_week, ['repeats' => 'm']);
});
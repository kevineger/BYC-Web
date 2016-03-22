<?php

/*
|--------------------------------------------------------------------------
| Time Factories
|--------------------------------------------------------------------------
*/
use Carbon\Carbon;

// Generic Course

$factory->define(App\Time::class, function (Faker\Generator $faker)
{
    // Add a start time and end time
    $hours = ['8', '9', '10', '11', '12', '13', '14', '15', '16'];
    $minutes = ['00', '15', '30', '45'];
    $rand_key = array_rand($hours, 1);
    // TODO: Find better way than hard setting the y/m/d to compare just the times. Not sure how it's done with eloquent model query builder
    $start_time = Carbon::createFromFormat('Y:m:d H:i', "1994:08:24 " . $hours[$rand_key] . ":" . $minutes[$rand_key % 4]);
    $end_time = $start_time->copy()->addHour($rand_key % 2 + 1);

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
$factory->defineAs(App\Time::class, 'w', function ($faker) use ($factory)
{
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
    foreach ($days_of_the_week as $day => $value)
    {
        if (rand(1, 4) == 1)
        {
            $days_of_the_week[$day] = true;
        }
    }
    $assigned_random_day = array_rand($days_of_the_week);
    if ($days_of_the_week[$assigned_random_day] == false)
        $days_of_the_week[$assigned_random_day] = true;

    return array_merge($time, $days_of_the_week, ['repeats' => 'w']);
});
// Biweekly
$factory->defineAs(App\Time::class, 'b', function ($faker) use ($factory)
{
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
    foreach ($days_of_the_week as $day => $value)
    {
        if (rand(1, 4) == 1)
        {
            $days_of_the_week[$day] = true;
        }
    }
    $assigned_random_day = array_rand($days_of_the_week);
    if ($days_of_the_week[$assigned_random_day] == false)
        $days_of_the_week[$assigned_random_day] = true;

    return array_merge($time, $days_of_the_week, ['repeats' => 'b']);
});
// Monthly
$factory->defineAs(App\Time::class, 'm', function ($faker) use ($factory)
{
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
    foreach ($days_of_the_week as $day => $value)
    {
        if (rand(1, 4) == 1)
        {
            $days_of_the_week[$day] = true;
        }
    }
    $assigned_random_day = array_rand($days_of_the_week);
    if ($days_of_the_week[$assigned_random_day] == false)
        $days_of_the_week[$assigned_random_day] = true;

    return array_merge($time, $days_of_the_week, ['repeats' => 'm']);
});
<?php
/*
|--------------------------------------------------------------------------
| Course Factories
|--------------------------------------------------------------------------
*/

$factory->defineAs(App\Category::class, 'Sports', function ()
{
    return [
        'text' => 'Sports',
    ];
});
$factory->defineAs(App\Category::class, 'Music', function ()
{
    return [
        'text' => 'Music',
    ];
});
$factory->defineAs(App\Category::class, 'Art', function ()
{
    return [
        'text' => 'Art',
    ];
});
$factory->defineAs(App\Category::class, 'Education', function ()
{
    return [
        'text' => 'Education',
    ];
});
$factory->defineAs(App\Category::class, 'Cooking', function ()
{
    return [
        'text' => 'Cooking',
    ];
});
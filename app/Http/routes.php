<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@home');

Route::resource('schools', 'SchoolsController');
Route::post('schools/{schools}/addPhoto', ['as' => 'addPhotoToSchool', 'uses' => 'SchoolsController@addPhoto']);
Route::post('schools/{schools}/removePhoto', ['as' => 'removePhotoFromSchool', 'uses' => 'SchoolsController@removePhoto']);
Route::resource('courses', 'CoursesController');


Route::group(['prefix' => 'cart'], function ()
{
    Route::get('/', 'CartController@index');
    Route::post('{courses}/add', [
        'uses' => 'CartController@add',
        'as'   => 'cart.add'
    ]);
    Route::delete('/', [
        'uses' => 'CartController@destroyCart',
        'as'   => 'cart.destroyCart'
    ]);
    Route::delete('{cart}', [
        'uses' => 'CartController@destroy',
        'as'   => 'cart.destroy'
    ]);
    Route::put('update', [
        'uses' => 'CartController@update',
        'as'   => 'cart.update'
    ]);
    Route::get('buy', [
        'uses' => 'CartController@buy',
        'as'   => 'cart.buy'
    ]);
});


Route::resource('users', 'UsersController', [
    'except' => [
        'index',
        'create',
        'store'
    ]
]);

// Authentication routes
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Social Authentication routes
Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');

/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'api/v1', 'middleware' => ['cors']], function ()
{
    Route::resource('schools', 'API\ApiSchoolsController');
    Route::resource('courses', 'API\ApiCoursesController');
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::post('register', 'API\ApiUsersController@register');
//    Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
});

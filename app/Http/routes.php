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
Route::get('/contact', 'PagesController@contact');

Route::resource('schools', 'SchoolsController');
Route::post('schools/{schools}/addPhoto', ['as' => 'addPhotoToSchool', 'uses' => 'SchoolsController@addPhoto']);
Route::post('schools/{schools}/removePhoto', ['as' => 'removePhotoFromSchool', 'uses' => 'SchoolsController@removePhoto']);
Route::resource('courses', 'CoursesController');
Route::post('courses/{courses}/addPhoto', ['as' => 'addPhotoToCourse', 'uses' => 'CoursesController@addPhoto']);
Route::post('courses/{courses}/removePhoto', ['as' => 'removePhotoFromCourse', 'uses' => 'CoursesController@removePhoto']);

Route::resource('users', 'UsersController', [
    'except' => [
        'index',
        'create',
        'store'
    ]
]);
Route::post('users/{users}/addPhoto', ['as' => 'addPhotoToUser', 'uses' => 'UsersController@addPhoto']);
Route::post('users/{users}/removePhoto', ['as' => 'removePhotoFromUser', 'uses' => 'UsersController@removePhoto']);

Route::get('search', 'SearchController@index');

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
| PayPal
|--------------------------------------------------------------------------
*/
Route::post('payment', array(
    'as'   => 'payment',
    'uses' => 'PayPalController@postPayment',
));

// this is after make the payment, PayPal redirect back to your site
Route::get('payment/status', array(
    'as'   => 'payment.status',
    'uses' => 'PayPalController@getPaymentStatus',
));

/*
|--------------------------------------------------------------------------
| Cart
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'cart'], function ()
{
    Route::get('/', 'CartController@index');
    Route::post('{courses}/{times}/add', [
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
});

/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'api/v1', 'middleware' => ['cors']], function ()
{
    Route::resource('schools', 'API\ApiSchoolsController');
    Route::get('schools/{schools}/courses', 'API\ApiSchoolsController@getCourses');
    Route::resource('courses', 'API\ApiCoursesController');
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::post('register', 'API\ApiUsersController@register');
//    Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
});

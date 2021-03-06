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

/*
|--------------------------------------------------------------------------
| Generic Static Pages
|--------------------------------------------------------------------------
*/
Route::get('/', 'PagesController@home');
Route::post('/', [
    'uses' => 'SearchController@index',
    'as'   => 'global.search'
]);
Route::get('/contact', 'PagesController@contact');
Route::get('/privacy', 'PagesController@privacy');
Route::get('/about', 'PagesController@about');
Route::get('/terms', 'PagesController@terms');

/*
|--------------------------------------------------------------------------
| Schools
|--------------------------------------------------------------------------
*/
Route::resource('schools', 'SchoolsController');
Route::post('schools/{schools}/addPhoto', ['as' => 'addPhotoToSchool', 'uses' => 'SchoolsController@addPhoto']);
Route::post('schools/{schools}/removePhoto', ['as' => 'removePhotoFromSchool', 'uses' => 'SchoolsController@removePhoto']);
Route::post('schools/{schools}/comment', 'SchoolsController@addComment');

/*
|--------------------------------------------------------------------------
| Courses
|--------------------------------------------------------------------------
*/
Route::post('courses/{courses}/comment', 'CoursesController@addComment');
Route::resource('courses', 'CoursesController');
Route::post('courses/{courses}/addPhoto', ['as' => 'addPhotoToCourse', 'uses' => 'CoursesController@addPhoto']);
Route::post('courses/{courses}/removePhoto', ['as' => 'removePhotoFromCourse', 'uses' => 'CoursesController@removePhoto']);
Route::get('courses/{courses}/details', 'CoursesController@details');
Route::get('courses/{courses}/seats', 'CoursesController@seats');
Route::get('courses/{courses}/{times}/increaseSeats', 'CoursesController@increaseSeats');
Route::get('courses/{courses}/{times}/decreaseSeats', 'CoursesController@decreaseSeats');
Route::get('courses/{courses}/{times}/increaseRegistered', 'CoursesController@increaseRegistered');

/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
*/
Route::resource('users', 'UsersController', [
    'except' => [
        'index',
        'create',
        'store'
    ]
]);

Route::get('admin', 'UsersController@admin');
Route::post('admin/school/{schools}/feature', 'UsersController@featureSchool');
Route::post('admin/course/{courses}/feature', 'UsersController@featureCourse');
Route::post('admin/addBanner', [
    'as'   => 'addBanner',
    'uses' => 'BannersController@addBanner'
]);
Route::post('admin/removeBanner', [
    'as'   => 'removeBanner',
    'uses' => 'BannersController@removeBanner'
]);

Route::post('users/{users}/addPhoto', ['as' => 'addPhotoToUser', 'uses' => 'UsersController@addPhoto']);
Route::post('users/{users}/removePhoto', ['as' => 'removePhotoFromUser', 'uses' => 'UsersController@removePhoto']);
// Authentication routes
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// Registration routes
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
// Email Confirmation Routes
get('auth/register/confirm/{token}', 'Auth\AuthController@confirmEmail');
// Password reset link request routes.
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
// Password reset routes.
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
// Social Authentication routes
// TODO: All of it.
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
    Route::post('schools/{schools}/comments', 'API\ApiSchoolsController@addComment');
    Route::post('courses/{courses}/comments', 'API\ApiCoursesController@addComment');
    Route::resource('schools', 'API\ApiSchoolsController');
    Route::get('schools/{schools}/courses', 'API\ApiSchoolsController@getCourses');
    Route::resource('courses', 'API\ApiCoursesController');
    Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'AuthenticateController@authenticate');
    Route::post('register', 'API\ApiUsersController@register');
    Route::post('payment/status', 'API\ApiPayPalController@getPaymentStatus');
//    Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
    Route::get('courses/{courses}/comments', 'API\ApiCommentsController@show');
    Route::get('schools/{schools}/comments', 'API\ApiCommentsController@show');
    Route::get('users/dash', 'API\ApiUsersController@getCourseHistory');
    Route::get('category', 'API\ApiCategoriesController@index');
    Route::post('users/delete', 'API\ApiUsersController@destroy');
});

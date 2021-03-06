<?php

namespace App\Providers;

use Cart;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        // School route-model binding
        $router->bind('schools', function ($id)
        {
            return \App\School::findOrFail($id);
        });

        // Course route-model binding
        $router->bind('courses', function ($id)
        {
            return \App\Course::findOrFail($id);
        });

        // User route-model binding
        $router->bind('users', function ($id)
        {
            return \App\User::findOrFail($id);
        });

        // Time route-model binding
        $router->bind('times', function ($id)
        {
            return \App\Time::findOrFail($id);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router)
        {
            require app_path('Http/routes.php');
        });
    }
}

var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.sass('app.scss')
        .scripts([
            './vendor/semantic/ui/dist/semantic.min.js',
            'libs/lity.js',
            'libs/jquery-clockpicker.min.js',
            'libs/jquery-ui.js'
        ], './public/js/libs.js')
        .scripts([
            'app.js'
        ], './public/js/scripts.js')
        .styles([
            './vendor/semantic/ui/dist/semantic.min.css',
            'libs/lity.css',
            'libs/jquery-clockpicker.min.css',
            'libs/jquery-ui.css',
            'libs/jquery-ui.theme.css'
        ], './public/css/libs.css');
});

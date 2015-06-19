var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.config.sourcemaps = false;

elixir(function(mix) {

    mix.sass('app.scss', 'resources/css');

    mix.styles([
        'vendor/bootstrap.min.css',
        'vendor/bootstrap-rtl.min.css',
        'app.css'
    ], 'public/css/all.css', 'resources/css');

    //mix.scripts([
    //    'vendor/jQuery.min.js',
    //    'vendor/bootstrap.min.js',
    //    'vendor/select2.js',
    //]);

});

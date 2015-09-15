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

    var paths = {
        'jquery': './vendor/components/',
        'bootstrap': './vendor/twbs/bootstrap/dist/'
    };

    mix.sass('app.scss', 'resources/css');
    mix.sass('admin.scss', 'resources/css/admin.css');

    mix.copy(paths.bootstrap + 'fonts/**', 'public/fonts');
    mix.copy(paths.bootstrap + 'css/bootstrap.min.css', 'resources/css/vendor');

    mix.styles([
        'vendor/bootstrap.min.css',
        'vendor/bootstrap-rtl.min.css',
        'app.css'
    ], 'public/css/all.css', 'resources/css');

    mix.styles([
        'vendor/bootstrap.min.css',
        'vendor/bootstrap-rtl.min.css',
        'admin.css'
    ], 'public/css/admin.css', 'resources/css');

    //mix.scripts([
    //    'vendor/jQuery.min.js',
    //    'vendor/bootstrap.min.js',
    //    'vendor/select2.js',
    //]);

});

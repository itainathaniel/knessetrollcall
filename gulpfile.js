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
        'jquery': './vendor/components/jquery/',
        'bootstrap': './vendor/twbs/bootstrap/dist/'
    };

    mix.sass('app.scss', 'resources/css');
    mix.sass('homepage.scss', 'resources/css/homepage.css');
    mix.sass('admin.scss', 'resources/css/admin.css');

    mix.copy(paths.bootstrap + 'fonts/**', 'public/fonts');
    mix.copy(paths.bootstrap + 'css/bootstrap.min.css', 'resources/css/vendor');

    mix.styles([
        'vendor/bootstrap.min.css',
        'vendor/bootstrap-rtl.min.css',
        'app.css'
    ], 'public/css/all.css', 'resources/css');

    mix.styles([
        'vendor/mmenu.css',
        'homepage.css'
    ], 'public/css/homepage.css', 'resources/css');

    mix.styles([
        'vendor/bootstrap.min.css',
        'vendor/bootstrap-rtl.min.css',
        'admin.css'
    ], 'public/css/admin.css', 'resources/css');

    mix.copy(paths.jquery + 'jquery.min.js', 'resources/js/vendor');
    mix.copy(paths.bootstrap + 'js/bootstrap.min.js', 'resources/js/vendor');

    mix.scripts([
        'vendor/jquery.min.js',
        'vendor/highcharts.js',
        'vendor/highcharts-more.js',
        'vendor/jquery.mmenu.js',
        'script.js'
    ], 'public/js/app.js', 'resources/js');

    mix.scripts([
        'homepage.js'
    ], 'public/js/homepage.js', 'resources/js');

    mix.scripts([
        'vendor/jquery.min.js',
        'vendor/bootstrap.min.js',
        //'vendor/select2.js',
    ], 'public/js/admin.js', 'resources/js');

});

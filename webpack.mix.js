let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles([
    'resources/assets/admin/css/bootstrap.min.css',
    'resources/assets/admin/css/bootstrap-theme.min.css',
], 'public/css/admin/bootstrap.css');

mix.styles([
    'resources/assets/admin/css/animate.min.css',
    'resources/assets/admin/css/jquery.scrollbar.css',
    'resources/assets/admin/css/font-awesome.css',
], 'public/css/admin/libs.css');

mix.scripts([
    'resources/assets/admin/js/jquery-1.11.3.min.js',
    'resources/assets/admin/js/bootstrap.min.js',
    'resources/assets/admin/js/jqueryblockui.js',
    'resources/assets/admin/js/jquery.unveil.min.js',
    'resources/assets/admin/js/jquery.animateNumbers.js',
    'resources/assets/admin/js/jquery.validate.min.js',
    'resources/assets/admin/js/admin.js',
    'resources/assets/admin/js/jquery-ui-1.10.1.custom.min.js',
    'resources/assets/admin/js/dashboard_v2.js',

], 'public/js/admin/libs.js');

mix.copy('resources/assets/admin/css/admin.css', 'public/css/admin/admin.css');

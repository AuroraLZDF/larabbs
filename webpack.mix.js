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

mix.js('resources/assets/js/app.js', 'public/js/bbs')
    .sass('resources/assets/sass/app.scss', 'public/css/bbs')
    //.copyDirectory('resources/assets/editor-md', 'public/js/editor-md/')
    .copyDirectory('resources/assets/simditor/js', 'public/js/simditor/')
    .copyDirectory('resources/assets/simditor/css', 'public/css/simditor/')
    ;
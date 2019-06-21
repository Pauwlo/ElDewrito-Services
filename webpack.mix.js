const mix = require('laravel-mix');

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
       'resources/css/template.min.css'
    ], 'public/css/app.min.css')
   .js('resources/js/template.min.js', 'public/js/app.min.js')
   .js('resources/js/subreddit-parser.js', 'public/js/subreddit-parser.min.js')

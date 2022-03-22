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

mix.js('resources/js/app.js', 'public/js')
    .scripts([
        'resources/js/script/popup.js',
        'resources/js/script/display_hidden.js',
        'resources/js/script/character_count.js',
        'resources/js/script/play_recording.js',
        'resources/js/script/language_fill_form.js'
    ], 'public/dist/main.js') // creates 'dist/script.js'
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
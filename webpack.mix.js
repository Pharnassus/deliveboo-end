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
    .js('resources/js/details.js', 'public/js')
    .js('resources/js/payment.js', 'public/js')
    .js('resources/js/checkout.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/app2.scss', 'public/css')
    .sass('resources/sass/menu.scss', 'public/css')
    .sass('resources/sass/paymentSuccess.scss', 'public/css')
    .sass('resources/sass/payment.scss', 'public/css')
    .vue({version:2});
    /* .options({
    processCssUrls: false // questa opzione fa in modo da non modificare i percorsi delle immagini
    }) */
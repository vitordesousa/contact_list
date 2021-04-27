const mix = require('laravel-mix');

let webpackConfig = {
    resolve: {
        alias: {
            //'vue$':  'node_modules/vue/dist/vue.esm',
            'vue$':  'vue/dist/vue.common.js',
        }
    }
};

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

mix.webpackConfig(webpackConfig)
.setPublicPath('public')
.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

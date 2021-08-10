let mix = require('laravel-mix');

mix
    .js('pwa/app.js', 'dist')
    .vue()
    .setPublicPath('public/dist');

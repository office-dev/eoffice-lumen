let mix = require('laravel-mix');

mix.setPublicPath('public');

mix
    .js('pwa/app.js', 'dist')
    .vue({version: 3})
    .browserSync({
    })
;

mix.sass('./pwa/assets/scss/style.scss', 'dist')

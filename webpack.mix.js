const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

mix.scripts('node_modules/jquery/dist/jquery.js', 'public/site/jquery.js');

mix.scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/site/bootstrap.js');

mix.sass('resources/views/scss/style.scss', 'public/site/style.css');


const mix = require('laravel-mix');

mix.js('resources/js/front.js', 'public/js').vue()
    .postCss('resources/css/front.css', 'public/css', []).version();

mix.js('resources/js/admin.js', 'public/js').vue()
    .postCss('resources/css/admin.css', 'public/css', []).version();
const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss")
    ]).browserSync('http://bravebat.test');

if (mix.inProduction()) {
    mix.version();
}

mix.disableNotifications();

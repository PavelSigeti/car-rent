const mix = require('laravel-mix');

require('laravel-mix-clean-css');

mix.disableNotifications();

mix.sass('resources/scss/style.scss', 'styles')
    .cleanCss({
        level: 2,
    });
mix.sass('resources/scss/media.scss', 'styles')
    .cleanCss({
        level: 2,
    });

mix.js([
    'resources/js/script.js',
], 'public/js/script.js');


mix.browserSync('foxrent.loc');

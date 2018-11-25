const mix = require('laravel-mix')

mix.browserSync('http://localhost:8080')

mix.js('resources/js/app.js', 'public/js')
    .extract(['vue', 'vue-router', 'axios', 'vuex'])
    .sass('resources/sass/app.scss', 'public/css')

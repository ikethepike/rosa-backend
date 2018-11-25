const mix = require('laravel-mix')

mix.browserSync('http://localhost:8080')

mix
  .js('resources/assets/js/app.js', 'public/js')
  .extract(['vue', 'vue-router', 'axios', 'vuex'])
  .sass('resources/assets/sass/app.scss', 'public/css')

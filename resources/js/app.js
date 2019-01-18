// Imports
import Vue from 'vue'
import lodash from 'lodash'
import Axios from 'axios'

// Let's instantiate Axios
window.axios = Axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

// Let's configure axios
const token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
  console.error(
    'CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token'
  )
}

// Bind lodash to window
window.lodash = lodash

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('access', require('./components/Access.vue'))
Vue.component('logo', require('./components/Logo.vue'))
Vue.component('keys-view', require('./components/views/Keys-view.vue'))

// Icons
Vue.component('user-icon', require('./components/icons/User-icon.vue'))
Vue.component('lesson-icon', require('./components/icons/Lesson-icon.vue'))
Vue.component('key-icon', require('./components/icons/Key-icon.vue'))

// Elements
Vue.component(
  'approve-user-tile',
  require('./components/elements/Approve-user-tile.vue')
)
Vue.component(
  'approval-list',
  require('./components/elements/Approval-list.vue')
)

// Views
Vue.component('editor-view', require('./components/views/Editor-view.vue'))
Vue.component('lessons-list', require('./components/views/Lessons-list.vue'))

const app = new Vue({
  el: '#rosa-app',
})

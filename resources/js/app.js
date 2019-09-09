import './bootstrap'

// Vue-Router
import router from './router'
import store from './store'
// Set Vue router
Vue.router = router

import axios from 'axios'
import VueAxios from 'vue-axios'
import 'es6-promise/auto'
import VueAuth from '@websanova/vue-auth'
import auth from './auth'
Vue.use(VueAxios, axios)
Vue.use(VueAuth, auth)

import Vue from 'vue'

new Vue({
  el: '#app',
  router,
  store
})

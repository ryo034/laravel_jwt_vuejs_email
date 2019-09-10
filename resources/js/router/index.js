import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import app from '../App.vue'
Vue.component('app', app)

// Pages
import Register              from '../pages/auth/Register.vue'
import Login                 from '../pages/auth/Login.vue'

import index                     from '../pages/TopPage.vue'
import account                   from '../pages/AccountPage.vue'
import not_found                      from '../pages/NotFound.vue'
import RegisterEmailMsg      from '../pages/auth/RegisterEmailMsg.vue'

export default new Router({
  mode: 'history',
  routes: [
    { path: '/',                         name: 'index',                  component: index},
    // auth
    {path: '/register',                  name: 'register',               component: Register,              meta: { auth: false       }},
    {path: '/login',                     name: 'login',                  component: Login,                 meta: { auth: false       }},
    // user
    { path: '/account',                  name: 'account',                component: account,               meta: { auth: true        }},
    // not found
    { path: '/404',                      name: 'not_found',              component: not_found},
    { path: '/register/email/:status',   name: 'register_email_msg',     component: RegisterEmailMsg,      meta: { auth: false        }},
    // { path: '/404',                      name: 'not_found',              component: not_found,             meta: { auth: false       }},
    { path: '*', redirect: '/404' },
  ],
})

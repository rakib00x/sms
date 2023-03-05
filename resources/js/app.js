/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/chat.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/chat.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import chat from "./components/chat.vue";
import about from "./components/about.vue";

const routes = [
    { path: '/chat', component: chat },
    { path: '/about', component: about }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    router,
    el: '#app',
});

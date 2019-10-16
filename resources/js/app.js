/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';

Vue.use(VueRouter);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import HomeComponent from "./components/HomeComponent";


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('nri-home', HomeComponent);

/*
Define some routes
*/
const routes = [
    {path: '/', name: 'home', component: HomeComponent}
];

// Initiate VueRouter with defined routes
const router = new VueRouter({
    mode: 'history',
    routes
});

/**
 * We will create a fresh Vue
 * application instance and attach it to the page.
 */
const app = new Vue({
    router
}).$mount('#app');

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap';
import Vue from 'vue';

import Routes from './routes';
import App from './App.vue';

/**
 * We will create a fresh Vue
 * application instance and attach it to the page.
 */
const app = new Vue({
    el: '#app',
    router: Routes,
    render: h => h(App),
});

export default app;

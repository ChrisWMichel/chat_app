
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import {routes} from './routes/routes'
import {store} from './store/store'

Vue.use(VueRouter);

const router = new VueRouter({
    routes,
    scrollBehavior(to, from, savedPosition){
        if(savedPosition){
            return savedPosition;
        }
        if(to.hash){
            return {selector: to.hash};
        }
        return {x: 0, y:0};
    }

});


router.beforeEach((to, from, next) => {
    if(to.meta.requireAuth) {
        const userObject = JSON.parse(localStorage.getItem('authUser'));

        if (userObject) {
            next();
        } else {
            //console.log('auth = false');
            next('login');
        }
    }
    next();
});

Vue.component('main-app', require('./components/App'));

const app = new Vue({
    router,
    store,
    el: '#app'
});

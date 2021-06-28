import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home.vue';
import Transactions from './pages/Transactions.vue';
import Login from './pages/Login';
import userModeule from "./store/modules/user";
// import store from "../store";

Vue.use(VueRouter);

const ifNotAuth = (to, from, next) => {
    console.log('Check if user logged in')
    next()
}

const ifAuth = (to, from, next) => {
    console.log(userModeule.getters.isAuthenticated)
    if (userModeule.getters.isAuthenticated === '') {
        next('/login');
    }
    next()
}

const logout = (to, from, next) => {
    localStorage.clear()
    next('/login')
}


const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            beforeEnter: ifAuth
        },
        {
            path: '/transactions',
            name: 'transactions',
            component: Transactions,
            beforeEnter: ifAuth
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            beforeEnter: ifNotAuth
        },
        {
            path: '/logout',
            name: 'logout',
            // component: Login,
            beforeEnter: logout
        },
    ]
});

export default router;

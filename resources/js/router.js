import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home.vue';
import Transactions from './pages/Transactions.vue';
import Login from './pages/Login';
import Admin from './pages/Admin';
import Transaction from './pages/Transaction';
import Register from './pages/Register';
import store from "./store";

Vue.use(VueRouter);

const userLoggedIn = (to, form, next) => {
    console.log('if user logged in')
    if (!store.getters['auth/authenticated']) {
        return next({
            'name': 'login'
        })
    }

    next();
}

const userNotLoggedIn = (to, form, next) => {
    console.log('if user logged in')
    if (store.getters['auth/authenticated']) {
        return next({
            'name': 'home'
        })
    }
    next();
}


const isAdmin = (to, from, next) => {
    // return this.$store.getters["auth/isAdmin"];
}


const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            beforeEnter: userLoggedIn
        },
        {
            path: '/transactions',
            name: 'transactions',
            component: Transactions,
            beforeEnter: userLoggedIn
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            beforeEnter: userNotLoggedIn
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            beforeEnter: userNotLoggedIn
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            beforeEnter: isAdmin,
        },
        {
            path: '/transaction',
            name: 'transaction',
            component: Transaction,
            beforeEnter: userLoggedIn,
        },
        // {
        //     path: '/transaction/:recipientId/:amount',
        //     name: 'repeatTransaction',
        //     component: Transaction,
        //     beforeEnter: userLoggedIn,
        // }
    ]
});

export default router;

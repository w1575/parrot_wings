import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from './pages/Home.vue';
import About from './pages/About.vue';
import Login from './pages/Login';
// import store from "../store";

Vue.use(VueRouter);

// const ifNotAuthenticated = (to, from, next) => {
//     if (!store.getters.isAuthenticated) {
//         next();
//         return;
//     }
//     next("/");
// };
//
// const ifAuthenticated = (to, from, next) => {
//     if (store.getters.isAuthenticated) {
//         next();
//         return;
//     }
//     next("/login");
// };

const ifNotAuth = () => {
    console.log('Check if user logged in')
}

const ifAuth = () => {
    console.log('Check if user not logged in')
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
            path: '/about',
            name: 'about',
            beforeEnter: ifAuth
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            beforeEnter: ifNotAuth
        },
    ]
});

export default router;

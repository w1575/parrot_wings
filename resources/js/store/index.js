import Vue from 'vue';
import Vuex from 'vuex';
import auth from './auth';
import transaction from "./transaction";

Vue.use(Vuex);



export default new Vuex.Store({
    state: {

    },

    mutations: {

    },

    actions: {

    },

    modules: {
        auth,
        transaction
    }

});

import axios from "axios";

export default{
    namespaced: true,

    state: {
        token: null,
        user: null,
    },

    getters: {
        authenticated (state) {
            return state.token && state.user;
        },

        user (state) {
            return state.user;
        },

        token (state) {
            return state.token;
        },

        isAdmin(state) {
          return state.user.role.is_admin ?? false;
        }
    },

    mutations: {
        SET_TOKEN (state, token) {
            state.token = token
        },

        SET_USER (state, data) {
            state.user = data
        },

        SET_BALANCE (state, data) {
            state.user.balance = data;
        }
    },

    actions: {
        async signIn({ dispatch }, credentials) {
            let response = await axios.post('/api/login', credentials)
            return dispatch('attempt', response.data.token)
        },

        async signUp({ dispatch }, credentials) {
            let response = await axios.post('/api/register', credentials)
            return dispatch('attempt', response.data.token)
        },

        async attempt ( { commit, state }, token) {

            if (token) {
                commit('SET_TOKEN', token)
            }

            if (!state.token) {
                return
            }


            try {
                let response = await axios.get('/api/user');

                commit('SET_USER', response.data.data)


            } catch (e) {
                console.log(e)
                commit('SET_TOKEN', null);
                commit('SET_USER', null);
            }
        },

        signOut ({commit}) {
            return axios.delete('/api/logout').then( ()=> {
                commit('SET_TOKEN', null)
                commit('SET_USER', null)
            })
        }
    },

};

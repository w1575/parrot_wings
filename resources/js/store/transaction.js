import axios from "axios";
import auth from './auth'

console.log()

export default {
    namespaced: true,

    state: {
        transactions: null,
    },

    getters: {
        transactions (state) {
            return state.transactions
        }
    },

    mutations: {
        SET_TRANSACTIONS (state, transactions) {
            state.transactions = transactions;
        }
    },

    actions: {
        async getTransactions(_, test) {
            console.log(this.$store.auth.token)
            let response = axios.get(
                    '/api/transactions',
                    {

                        }
                );
        }

    }

}

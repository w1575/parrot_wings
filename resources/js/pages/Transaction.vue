<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="5">
                <div class="card">
                    <div class="card-header">Transaction</div>

                    <div class="card-body">
                        <form  @submit.prevent="submitForm">
                            <div class="">
                                <label class="form-label">Amount</label>
                                <input
                                    id="amount"
                                    v-model="form.amount"
                                    type="text"
                                    name="amount"
                                    class="form-control"
                                >
                            </div>
                            <div >
                                <label class="form-label">Recipient</label>
                                <input
                                    id="recipient"
                                    v-model="form.recipient_id"
                                    type="text"
                                    name="recipient_id"
                                    class="form-control"
                                >
                                <br>
                            </div>
                            <div class="">
                                <button
                                    type="submit"
                                    class="btn btn-success form-control"
                                >
                                    Send
                                </button>

                            </div>
                        </form>
                        <p v-if="errors.length">
                            <b>Errors :</b>
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex';
import axios from "axios";


export default {

    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        }),

    },

    data() {
        return {
            form: {
                recipient_id: null,
                amount: null,
            },
            errors: [],
        }
    },

    methods: {
         submitForm: async function(e) {
            e.preventDefault();

            console.log(this.$store)



            if (this.name && this.age) {
                return true;
            }

            this.errors = [];

            if (!this.form.recipient_id) {
                this.errors.push('You need to choose recipient.');
                return false;
            }
            if (!this.form.amount) {
                this.errors.push('You need to choose amount.');
                return false;
            }

            let token = this.user.token;
            try {
                let response = await axios.post(
                    '/api/transactions',
                    this.form,
                    {
                        'Authorization': 'Bearer ' + token
                    },
                )
                console.log(response)
                let state = this.$store.state;
                state.auth.user.wallet.balance = response.data.current_balance;

                this.$router.replace({
                    name: 'transactions'
                })


            } catch (e) {
                console.log(e)
            }
        }
    },

    mounted() {

        // console.log(request);
    }




}

</script>

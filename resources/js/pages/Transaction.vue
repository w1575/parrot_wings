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

                                <v-select label="name"
                                          v-model="form.recipient_id"
                                          :options="usersOptions"
                                          :reduce="item => item.id"
                                          @search="fetchOptions" >
                                </v-select>

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
            usersOptions: [],
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
        },
        fetchOptions: function(search, loading){

            var el = this;
            let token = this.user.token;
            if (search.length < 3) {
                return true;
            }
            // AJAX request
            axios.get('/api/users', {
                params: {
                    name: search,
                },
                // 'Authorization': 'Bearer ' + token,

            })
            .then(function (response) {
                let data = [];
                let responseData = response.data.data;
                responseData.forEach(function(currentValue, index, array) {
                    data.push({id: currentValue.id, name: currentValue.name})
                })

                el.usersOptions = data;

            });
        },
        selectedOption: function (value){
            // console.log("value : " + value.id);
        }
    },

    mounted() {
        // this.form.recipient.value = this.$route.query.recipientId ?? null;
        // this.form.recipient.text = this.$route.query.recipientId ?? '';
        this.form.amount = this.$route.query.amount ?? null;
    }




}

</script>

<style>
img {
    height: auto;
    max-width: 2.5rem;
    margin-right: 1rem;
}

.d-center {
    display: flex;
    align-items: center;
}

.selected img {
    width: auto;
    max-height: 23px;
    margin-right: 0.5rem;
}

.v-select .dropdown li {
    border-bottom: 1px solid rgba(112, 128, 144, 0.1);
}

.v-select .dropdown li:last-child {
    border-bottom: none;
}

.v-select .dropdown li a {
    padding: 10px 20px;
    width: 100%;
    font-size: 1.25em;
    color: #3c3c3c;
}

.v-select .dropdown-menu .active > a {
    color: #fff;
}
</style>

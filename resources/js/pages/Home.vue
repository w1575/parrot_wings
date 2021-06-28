<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home</div>


                    <div class="card-body">
                        <h2>Welcome to to Parrot Wings!</h2>
                        <p>Here list of your last transactions:</p>
                        <table class="table" v-if="transactions">
                            <tr>
                                <th>
                                    Date
                                </th>
<!--                                <th>-->
<!--                                    Type:-->
<!--                                </th>-->
                                <th>
                                    Sender
                                </th>
                                <th>
                                    Recipient
                                </th>
                                <th>
                                    Amount
                                </th>
                                <th>
                                    Balance
                                </th>
                            </tr>
                            <tr v-for="transaction in transactions">
                                <td>{{ transaction.created_at | moment("D.M.Y")}}</td>
                                <td>{{ transaction.sender_id }}</td>
                                <td>{{ transaction.recipient_id }}</td>
                                <td>{{ transaction.amount }}</td>
                                <td>{{ transaction.result_balance }}</td>
                            </tr>
                        </table>
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
        })
    },

    data() {
        return {
            transactions: false
            // transactions: [
            //     {
            //         "created_at": "2021-06-25T11:41:35.000000Z",
            //         "sender_id": 15,
            //         "recipient_id": 12,
            //         "amount": 256,
            //         "result_balance": 244
            //     },
            //     {
            //         "created_at": "2021-06-25T11:43:06.000000Z",
            //         "sender_id": 15,
            //         "recipient_id": 12,
            //         "amount": 25,
            //         "result_balance": 219
            //     },
            // ]
        };
    },

    async mounted() {
        let  token = this.$store.getters['auth/token'];
        try {
            let response = await axios.get(
                '/api/transactions',
                {
                    'Authorization': 'Bearer ' + token,
                }
            )
            this.transactions = response.data.data;
            // console.log(this.transactions)
        } catch (e) {
            console.log(e)
        }

        // console.log(request);
    }
}
</script>

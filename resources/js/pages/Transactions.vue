<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Transactions</div>

                    <div class="card-body">
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
                                <th></th>
                            </tr>
                            <tr v-for="transaction in transactions">
                                <td>{{ transaction.created_at | moment("D.M.Y")}}</td>
                                <td>{{ transaction.sender.name }}</td>
                                <td>{{ transaction.recipient.name }}</td>
                                <td>
                                    <span v-if="user.id == transaction.sender.id">-</span>
                                    <span v-if="user.id == transaction.recipient.id">+</span>
                                    <span>{{ transaction.amount }}</span>
                                </td>
                                <td>{{ transaction.result_balance }}</td>
                                <th>
                                    <router-link
                                        v-if="user.id == transaction.sender.id"
                                        class="btn btn-success"
                                        data-toggle="collapse"
                                        :to="'/transaction?recipientId=' + transaction.recipient.id + '&amount=' + transaction.amount"


                                    >
                                        Repeat
                                    </router-link>
                                </th>
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
        }
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

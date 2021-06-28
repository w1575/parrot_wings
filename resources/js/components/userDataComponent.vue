<template>
    <div class="navbar-nav ml-sm-auto" v-if="authenticated">
        <div class="nav-item">
            <a href="/transaction" class="btn btn-success">
                New Transaction
            </a>
        </div>

        <div class="nav-item">
                    <span class="nav-link" v-model="user.wallet.balance"> Balance: {{ user.wallet.balance }} </span>
        </div>
        <div class="nav-item">
                    <span class="nav-link" v-model="$store.state.userName"> {{ user.name }} </span>
        </div>
        <div class="nav-item">
            <a href="#" class="nav-link" @click.prevent="signOut">Logout</a>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        })
    },

    methods: {
        ...mapActions({
            signOutAction: 'auth/signOut',
        }),

        signOut () {
            this.signOutAction().then(() => {
                this.$router.replace({
                    'name': 'login'
                })
            })
        }
    },
}
</script>

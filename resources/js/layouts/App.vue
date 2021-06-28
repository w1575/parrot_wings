<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <router-link :to="{ name: 'home' }" class="navbar-brand"
            >Parrot Wings</router-link
            >
            <button
                class="navbar-toggler"
                data-toggle="collapse"
                data-target="#navbarCollapse"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <template v-if="authenticated">
            <div id="navbarCollapse" class="collapse navbar-collapse">

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <router-link
                                class="nav-link"
                                data-toggle="collapse"
                                :to="{ name: 'home' }"
                            >
                                Home
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link
                                class="nav-link"
                                data-toggle="collapse"
                                :to="{ name: 'transactions' }"
                            >
                                Transactions
                            </router-link>
                        </li>
                    </ul>
            </div>
            </template>
            <userDataComponent></userDataComponent>
        </nav>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {

    computed: {
        ...mapGetters({
          authenticated: 'auth/authenticated',
          user: 'auth/user',
        }),
    },



    watch: {
        $route() {
            $("#navbarCollapse").collapse("hide");
        },
    },

};
</script>

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
            <div class="navbar-nav ml-sm-auto">
                <div class="nav-item">
                    <span class="nav-link">
                        Balance: 500
                    </span>
                </div>
                <div class="nav-item">

                </div>
                <div class="nav-item">
                    <span class="nav-link">
                        Ivanov Ivan
                    </span>
                </div>
                <div class="nav-item">
                    <router-link
                        class="nav-link"
                        data-toggle="collapse"
                        :to="{ name: 'logout' }"
                    >
                        Logout
                    </router-link>
                </div>
            </div>
        </nav>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>

export default {
    watch: {
        $route() {
            $("#navbarCollapse").collapse("hide");
        },
    },

};
</script>

<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div>
                        <form class="login" @submit.prevent="login">
                            <h1>Sign in</h1>
                            <label>User name</label>
                            <input required v-model="username" type="text" placeholder="Snoopy"/>
                            <label>Password</label>
                            <input required v-model="password" type="password" placeholder="Password"/>
                            <hr/>
                            <button type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login"
}

// methods: {
//     login: function () {
//         const { username, password } = this
//         this.$store.dispatch(AUTH_REQUEST, { username, password }).then(() => {
//             this.$router.push('/')
//         })
//     }
// }

</script>

<style scoped>

</style>

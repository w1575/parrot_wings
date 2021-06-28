<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form class="login" @submit.prevent="login">
                            <h1>Sign in</h1>
                            <label>Email</label>
                            <input required  type="text" v-model="loginForm.email" placeholder="Snoopy"/>
                            <label>Password</label>
                            <input required  type="password" v-model="loginForm.password" placeholder="Password"/>
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
const loginForm = {
    email: '',
    password: '',
};

console.log(app)

export default {
    data() {
        return {loginForm: loginForm}
    },
    name: "Login",
    methods: {
        login: function () {
            axios.post(
                "/api/login",
                this.loginForm,
                {
                    'Content-Type': 'application/json',
                }
            )
                .then((response) => {
                    let token = response.data.token;
                    localStorage.setItem('token', token)
                    this.$router.push('/')
                    console.info(this.userModule)

                })
                .catch(function (error) {
                    // console.log(error);
                })
        }
    }
}




</script>

<style scoped>

</style>

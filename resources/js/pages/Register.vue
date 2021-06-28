<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form class="login" @submit.prevent="submit">
                            <h1>Sign in</h1>
                            <label>Email</label>
                            <input class="input-group" required  type="text" v-model="form.email" placeholder="For example test@gmail.com"/>
                            <label>Name </label>
                            <input class="input-group" required  type="text" v-model="form.name" placeholder="For example Petrov Petr"/>
                            <label>Password</label>
                            <input class="input-group" required  type="password" v-model="form.password" placeholder="Password"/>
                            <label>Password confirmation</label>
                            <input class="input-group" required  type="password" v-model="form.password_confirmation" placeholder="Password confirmation"/>
                            <hr/>
                            <button class="btn btn-dark" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { mapActions } from 'vuex'

export default {
    name: 'login',
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            }
        }
    },
    methods: {
        ...mapActions({
            signUp: 'auth/signUp'
        }),

        submit() {
            this.signUp(this.form).then(() => {
                this.$router.replace({
                    name: 'home'
                })
            })
        }
    }
}


</script>

<style scoped>

</style>

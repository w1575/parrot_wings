<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form class="login" @submit.prevent="submit">
                            <label>Email</label>
                            <input class="input-group" required  type="text" v-model="form.email" placeholder="Snoopy"/>
                            <label>Password</label>
                            <input class="input-group" required  type="password" v-model="form.password" placeholder="Password"/>
                            <hr/>
                            <button class="btn btn-dark" type="submit">Login</button>
                            <a class="link-dark" href="/register">Sing Up</a>
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
                email: '',
                password: '',
            }
        }
    },
    methods: {
        ...mapActions({
            signIn: 'auth/signIn'
        }),

        submit() {
            this.signIn(this.form).then(() => {
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

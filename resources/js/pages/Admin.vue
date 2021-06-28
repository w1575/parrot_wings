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
                            <input required  type="text" v-model="form.email" placeholder="Snoopy"/>
                            <label>Password</label>
                            <input required  type="password" v-model="form.password" placeholder="Password"/>
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
            this.signIn(this.form)
        }
    }
}


</script>

<style scoped>

</style>

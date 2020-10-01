<template>
    <div>
        <h1>Logging in, please wait...</h1>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: 'login-loading',
    methods: {
        ...mapActions({
            login: 'loginCallback'
        }),

        loginUser() {
            this.login({
                params: this.$route.params,
                query: this.$route.query,
                provider: this.$route.params.provider
            })
        }
    },
    created() {
        // this.loginUser()
    }
}
</script>
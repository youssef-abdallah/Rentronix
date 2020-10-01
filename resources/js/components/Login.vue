<template>
  <div>
    <h1>Login</h1>
    <form @submit.prevent action="GET">
      <button type="submit" @click="loginToSocial('facebook')">Login with Facebook</button>
      <button type="submit" @click="loginToSocial('google')">Login with Google</button>
    </form>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
export default {
  data () {
    return {
      email: '',
      password: ''
    }
  },

  methods: {
    loginToSocial (provider) {
      this.$store
        .dispatch('login', provider)
        .then(() => {
          
        })
        .catch(err => {
          console.log(err)
        })
    }
  },
}
</script>

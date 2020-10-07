<template>
  <div class="container" style="text-align:center;">
    <form @submit.prevent action="GET">
      <div class="row">
        <div class="col-12 mt-4">
          <button type="submit" @click="loginToSocial('facebook')" class="button is-medium is-facebook social-btn">
            <span class="icon">
              <i class="fab fa-facebook"></i>
            </span>
            <span>Login with Facebook</span>
        </button>
        </div>
        <div class="col-12 mt-4">
          <button type="submit" @click="loginToSocial('google')" class="social-btn button is-medium is-youtube">
            <span class="icon">
              <i class="fab fa-google"></i>
            </span>
            <span>Login with Google</span>
        </button>
        </div>
      </div>
      
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

<style lang="css">
  .social-btn {
    width: 30vw;
  }
</style>

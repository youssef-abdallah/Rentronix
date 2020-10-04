import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

axios.defaults.baseURL = 'http://localhost:8000'

export default new Vuex.Store({
  state: {
    isLogged: false
  },

  mutations: {
    setUserData (state, token) {
      state.isLogged = true;
      axios.defaults.headers.common.Authorization = `Bearer ${token}`
      localStorage.setItem('token', token);
    },

    clearUserData (state) {
      state.isLogged = false;
      axios.defaults.headers.common.Authorization = '';
      localStorage.removeItem('token')
      location.reload()
    }
  },

  actions: {
    login ({ commit }, provider) {
      return axios
        .get(`/auth/${provider}`)
        .then((res) => {
          if (res.data.url) {
            window.location.href = res.data.url;
          }
          //commit('setUserData', data)
        })
    },

    loginCallback ({ commit }, token) {
      commit('setUserData', token)
    },

    logout ({ commit }) {
      commit('clearUserData')
    }
  },

  getters : {
    isLogged: state => !!state.isLogged
  }
})

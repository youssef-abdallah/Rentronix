import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

axios.defaults.baseURL = 'http://localhost:8000'

export default new Vuex.Store({
  state: {
    isLogged: false,
    isAdmin: false
  },

  mutations: {
    setUserData (state, token) {
      state.isLogged = true;
      axios.defaults.headers.common.Authorization = `Bearer ${token}`
      localStorage.setItem('token', token);
    },

    clearUserData (state) {
      axios.defaults.headers.common.Authorization = '';
      state.isLogged = false;
      state.isAdmin = false;
      localStorage.removeItem('token')
      location.reload()
    },

    setAdmin(state, isAdmin) {
      state.isAdmin = isAdmin;
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
      axios.get('/api/users/isadmin').then(response => {
        const isAdmin = response.data.isAdmin;
        commit('setAdmin', isAdmin);
      })
    },

    logout ({ commit }) {
      commit('clearUserData')
    }
  },

  getters : {
    isLogged: state => !!state.isLogged,
    isAdmin: state => !!state.isAdmin
  }
})

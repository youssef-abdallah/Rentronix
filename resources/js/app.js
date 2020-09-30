require('./bootstrap');

window.Vue = require('vue');

Vue.component('search-page', require('./components/Search').default);

const app = new Vue({
    el: '#app',
});

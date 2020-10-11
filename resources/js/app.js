require('./bootstrap');
import store from './store.js';

Vue.component('products-list', require('./components/ProductsList.vue'));
Vue.component('cart-dropdown', require('./components/Cart.vue'));


new Vue({
    el: '#app',
    store: new Vuex.Store(store)
});


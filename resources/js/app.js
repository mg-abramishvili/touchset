import Vue from 'vue'

Vue.component('add-to-cart', require('./components/AddToCart.vue').default);
Vue.component('cart', require('./components/Cart.vue').default);
Vue.component('minicart', require('./components/MiniCart.vue').default);

const app = new Vue({
    el: '#app'
});
//require('./bootstrap');

import Vue from 'vue'

Vue.component('add-to-cart', require('./components/products/AddToCart.vue').default);
Vue.component('product-addons', require('./components/products/Addons.vue').default);
Vue.component('cart', require('./components/cart/Cart.vue').default);
Vue.component('checkout', require('./components/cart/Checkout.vue').default);
Vue.component('mini-cart', require('./components/MiniCart.vue').default);
Vue.component('modal', require('./components/Modal.vue').default);

const app = new Vue({
    el: '#app'
});
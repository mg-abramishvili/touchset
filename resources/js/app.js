import Vue from 'vue'

import CKEditor from '@ckeditor/ckeditor5-vue2';
Vue.use( CKEditor );

Vue.component('add-to-cart', require('./components/products/AddToCart.vue').default);
Vue.component('cart', require('./components/cart/Cart.vue').default);
Vue.component('minicart', require('./components/MiniCart.vue').default);

Vue.component('product-edit', require('./components/admin/products/ProductEdit.vue').default);

const app = new Vue({
    el: '#app'
});
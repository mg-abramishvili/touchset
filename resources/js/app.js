import Vue from 'vue'

import CKEditor from '@ckeditor/ckeditor5-vue2';
Vue.use( CKEditor );

Vue.component('add-to-cart', require('./components/products/AddToCart.vue').default);
Vue.component('product-addons', require('./components/products/Addons.vue').default);
Vue.component('cart', require('./components/cart/Cart.vue').default);
Vue.component('checkout', require('./components/cart/Checkout.vue').default);
Vue.component('mini-cart', require('./components/MiniCart.vue').default);

Vue.component('product-edit', require('./components/admin/products/ProductEdit.vue').default);
Vue.component('settings-edit', require('./components/admin/settings/SettingsEdit.vue').default);

const app = new Vue({
    el: '#app'
});
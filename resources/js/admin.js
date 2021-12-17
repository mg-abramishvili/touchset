require('./bootstrap');

import Vue from 'vue'

window.moment = require('moment');
import moment from 'moment'

Vue.prototype.$moment = moment;
moment.locale('ru');

import CKEditor from '@ckeditor/ckeditor5-vue2';
Vue.use( CKEditor );

Vue.component('product-create', require('./components/admin/products/ProductCreate.vue').default);
Vue.component('product-edit', require('./components/admin/products/ProductEdit.vue').default);

Vue.component('category-create', require('./components/admin/categories/CategoryCreate.vue').default);
Vue.component('category-edit', require('./components/admin/categories/CategoryEdit.vue').default);

Vue.component('attribute-create', require('./components/admin/attributes/AttributeCreate.vue').default);
Vue.component('attribute-edit', require('./components/admin/attributes/AttributeEdit.vue').default);

Vue.component('settings-edit', require('./components/admin/settings/SettingsEdit.vue').default);

const app = new Vue({
    el: '#app'
});
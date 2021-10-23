import Vue from 'vue'

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('minicart', require('./components/minicart.vue').default);

const app = new Vue({
    el: '#app'
});
require('./bootstrap');
window.Vue = require('vue');
Vue.component('dashboard-component', require('./components/main/dashboard.vue'));
const app = new Vue({
    el: '#app'
});

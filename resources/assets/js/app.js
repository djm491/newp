require('./bootstrap');
window.Vue = require('vue');
Vue.component('dashboard-component', require('./components/main/dashboard.vue'));

// popover
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);


const app = new Vue({
    el: '#app'
});

require('./bootstrap');
window.Vue = require('vue');
Vue.component('dashboard-component', require('./components/main/dashboard.vue'));
Vue.component('edit-stream', require('./components/main/massEdit.vue'));

// popover
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue);




const app = new Vue({
    el: '#app'
});

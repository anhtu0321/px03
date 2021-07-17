
require('./bootstrap');
window.Vue = require('vue');

Vue.component('app-component', require('./app.vue').default);

// Import router
import router from './router'

// import store
import store from './store'

const app = new Vue({
    el: '#appbackend',
    router,
    store
});

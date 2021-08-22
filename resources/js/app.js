require('./bootstrap');
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
window.Vue = require('vue');

Vue.component('app-component', require('./app.vue').default);


import router from './router.js';
import store from './store.js';
const app = new Vue({
    el: '#app',
    router,
    store,
});

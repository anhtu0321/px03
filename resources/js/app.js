require('./bootstrap');
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
window.Vue = require('vue');

Vue.component('app-component', require('./app.vue').default);

// Require Froala Editor js file.
require('froala-editor/js/froala_editor.pkgd.min.js')

// Require Froala Editor css files.
require('froala-editor/css/froala_editor.pkgd.min.css')
require('froala-editor/css/froala_style.min.css')

// Import and use Vue Froala lib.
import VueFroala from 'vue-froala-wysiwyg'
Vue.use(VueFroala)

import router from './router.js';
import store from './store.js';
const app = new Vue({
    el: '#app',
    router,
    store,
});
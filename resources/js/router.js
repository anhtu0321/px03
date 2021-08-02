import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// components
import home from './components/home.vue';

const routes = [
    { path: '/', component: home },
];

const router = new VueRouter({
    routes: routes,
});

export default router;
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// components
import home from './components/includes/contents/home.vue'
import vanbanden from './components/includes/contents/vanbanden.vue'
import vanbandi from './components/includes/contents/vanbandi.vue'
import vanbanxuly from './components/includes/contents/vanbanxuly.vue'

const routes = [
    { path: '/home', component: home },
    { path: '/vanbanden', component: vanbanden },
    { path: '/vanbandi', component: vanbandi },
    { path: '/vanbanxuly', component: vanbanxuly },
];

const router = new VueRouter({
    routes: routes,
});

export default router;
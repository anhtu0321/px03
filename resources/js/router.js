import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// components
import home from './components/includes/contents/home.vue'
import vanbanden from './components/includes/contents/vanbanden.vue'
import vanbandi from './components/includes/contents/vanbandi.vue'
import vanbanxuly from './components/includes/contents/vanbanxuly.vue'
import chuaxuly from './components/includes/contents/chuaxuly.vue'

const routes = [
    { path: '/', component: home },
    { path: '/vanbanden', component: vanbanden },
    { path: '/vanbandi', component: vanbandi },
    { path: '/vanbanxuly', component: vanbanxuly },
    { path: '/chuaxuly', component: chuaxuly },
];

const router = new VueRouter({
    routes: routes,
});

export default router;
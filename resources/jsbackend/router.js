import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// import cac component o duoi:
// -Loai Van ban
import themLoaiVanBan from './components/loaivanban/add.vue';
import suaLoaiVanBan from './components/loaivanban/edit.vue';
// -Nguon den
import themNguonDen from './components/nguonden/add.vue';
import suaNguonDen from './components/nguonden/edit.vue';
// -Nguon di
import themNguonDi from './components/nguondi/add.vue';
import suaNguonDi from './components/nguondi/edit.vue';

const routes = [
    // router loai van ban
    { path: '/loaivanban', component: themLoaiVanBan },
    { path: '/loaivanban/edit/:id', component: suaLoaiVanBan },
    // router nguon den
    { path: '/nguonden', component: themNguonDen },
    { path: '/nguonden/edit/:id', component: suaNguonDen },
    // router nguon di
    { path: '/nguondi', component: themNguonDi },
    { path: '/nguondi/edit/:id', component: suaNguonDi },
]

const router = new VueRouter({
    routes: routes
});

export default router;
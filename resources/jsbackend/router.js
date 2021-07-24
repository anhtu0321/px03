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
// -Lanh dao
import themLanhDao from './components/lanhdao/add.vue';
import suaLanhDao from './components/lanhdao/edit.vue';
// -Lanh dao
import themDonVi from './components/donvi/add.vue';
import suaDonVi from './components/donvi/edit.vue';
// -Chức năng
import themchucnang from './components/chucnang/add.vue';
import suachucnang from './components/chucnang/edit.vue';
// -Phân quyền
import themphanquyen from './components/phanquyen/add.vue';
import suaphanquyen from './components/phanquyen/edit.vue';

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
    // router lanh dao
    { path: '/lanhdao', component: themLanhDao },
    { path: '/lanhdao/edit/:id', component: suaLanhDao },
    // router don vi
    { path: '/donvi', component: themDonVi },
    { path: '/donvi/edit/:id', component: suaDonVi },
    // router chuc nang
    { path: '/chucnang', component: themchucnang },
    { path: '/chucnang/edit/:id', component: suachucnang },
    // router phân quyền
    { path: '/phanquyen', component: themphanquyen },
    { path: '/phanquyen/edit/:id', component: suaphanquyen },

]

const router = new VueRouter({
    routes: routes
});

export default router;
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// import cac component o duoi:
import themLoaiVanBan from './components/loaivanban/add.vue';
import suaLoaiVanBan from './components/loaivanban/edit.vue';


const routes = [
    {path:'/loaivanban', component:themLoaiVanBan},
    {path:'/loaivanban/edit/:id', component:suaLoaiVanBan},
]

const router = new VueRouter({
    routes:routes
});

export default router;
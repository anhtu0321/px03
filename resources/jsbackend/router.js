import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// import cac component o duoi:
import themLoaiVanBan from './components/loaivanban/add.vue';


const routes = [
    {path:'/loaivanban', component:themLoaiVanBan},
]

const router = new VueRouter({
    routes:routes
});

export default router;
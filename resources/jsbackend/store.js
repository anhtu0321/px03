import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);
const storeInfo = {
    state: {
        page: 1,
        listLoai: '',
        listNguonDen: '',
        listNguonDi: '',
        listLanhDao: '',
        listDonVi: '',
        listChucNang: '',
        listPhanQuyen: '',
        listTaiKhoan: '',
        listPermissionOfUser: '',
    },
    getters: {
        getPage(state) {
            return state.page;
        },
        getListLoai(state) {
            return state.listLoai;
        },
        getListNguonDen(state) {
            return state.listNguonDen;
        },
        getListNguonDi(state) {
            return state.listNguonDi;
        },
        getListLanhDao(state) {
            return state.listLanhDao;
        },
        getListDonVi(state) {
            return state.listDonVi;
        },
        getListChucNang(state) {
            return state.listChucNang;
        },
        getListPhanQuyen(state) {
            return state.listPhanQuyen;
        },
        getListTaiKhoan(state) {
            return state.listTaiKhoan;
        },
        getlistPermissionOfUser(state) {
            return state.listPermissionOfUser;
        }
    },
    actions: {
        acGetPage(context, page) {
            context.commit('muGetPage', page);
        },
        acListLoai(context, page) {
            axios.get('/px03/public/listLoaiVanBan?page=' + page)
                .then(response => {
                    context.commit('muListLoai', response.data);
                })
        },
        acListNguonDen(context, page) {
            axios.get('/px03/public/listNguonDen?page=' + page)
                .then(response => {
                    context.commit('muListNguonDen', response.data);
                })
        },
        acListNguonDi(context, page) {
            axios.get('/px03/public/listNguonDi?page=' + page)
                .then(response => {
                    context.commit('muListNguonDi', response.data);
                })
        },
        acListLanhDao(context, page) {
            axios.get('/px03/public/listLanhDao?page=' + page)
                .then(response => {
                    context.commit('muListLanhDao', response.data);
                })
        },
        acListDonVi(context, page) {
            axios.get('/px03/public/listDonVi?page=' + page)
                .then(response => {
                    context.commit('muListDonVi', response.data);
                })
        },
        acListChucNang(context, page) {
            axios.get('/px03/public/listChucNang?page=' + page)
                .then(response => {
                    context.commit('muListChucNang', response.data);
                })
        },
        acListPhanQuyen(context, page) {
            axios.get('/px03/public/listPhanQuyen?page=' + page)
                .then(response => {
                    context.commit('muListPhanQuyen', response.data);
                })
        },
        acListTaiKhoan(context, page) {
            axios.get('/px03/public/listTaiKhoan?page=' + page)
                .then(response => {
                    context.commit('muListTaiKhoan', response.data);
                })
        },
        aclistPermissionOfUser(context) {
            axios.get('/px03/public/listPermissionOfUser')
                .then(response => {
                    context.commit('mulistPermissionOfUser', response.data);
                })
        },
    },
    mutations: {
        muGetPage(state, page) {
            state.page = page;
        },
        muListLoai(state, response) {
            state.listLoai = response;
        },
        muListNguonDen(state, response) {
            state.listNguonDen = response;
        },
        muListNguonDi(state, response) {
            state.listNguonDi = response;
        },
        muListLanhDao(state, response) {
            state.listLanhDao = response;
        },
        muListDonVi(state, response) {
            state.listDonVi = response;
        },
        muListChucNang(state, response) {
            state.listChucNang = response;
        },
        muListPhanQuyen(state, response) {
            state.listPhanQuyen = response;
        },
        muListTaiKhoan(state, response) {
            state.listTaiKhoan = response;
        },
        mulistPermissionOfUser(state, response) {
            state.listPermissionOfUser = response;
        },
    },
}

const store = new Vuex.Store(
    storeInfo
)

export default store;
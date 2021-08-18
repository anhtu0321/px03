import Vue from 'vue';
import VueX from 'vuex';
import axios from 'axios';
Vue.use(VueX);

const storeInfo = {
    state: {
        userDetails: '',
        link: 'vanbanden',
        listUser: '',
        listNguonDen: '',
        listLoai: '',
        listVanBanDen: '',
        listPermissionOfUser: '',
        dataRequestSearch: '',
        lengthBarAlert: '',

        listNguonDi: '',
        listLanhDao: '',
    },
    getters: {
        getUserDetails(state) {
            return state.userDetails;
        },
        getLink(state) {
            return state.link;
        },
        getListUser(state) {
            return state.listUser;
        },
        getListNguonDen(state) {
            return state.listNguonDen;
        },
        getListLoai(state) {
            return state.listLoai;
        },
        getListVanBanDen(state) {
            return state.listVanBanDen;
        },
        getListPermissionOfUser(state) {
            return state.listPermissionOfUser;
        },
        getDataRequestSearch(state) {
            return state.dataRequestSearch;
        },
        getListNguonDi(state) {
            return state.listNguonDi;
        },
        // getListLanhDao(state) {
        //     return state.listLanhDao;
        // },
    },
    actions: {
        acUserDetails(contex) {
            axios.get('/px03/public/getUser')
                .then(responsive => {
                    contex.commit('muUserDetails', responsive);
                })
        },
        acLink(contex, link) {
            contex.commit('muLink', link);
        },
        acListUser(contex) {
            axios.get('/px03/public/listTaiKhoan')
                .then(response => {
                    contex.commit('muListUser', response);
                })
        },
        acListNguonDen(contex) {
            axios.get('/px03/public/listNguonDen')
                .then(response => {
                    contex.commit('muListNguonDen', response);
                })
        },
        acListLoai(contex) {
            axios.get('/px03/public/listLoai')
                .then(response => {
                    contex.commit('muListLoai', response);
                })
        },
        acListPermissionOfUser(contex) {
            axios.get('/px03/public/listPermissionOfUser')
                .then(response => {
                    contex.commit('muListPermissionOfUser', response);
                })
        },
        acSearch(contex, data) {
            axios.post('/px03/public/search?page=' + data.page, data.data)
                .then(response => {
                    contex.commit('muSearch', response);
                })
        },
        acRequestSearch(contex, data) {
            contex.commit('muRequestSearch', data);
        },
        acLengthBarAlert(contex, data) {
            contex.commit('muLengthBarAlert', data);
        },
        acListNguonDi(contex) {
            axios.get('/px03/public/listNguonDi')
                .then(response => {
                    contex.commit('muListNguonDi', response);
                })
        },
        acListLanhDao(contex) {
            axios.get('/px03/public/listLanhDao')
                .then(response => {
                    contex.commit('muListLanhDao', response);
                })
        },
    },
    mutations: {
        muUserDetails(state, responsive) {
            state.userDetails = responsive.data;
        },
        muLink(state, data) {
            state.link = data;
        },
        muListUser(state, data) {
            state.listUser = data.data;
        },
        muListNguonDen(state, data) {
            state.listNguonDen = data.data;
        },
        muListLoai(state, data) {
            state.listLoai = data.data;
        },
        muListPermissionOfUser(state, data) {
            state.listPermissionOfUser = data.data;
        },
        muSearch(state, data) {
            state.listVanBanDen = data.data;
        },
        muRequestSearch(state, data) {
            state.dataRequestSearch = data;
        },
        muLengthBarAlert(state, data) {
            state.lengthBarAlert = data;
        },
        muListNguonDi(state, data) {
            state.listNguonDi = data.data;
        },
        muListLanhDao(state, data) {
            state.listLanhDao = data.data;
        }
    },
}

const store = new VueX.Store(
    storeInfo
)

export default store;
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
        listDonVi: '',
        listVanBanDi: '',
        dataRequestSearchDi: '',
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
            axios.get('/px03/public/api/listNguonDen')
                .then(response => {
                    contex.commit('muListNguonDen', response);
                })
        },
        acListLoai(contex) {
            axios.get('/px03/public/api/listLoai')
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
            axios.get('/px03/public/api/listNguonDi')
                .then(response => {
                    contex.commit('muListNguonDi', response);
                })
        },
        acListLanhDao(contex) {
            axios.get('/px03/public/api/listLanhDao')
                .then(response => {
                    contex.commit('muListLanhDao', response);
                })
        },
        acListDonVi(contex) {
            axios.get('/px03/public/api/listDonViNoPaginate')
                .then(response => {
                    contex.commit('muListDonVi', response);
                })
        },
        acChangeListDonVi(contex, data) {
            contex.commit('muListDonVi', data);
        },
        acSearchDi(contex, data) {
            axios.post('/px03/public/searchdi?page=' + data.page, data.data)
                .then(response => {
                    contex.commit('muSearchDi', response);
                })
        },
        acRequestSearchDi(contex, data) {
            contex.commit('muRequestSearchDi', data);
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
        },
        muListDonVi(state, data) {
            state.listDonVi = data.data;
        },
        muSearchDi(state, data) {
            state.listVanBanDi = data.data;
        },
        muRequestSearchDi(state, data) {
            state.dataRequestSearchDi = data;
        }

    },
}

const store = new VueX.Store(
    storeInfo
)

export default store;
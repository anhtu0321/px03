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
        acListVanBanDen(contex, page) {
            axios.get('/px03/public/listvanbanden?page=' + page)
                .then(response => {
                    contex.commit('muListVanBanDen', response);
                })
        },
        acListPermissionOfUser(contex) {
            axios.get('/px03/public/listPermissionOfUser')
                .then(response => {
                    contex.commit('muListPermissionOfUser', response);
                })
        },
        acSearch(contex, data) {
            axios.post('/px03/public/search', data)
                .then(response => {
                    contex.commit('muSearch', response);
                })
        }
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
        muListVanBanDen(state, data) {
            state.listVanBanDen = data.data;
        },
        muListPermissionOfUser(state, data) {
            state.listPermissionOfUser = data.data;
        },
        muSearch(state, data) {
            state.listVanBanDen = data.data;
        }
    },
}

const store = new VueX.Store(
    storeInfo
)

export default store;
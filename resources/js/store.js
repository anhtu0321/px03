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
        }
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
        }
    },
}

const store = new VueX.Store(
    storeInfo
)

export default store;
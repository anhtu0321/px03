import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);
const storeInfo = {
    state: {
        page: 1,
        listLoai: '',
        listNguonDen: '',
        listNguonDi: '',
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
        }
    },
    actions: {
        acGetPage(context, page) {
            context.commit('muGetPage', page);
        },
        acListLoai(context, page) {
            axios.get('/px03/public/api/listLoaiVanBan?page=' + page)
                .then(response => {
                    context.commit('muListLoai', response.data);
                })
        },
        acListNguonDen(context, page) {
            axios.get('/px03/public/api/listNguonDen?page=' + page)
                .then(response => {
                    context.commit('muListNguonDen', response.data);
                })
        },
        acListNguonDi(context, page) {
            axios.get('/px03/public/api/listNguonDi?page=' + page)
                .then(response => {
                    context.commit('muListNguonDi', response.data);
                })
        }
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
        }
    },
}

const store = new Vuex.Store(
    storeInfo
)

export default store;
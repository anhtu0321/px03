import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);
const storeInfo = {
    state: {
        listLoai: '',
    },
    getters: {
        getListLoai(state) {
            return state.listLoai;
        }
    },
    actions: {
        acListLoai(context, page) {
            axios.get('/px03/public/api/listLoaiVanBan?page=' + page)
                .then(response => {
                    context.commit('muListLoai', response.data);
                })
        }
    },
    mutations: {
        muListLoai(state, response) {
            state.listLoai = response;
        }
    },
}

const store = new Vuex.Store(
    storeInfo
)

export default store;
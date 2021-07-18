import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);
const storeInfo = {
    state:{
        listLoaiVanBan:'',
    },
    getters:{
        getListLoaiVanBan(state){
            return state.listLoaiVanBan;
        }
    },
    actions:{
        getListLoaiVanBanAc(context, id){
            axios.get(`/px03/public/api/editLoaiVanBan/${id}`)
            .then(response=>{
                context.commit('getListLoaiVanBan',response);
            })
        }
    },
    mutations:{
        getListLoaiVanBan(state, data){
            state.listLoaiVanBan = data;
        }
    },
}
    
const store = new Vuex.Store(
    storeInfo
)

export default store;
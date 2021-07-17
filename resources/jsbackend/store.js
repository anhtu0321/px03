import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);
const storeInfo = {
    state:{},
    getters:{},
    mutations:{},
    actions:{}
}
    
const store = new Vuex.Store(
    storeInfo
)

export default store;
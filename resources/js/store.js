import Vue from 'vue';
import VueX from 'vuex';
Vue.use(VueX);

const storeInfo = {
    state: {
        userDetails: '',
    },
    getters: {
        getUserDetails(state) {
            return state.userDetails;
        }
    },
    actions: {
        acUserDetails(contex) {
            axios.get('/px03/public/getUser')
                .then(responsive => {
                    contex.commit('muUserDetails', responsive);
                })
        }
    },
    mutations: {
        muUserDetails(state, responsive) {
            state.userDetails = responsive.data;
        }
    },
}

const store = new VueX.Store(
    storeInfo
)

export default store;
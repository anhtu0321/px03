import Vue from 'vue';
import VueX from 'vuex';
Vue.use(VueX);

const storeInfo = {
    state: {
        userDetails: '',
        link: '',
    },
    getters: {
        getUserDetails(state) {
            return state.userDetails;
        },
        getLink(state) {
            return state.link;
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
        }
    },
    mutations: {
        muUserDetails(state, responsive) {
            state.userDetails = responsive.data;
        },
        muLink(state, data) {
            state.link = data;
        }
    },
}

const store = new VueX.Store(
    storeInfo
)

export default store;
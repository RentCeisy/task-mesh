import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        selectCat: 0,
    },
    mutations: {
        setValueCategory(state, catId) {
            this.state.selectCat = catId;
        }
    },
    actions: {
        setCategory({commit, state}, payload) {
            commit('setValueCategory', payload);
        },
    },
    getters: {
        getCategory(state) {
            return state.selectCat;
        }
    }
});

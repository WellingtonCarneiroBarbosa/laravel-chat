import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import cretePersistedState from 'vuex-persistedstate';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: {},
    },
    mutations: {
        setUserState: (state, value) => state.user = value,
    },
    actions: {
        userStateAction: ({commit}) => {
            axios.get("/api/users/me").then((response) => {
                //pass the value to the mutation set the user state
                //like a escada (eu nao sei como fala escada em inglês talkey)
                commit('setUserState', response.data.user);
            });
        },
    },
    plugins: [cretePersistedState()]
});

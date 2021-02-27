import Vue from 'vue';
import Vuex from 'vuex';


Vue.use(Vuex);

export default new Vuex.Store({

    modules : {
    },

    // You can use it as state property
    state: {
        authUser : localStorage.getItem('user')? localStorage.getItem('user') : null,
        token : localStorage.getItem('token')? localStorage.getItem('token') : null,
    },

    // You can use it as a state getter function (probably the best solution)
    getters: {
        getAuthUser(state){
            return JSON.parse(state.authUser);
        },
        getToken(state){
            return state.token;
        },
    },

    // Mutation for when you use it as state property
    mutations: {
        setAuthUser(state, data){
            localStorage.setItem('user', JSON.stringify(data));
            state.authUser = localStorage.getItem('user');
        },
        setToken(state, data){
            localStorage.setItem('token', data);
            state.token = localStorage.getItem('token');
        },

        unAuthorizeUser(state) {
            
            localStorage.setItem('user', false);
            state.authUser = false;

        },

        revokeToken(state) {
            localStorage.setItem('token', false);
        }

    },
});
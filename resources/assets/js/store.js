import Vue from 'vue';
import Vuex from 'vuex';
import { resolve } from 'url';
import CaseProfile from './components/model/CaseProfile.class';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        // data required for user auth
        status: '',
        token: localStorage.getItem('token') || '',
    },
    mutations: {

    },
    actions: {
    },
    getters: {

    }
});

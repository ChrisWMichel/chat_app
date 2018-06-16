import Vue from 'vue'
import Vuex from 'vuex'
import userStore from './modules/userStore'
import chatStore from './modules/chatStore'

Vue.use(Vuex);

//const debug = process.env.NODE_ENV !== 'production';

export const store = new Vuex.Store({

    modules:{
        user: userStore,
        chat: chatStore,
    },
    //strict: debug,

});
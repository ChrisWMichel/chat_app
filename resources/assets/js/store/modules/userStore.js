export default {
    namespaced: true,
    state:{
        authUser: null,
        loggedIn: false,
        authUserId: null


    },
    mutations:{
        setAuthUser(state, userObj){
            state.authUser = userObj;
            state.loggedIn = true;
        },
        logoutUser(state){
            state.authUser = null;
            state.loggedIn = false;
        }
    },
    actions:{
        setUserObject:({commit}, userObj) => {
            commit('setAuthUser', userObj);
        },
        logoutUser:({commit}) => {
            commit('logoutUser');
        }
    }
}

/*
const state = {

};

const mutations = {

};

const actions = {

};

export default {
    state, mutations, actions
}*/

import axios from 'axios'

export default {
    namespaced: true,
    state:{
        user_list:{},
        currentChatUser: null,
        conversation: null
    },
    getters:{

    },
    mutations:{
        set_user_list:(state, userList) =>{
            state.user_list = userList;
        },
        setCurrentChatUser:(state, user) =>{
            state.currentChatUser = user;
        },
        setConversation:(state, conversation) => {
            state.conversation = conversation;
        },
        addChatToConversation:(state, message) => {
            state.conversation.push(message);
        }
    },
    actions:{
        setUserList:({commit}) => {
            return axios.get('api/user_list')
                .then(resp => {
                    //console.log(resp);
                    commit('set_user_list', resp.data);
                    return resp.data;
                })
        },
        setCurrentChatUser:({commit}, data) => {
            //console.log('auth_id', data);
            return axios.post('api/get_user_conversatoin', {user_id: data.user.id, auth_id: data.auth_id})
                .then(resp => {
                    commit('setCurrentChatUser', data.user);
                    commit('setConversation', resp.data);
                });

        },
        addNewChat:({commit}, postData) =>{
            //console.log('postData', postData);
           /*return*/ axios.post('api/add_new_chat', postData)
                .then(resp => {

                    commit('addChatToConversation', resp.data);
                })
        },
        newIncomingChat:({commit}, message) =>{
            commit('addChatToConversation', message);
        }
    }
}
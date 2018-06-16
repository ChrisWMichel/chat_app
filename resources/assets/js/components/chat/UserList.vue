<template>
    <div class="wrapper" id="chat-user-list-wrapper">

        <li class="list-group-item"
            :class="[{active: userActiveStyle(user)}]"
            @click="changeChatUser(user)"
            v-if="user.email !== authUser.email"
        >{{user.name}}</li>


    </div>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        name: "UserList",
        props:['user'],
        data(){
            return{
                authUser: this.$store.state.user.authUser,

            }
        },
        computed:{

        },
        methods:{
            changeChatUser(user){

                let postData = {
                    user,
                    auth_id: this.authUser.auth_id
                };

                //console.log('authID', postData.auth_id);
                this.$store.dispatch('chat/setCurrentChatUser', postData);
            },
            userActiveStyle(user){
                if(this.$store.state.chat.currentChatUser === null){
                    return false;
                }

                if(this.$store.state.chat.currentChatUser.id === user.id){
                    return true;
                }

                return false;
            }
        },

    }
</script>

<style scoped>

    .list-group-item:hover{
        cursor: pointer;
        background: #9fcdff;
        color: black;
    }
    .active{
        background-color: #005cbf;
        color: white;
    }
</style>
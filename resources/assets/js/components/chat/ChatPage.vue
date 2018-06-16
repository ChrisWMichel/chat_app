<template>
    <div class="wrapper" id="chat-wrapper">
        <!--<section class="heading">
            <h2 class="page-header">Chat</h2>
        </section>-->

        <section class="content">
            <div class="row">

                <div class="col-md-2" id="user-list-col">
                    <h3>User List</h3>
                    <app-user-list v-for="user in users" :key="user.id" :user="user" class="list-unstyled"></app-user-list>

                </div>
                <div class="col-md-10">
                    <div class="chat-block">
                        <app-chat-widget></app-chat-widget>
                    </div>
                    <div class="add-chat-block">
                        <app-chat-add></app-chat-add>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import UserList from './UserList'
    import ChatWidget from './ChatWidget'
    import ChatAddWidget from './ChatAddWidget'
    import {mapState} from 'vuex'

    export default {
        name: "ChatPage",
        components:{
            appUserList: UserList,
            appChatWidget: ChatWidget,
            appChatAdd: ChatAddWidget,
        },
        data(){
            return{

            }
        },
        created(){
            this.$store.dispatch('chat/setUserList')
        },
        computed:{
            ...mapState('chat', {
                users: 'user_list'
            }),

        }
    }
</script>

<style scoped>

</style>
<template>
    <div>
        <!--<app-chat-page></app-chat-page>-->

    </div>
</template>

<script>
    import chatPage from './chat/ChatPage'
    import {mapState} from 'vuex'

    export default {
        name: "Main",
        components:{
            appChatPage: chatPage
        },
        data(){
            return{

            }
        },
        methods:{

        },
        computed:{
            ...mapState('user',{
                loggedIn: 'loggedIn'
            })

        },



    }
</script>

<style scoped>

</style>
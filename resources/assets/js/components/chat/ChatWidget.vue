<template>
    <div id="chat-widget-wrapper">

        <div class="conversation" v-for="chat in chats" :key="chat.id">
            <div class="sender-data clearfix">
                <div class="name">{{chat.sender.name}}: </div>
                <div class="time">{{chat.created_at}}</div>
            </div>

            <div class="chat-body">
                {{chat.chat}}
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "ChatWidget",
        data(){
            return{

            }
        },
        computed:{
            chats(){
                return this.$store.state.chat.conversation
            }
        }
    }
</script>

<style scoped>
    .conversation{
        padding-bottom: 10px;
        border-bottom: 1px solid #CCCCCC;
    }
    .name{
        /*font-size: large;*/
        font-weight: bolder;
        float: left;
        margin-right: 10px;
    }
    .time{
        font-size: small;
    }
    .sender-data{
        display: block;

    }
</style>
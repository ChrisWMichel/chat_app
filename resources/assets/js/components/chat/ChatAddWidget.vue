<template>
    <div id="chat-add-widget">

            <form @submit.prevent = "addMessage">
                <div class="form-group">
                    <input type="text" class="form-control msg-field" v-model="message"/>
                </div>
                <!--<button type="submit" class="addBtn btn btn-primary" :disabled="!validate">Add</button>-->
            </form>



    </div>
</template>

<script>
    import Pusher from 'pusher-js'

    export default {
        name: "ChatAddWidget",
        data(){
            return{
                message: null,
                pusher: null,
                channel: null
            }
        },
        created(){
            //add key that was also added in the .env file
            this.pusher = new Pusher('a21959869b1e58f55c11', {
                encrypted: true,
                cluster: 'us2'
            });
            let that = this;
            this.channel = this.pusher.subscribe('chat_channel');
            this.channel.bind('chat_saved', data => {
                that.$emit('incoming_chat', data);
            });
            this.$on('incoming_chat', chatMessage => {
                this.incomingChat(chatMessage);
            })
        },
        computed:{
            /*chats(){
                return this.$store.state.chat.conversation
            },*/
            validate(){
                return this.message;
            },
        },
        methods:{
            addMessage(){
                if(this.message){
                    let postData = {
                        'receiver_id': this.$store.state.chat.currentChatUser.id,
                        'sender_id': this.$store.state.user.authUser.auth_id,
                        'chat': this.message
                    };

                    this.$store.dispatch('chat/addNewChat', postData)
                        .then(resp => {
                            this.message = null;
                        })
                }
            },
            incomingChat(chatMessage){

                if(this.$store.state.chat.currentChatUser.id === chatMessage.message.sender_id){
                    this.$store.dispatch('chat/newIncomingChat', chatMessage.message)
                        .then(res => {
                            //let element = document.getElementById('chat-widget-wrapper');
                            //element.scrollIntoView(false)
                        })

                }

            }
        }
    }
</script>

<style scoped>
    .msg-field{
        margin-top:10px;
    }
    .msg-field{

    }
</style>
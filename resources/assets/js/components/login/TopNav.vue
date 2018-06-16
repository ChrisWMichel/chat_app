<template>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <router-link  class="navbar-brand" to="home"><a>Chat App</a></router-link>
            <!--<a class="navbar-brand" href="#">
                Chat App
            </a>-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav mr-auto"><!--navbar-nav mr-auto-->
                    <router-link v-if="authUser" class="nav-link" tag="li" to="chat"><a>Chat</a></router-link>
                </ul>
                <ul class="navbar-nav ml-auto float-lg-right">
                    <router-link v-if="!authUser" class="nav-link" tag="li" to="login"><a>Login</a></router-link>
                    <router-link v-if="!authUser" class="nav-link" tag="li" to="register"><a>Resgister</a></router-link>
                    <li class="nav-item dropdown" v-if="authUser">
                        <!--<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{firstname}}
                        </a>-->
                        <a v-if="authUser" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                            {{authUser.username}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#" @click="logout">
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import axios from 'axios'
    import {mapState} from 'vuex'

    export default {
        name: "TopNav",
        data(){
            return{

            }
        },
        computed:{
            ...mapState('user',{
                authUser: 'authUser',

            }),
        },
        methods:{
            logout(){
                axios.get('/api/logout').then(resp => {
                    this.$store.dispatch('user/logoutUser');
                    localStorage.removeItem('authUser');
                    toastr.success('You are now logged out.');
                    this.$router.push('/home');
                })

            }
        }
    }
</script>

<style scoped>

</style>
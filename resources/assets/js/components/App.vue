<template>
    <div>
        <app-top-nav></app-top-nav>

        <router-view></router-view>
    </div>
</template>

<script>
    import TopNav from './login/TopNav'
    import {mapState} from 'vuex'

    export default {
        name: "App",
        components:{
            appTopNav: TopNav
        },
        computed:{
            ...mapState('user',{
                authUser: 'authUser'
            })

        },
        created(){
            const userObj = JSON.parse(localStorage.getItem('authUser'));
            if(userObj !== null){
                this.$store.dispatch('user/setUserObject', userObj);
                this.$router.push('/main');
            }else{
                this.$router.push('/login')
            }

        }

    }
</script>

<style scoped>

</style>
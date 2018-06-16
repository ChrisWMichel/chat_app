<template>
    <div class="wrapper" id="home-wrapper">
        <section class="login">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Login</strong></div>
                        <div class="panel-body">
                            <form  @submit.prevent="loginSubmit()">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="text" class="form-control" v-model="login.email"/>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" v-model="login.password"/>
                                </div>
                                <button class="btn btn-primary"  :disabled="!isValidLoginForm">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "Login",
        data(){
            return{
                login:{
                    email: 'michel@email.com',
                    password: '123456',
                    remember: true
                },

            }
        },
        computed:{
            isValidLoginForm(){
                return this.emailIsValid() && this.login.password;
            },

        },
        methods:{
            loginSubmit(){

                axios.post('/login', this.login)
                    .then(resp => {
                        //console.log(resp);
                        if(resp.data.name){
                            const authUser = {
                                username: resp.data.name,
                                email: resp.data.email,
                                access_token: this.randomString(32 ),
                                auth_id: resp.data.id
                            };
                            localStorage.setItem('authUser', JSON.stringify(authUser));
                            const userObj = JSON.parse(localStorage.getItem('authUser'));
                            this.$store.dispatch('user/setUserObject', userObj);

                            this.$router.push('/main');
                            toastr.success('You are now logged in.');
                        }else {
                            console.log('wrong password');
                            toastr.warning('There is something wrong with your email/password. Try again.');

                        }
                    })
            },
            randomString(length){
                let result = '';
                const chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                for (let i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
                return result;
            },
            emailIsValid()
            {
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.login.email) ||
                    /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.login.email_forg))
                {
                    return (true)
                }else{
                    return (false)
                }
            },
        }
    }
</script>

<style scoped>

</style>
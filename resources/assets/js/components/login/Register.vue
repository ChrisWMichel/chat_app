<template>
    <div class="wrapper" id="home-wrapper">
        <section class="register">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>register</strong></div>
                        <div class="panel-body">
                            <form  @submit.prevent="registerSubmit()">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="register.name"/>
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="text" class="form-control" v-model="register.email"/>
                                </div>
                                <div v-if="message" class="message">
                                    <span>{{message}}</span>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" v-model="register.password"/>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" v-model="register.confirm_password"/>
                                </div>
                                <button class="btn btn-primary"  :disabled="!isValidLoginForm">register</button>
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
        name: "Register",
        data(){
            return{
                register:{
                    name:'Last Bules',
                    email:'dfdfdf@email.com',
                    password: '123456',
                    confirm_password: '123456'
                },
                message:''
            }
        },
        computed:{
            isValidLoginForm(){
                return this.emailIsValid() && this.register.password && this.register.name;
            },

        },
        methods:{
            emailIsValid()
            {
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.register.email) ||
                    /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.register.email_forg))
                {
                    return (true)
                }else{
                    return (false)
                }
            },
            registerSubmit(){
                if(this.register.password === this.register.confirm_password){
                    this.message = '';
                    axios.post('/api/register', {
                        name: this.register.name,
                        email: this.register.email,
                        password: this.register.password
                    })
                        .then(resp => {
                            console.log('response', resp);
                            const authUser = {
                                username: resp.data.name,
                                email: resp.data.email,
                                auth_id: resp.data.id
                            };
                            localStorage.setItem('authUser', JSON.stringify(authUser));
                            const userObj = JSON.parse(localStorage.getItem('authUser'));
                            this.$store.dispatch('user/setUserObject', userObj);

                            this.$router.push('/main');
                            toastr.success('Registration was successful! You are now logged in.');
                        }).catch(error => {
                            console.log('error', error);
                    })
                }else{
                    this.message = 'Password does not match confirm password.';
                    this.register.password = '';
                    this.register.confirm_password = '';
                }
            }
        }
    }
</script>

<style scoped>
    .message{
        background: #ff4430;
    }
</style>
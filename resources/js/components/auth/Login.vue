<template>
    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form @submit.prevent="login">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" v-model="form.email"/>
                                                <label for="inputEmail">Email address</label>
                                                <small class="text-danger" v-if="errors.email" style="color: red;"> {{ errors.email[0] }} </small>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" v-model="form.password"/>
                                                <label for="inputPassword">Password</label>
                                                <small class="text-danger" v-if="errors.password"> {{ errors.password[0] }} </small>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <router-link to="/forget" class="small">Forgot Password?</router-link>
                                                <button type="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><router-link to="/register">Need an account? Sign up!</router-link></div>
                                    </div>
                                </div>
                            </div>
                        </div>
     </div>
</template>

<script type="text/javascript">
    export default{
    created(){
    if (User.loggedIn()) {
          this.$router.push('/home')
        }
    },
    data(){
        return{
            form:{
                email:null,
                password:null
            },
            errors:{},
        }
    },
    methods:{
        login(){
            axios.post('/api/auth/login',this.form)
            .then(res =>{
                User.responseAfterLogin(res)
                Toast.fire({
                    icon: 'success',
                    title: 'Signed in successfully'
                })
                this.$router.push('/home')
            })
            .catch( error => this.errors = error.response.data.errors )
            .catch(
                // Toast.fire({
                //     icon: 'warning',
                //     title: 'Invalid Email Or Password !'
                // })
            )
        }
    }
  }
</script>


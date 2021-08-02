<template>
     <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form @submit.prevent="signup">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" v-model="form.name"/>
                                                        <label for="inputFirstName">First name</label>
                                                        <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" v-model="form.email"/>
                                                <label for="inputEmail">Email address</label>
                                                <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }} </small>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password" placeholder="Create a password" v-model="form.password"/>
                                                        <label for="inputPassword">Password</label>
                                                        <small class="text-danger" v-if="errors.password"> {{ errors.password[0] }} </small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="Confirm password" v-model="form.password_confirmation"/>
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                         <router-link to="/" class="small">Have an account? Go to login</router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</template>

<script type="text/javascript">
 export default { 
  created(){
    // if (User.loggedIn()) {
    //   this.$router.push({name : 'home'})
    // }
  },
  data(){
    return {
      form:{
        name: null,
        email: null,
        password: null,
        confirm_password: null
      },
      errors:{},
    }
  },
  methods:{
    signup(){
      axios.post('/api/auth/signup',this.form)
      .then(res => { 
        User.responseAfterLogin(res)
        Toast.fire({
          type: 'success',
          title: 'Signed in successfully'
        })
        this.$router.push('/home')
      })
      .catch(error => this.errors = error.response.data.errors)
    }
  }
}
</script>
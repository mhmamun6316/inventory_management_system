<template>
    <div class="m-3">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Employee</li>
        </ol>
        <div class="row m-1">
         <div class="card cards-top col-lg-12">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <i class="fas fa-chart-area"></i>
                    Customer Insert 
                </div>
                <router-link to="/all/customer" class="btn btn-info text-white" id="add_new"> All Customer</router-link>
            </div>
            <form @submit.prevent="CustomerInsert" enctype="multipart/form-data">
                <div class="card-body">
                   <div class="row mb-3">
                     <div class="col-md-6">
                        <div class="form-floating">
                          <input class="form-control" type="text" placeholder="Enter your first name" v-model="form.name"/>
                          <label>First name</label>
                          <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-floating">
                          <input class="form-control" type="text" placeholder="Enter your Email Address" v-model="form.email"/>
                          <label>Email Address</label>
                          <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }} </small>
                        </div>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="col-md-6">
                        <div class="form-floating">
                          <input class="form-control" type="text" placeholder="Enter your first name" v-model="form.address"/>
                          <label>Address</label>
                          <small class="text-danger" v-if="errors.address"> {{ errors.address[0] }} </small>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-floating">
                          <input class="form-control" type="text" placeholder="Enter your Email Address" v-model="form.phone"/>
                          <label>Phone</label>
                          <small class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }} </small>
                        </div>
                     </div>
                  </div> 
                  <div class="row mb-3">
                     <div class="col-md-6">
                        <div class="form-floating">
                          <input type="file" class="btn btn-info w-100" @change="onFileselected">
	                      <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-floating">
                          <img :src="form.photo" style="height:100px; width: 100px;">
                        </div>
                     </div>
                  </div>   
                </div>
                <button type="submit" class="btn btn-success ml-3 mb-3">Submit</button>
            </form>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
    	mounted(){
            if (!User.loggedIn()) {
               this.$router.push({ name:'/' })
            } 
        },
        data(){
        	return{
        		form:{
        			name :'',
        			email :'',
        			phone:'',
        			address:'',
        			photo :'',
        		},
        		errors:{},
        	}
        },
        methods:{ 	
        	onFileselected(event){
        		let file=event.target.files[0];

            if(file.size > 1048000){
               Notification.image_validation();
            }else{
               let reader = new FileReader();
        			reader.onload = event => {
        				this.form.photo = event.target.result
        				// console.log(event.target.result);
        			};
        			reader.readAsDataURL(file);
            }
        	},
        	CustomerInsert(){
        		axios.post('/api/customer/',this.form)
        		.then(() => {
        			this.$router.push('/all/customer')
        			Notification.success()
        		})
        		.catch(error => this.errors = error.response.data.errors)
        	}
        }
    }
</script>

<style scoped>

  .tables-header{
    padding: 0px!important;
    border-bottom:none!important;
  }
  .cards-top{
    padding: 0px!important;
  }
</style>
 <template>
    <div class="m-3">
        <!-- Icon Cards-->
       <div class="row container m-3">
         <div class="card col-lg-12">
          <div class="cards-head d-flex justify-content-between">
            <div>
                <h3><b>Customer Update</b></h3>
            </div>
            <router-link to="/all/customer" class="btn btn-add text-white btn-info" id="add_new"><i class="fas fa-eye"></i> All Customer</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="CustomerUpdate">
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
                          <input class="form-control" type="text" placeholder="Enter your Email Address" v-model="form.salary"/>
                          <label>Salary</label>
                          <small class="text-danger" v-if="errors.salary"> {{ errors.phone[0] }} </small>
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
              <button type="submit" class="btn btn-success">Update</button>
           </form>
          </div>
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
                    newphoto:'',
        		},
        		errors:{},
        	}
        },
        created(){
        	let id = this.$route.params.id
        	axios.get('/api/customer/'+id)
        	.then(({data}) => (this.form = data))
        	.catch()
        },
        methods:{ 	
          onFileselected(event){
        		let file=event.target.files[0];

            if(file.size > 1048000){
               Notification.image_validation();
            }else{
               let reader = new FileReader();
        			reader.onload = event => {
        				this.form.newphoto = event.target.result
        				// console.log(event.target.result);
        			};
        			reader.readAsDataURL(file);
            }
        	},
        	CustomerUpdate(){
        		let id = this.$route.params.id
        		axios.patch('/api/customer/'+id,this.form)
        		.then(() => {
        			this.$router.push('/all/customer')
        			Notification.success()
        		})
        		.catch(error => this.errors = error.response.data.errors)
        	},
        	
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
  .card{
    padding: 20px;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  }
  .card-body{
    padding:20px 0px!important;
  }
  .btn-add{
    border-radius: 5rem;
  }
</style>
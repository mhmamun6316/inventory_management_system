 <template>
    <div class="m-3">
        <!-- Icon Cards-->
       <div class="row container m-3">
         <div class="card col-lg-12">
          <div class="cards-head d-flex justify-content-between">
            <div>
                <h3><b>Employee Update </b></h3>
            </div>
            <router-link to="/all/employee" class="btn btn-info text-white btn-add" id="add_new"><i class="fas fa-eye"></i> All Employee</router-link>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="EmployeeUpdate">
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
                          <small class="text-danger" v-if="errors.salary"> {{ errors.salary[0] }} </small>
                        </div>
                     </div>
                  </div> 
                  <div class="row mb-3">
                     <div class="col-md-6">
                        <div class="form-floating">
                          <input class="form-control" type="date" placeholder="Enter your first name" v-model="form.joining_date"/>
                          <label>joining date</label>
                          <small class="text-danger" v-if="errors.joining_date"> {{ errors.joining_date[0] }} </small>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-floating">
                          <input class="form-control" type="text" placeholder="Enter your Email Address" v-model="form.nid"/>
                          <label>NID</label>
                          <small class="text-danger" v-if="errors.nid"> {{ errors.nid[0] }} </small>
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
        			salary:'',
        			address:'',
        			photo :'',
              newphoto:'',
        			nid : '',
        			joining_date:''
        		},
        		errors:{},
        	}
        },
        created(){
        	let id = this.$route.params.id
        	axios.get('/api/employe/'+id)
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
        	EmployeeUpdate(){
        		let id = this.$route.params.id
        		axios.patch('/api/employe/'+id,this.form)
        		.then(() => {
        			this.$router.push('/all/employee')
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
  .card-body{
    padding: 0px!important;
  }
  .card{
    padding: 20px;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  }
  .cards-head{
    margin-bottom: 20px;
  }
  .btn-add{
    border-radius: 5rem;
  }
</style>
 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Employee</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header d-flex justify-content-between">
            <div>
                <i class="fas fa-chart-area"></i>
                Employee Update 
            </div>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="SalaryUpdate">
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
                        <div class="form-group">  
                         <label for="">Month</label>
                        <select class="form-control" id="exampleFormControlSelect1" v-model="form.salary_month">
                          <option value="January">January</option>
                          <option value="February">February</option>
                          <option value="March">March</option>
                          <option value="April">April</option>
                          <option value="May">May</option>
                          <option value="June">June</option>
                          <option value="July">July</option>
                          <option value="August">August</option>
                          <option value="September">September</option>
                          <option value="October">October</option>
                          <option value="November">November</option>
                          <option value="Devember">December</option>
                        </select>
                        <small class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0] }}</small>
                        </div>
                     </div>
                     <input type="hidden" v-model="form.employee_id">
                     <div class="col-md-6">
                        <div class="form-group">
                          <label for="lastName">Salary</label>
                          <input type="text" v-model="form.amount" class="form-control"  required="">
                          <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
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
        			amount:'',
        			salary_month:'',
                    employee_id:'',
        		},
        		errors:{},
        	}
        },
        created(){
        	let id = this.$route.params.id
        	axios.get('/api/edit/salary/'+id)
        	.then(({data}) => (this.form = data))
        	.catch()
        },
        methods:{ 
        	SalaryUpdate(){
        		let id = this.$route.params.id
        		axios.post('/api/update/salary/'+id,this.form)
        		.then(() => {
        			this.$router.push('/all/salary')
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
</style>
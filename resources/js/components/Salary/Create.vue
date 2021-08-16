 <template>
    <div class="m-3">
        <!-- Icon Cards-->
       <div class="row container m-3">
         <div class="card col-lg-12">
          <div class="cards-head d-flex justify-content-between">
            <div>
                <h3><b>Employee Update </b></h3>
            </div>
          </div>
          <div class="card-body">
          	  <form @submit.prevent="SalaryInsert">
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
                     <div class="col-md-6">
                        <div class="form-group">
                          <label for="lastName">Salary</label>
                          <input type="text" v-model="form.salary" class="form-control"  required="">
                          <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                        </div>
                     </div>
                  </div>
  
                </div>
              <button type="submit" class="btn btn-success">Paid</button>
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
        			salary_month:'',
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
        	SalaryInsert(){
        		let id = this.$route.params.id
        		axios.patch('/api/salary/'+id,this.form)
        		.then(() => {
        			this.$router.push('/given/salary')
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
    margin-bottom: 20px;
  }
  .card-body{
    padding: 0px!important;
  }
  .card{
    padding: 20px!important;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  }
  .btn-add{
    border-radius: 5rem;
  }
</style>
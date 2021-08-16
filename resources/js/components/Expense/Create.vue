<template>
    <div class="m-3">
        <div class="row m-3">
         <div class="card cards-top col-lg-12">
            <div class="cards-head d-flex justify-content-between">
                <div>
                    <h3><b>Expense Insert </b></h3>
                </div>
                <router-link to="/today/expense" class="btn btn-add btn-info text-white" id="add_new"><i class="fas fa-eye"></i> All Expense</router-link>
            </div>
            <form @submit.prevent="ExpenseInsert" >
                <div class="card-body">
                   <div class="row mb-3">
                     <div class="col-md-12">
                        <div class="form-floating">
                          <textarea class="form-control"  type="text" placeholder="Enter your first name" v-model="form.details"/>
                          <label>Details of Expenses</label>
                          <small class="text-danger" v-if="errors.details"> {{ errors.details[0] }} </small>
                        </div>
                     </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-md-12">
                        <div class="form-floating">
                          <input class="form-control" type="text" placeholder="Enter your first name" v-model="form.amount"/>
                          <label>Expense Amount</label>
                          <small class="text-danger" v-if="errors.amount"> {{ errors.amount[0] }} </small>
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
        		    details :'',
                    amount :''
        		},
        		errors:{},
        	}
        },
        methods:{ 	
        	ExpenseInsert(){
        		axios.post('/api/expense/',this.form)
        		.then(() => {
        			this.$router.push('/today/expense')
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
  .card{
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  }
  .cards-head{
    padding: 20px;
  }
  .btn-add{
    border-radius: 5rem;
  }
</style>
<template>
    <div class="m-3">
        <div class="row m-3">
         <div class="card cards-top col-lg-12">
            <div class="cards-head d-flex justify-content-between">
                <div>
                    <h3><b>Category Update </b></h3>
                </div>
                <router-link to="/all/category" class="btn btn-add btn-info text-white" id="add_new"><i class="fas fa-eye"></i> All Category</router-link>
            </div>
            <form @submit.prevent="caetgoryUpdate">
                <div class="card-body">
                   <div class="row mb-3">
                     <div class="col-md-12">
                        <div class="form-floating">
                          <input class="form-control" type="text" placeholder="Enter your first name" v-model="form.categories_name"/>
                          <label>Category Name</label>
                          <small class="text-danger" v-if="errors.categories_name"> {{ errors.categories_name[0] }} </small>
                        </div>
                     </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-success ml-3 mb-3">Update</button>
            </form>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
    	mounted(){
            if (!User.loggedIn()) {
               this.$router.push('/')
            } 
        },
        data(){
        	return{
        		form:{
        			categories_name :'',
        		},
        		errors:{},
        	}
        },
        created(){
        	let id = this.$route.params.id
        	axios.get('/api/category/'+id)
        	.then(({data}) => (this.form = data))
        	.catch()
        },
        methods:{
            caetgoryUpdate(){
        		let id = this.$route.params.id
        		axios.patch('/api/category/'+id,this.form)
        		.then(() => {
        			this.$router.push('/all/category')
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
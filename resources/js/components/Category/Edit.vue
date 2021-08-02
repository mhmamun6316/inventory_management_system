<template>
    <div class="m-3">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Category</li>
        </ol>
        <div class="row m-1">
         <div class="card cards-top col-lg-12">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <i class="fas fa-chart-area"></i>
                    Category Update 
                </div>
                <router-link to="/all/category" class="btn btn-info text-white" id="add_new"> All Category</router-link>
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
</style>
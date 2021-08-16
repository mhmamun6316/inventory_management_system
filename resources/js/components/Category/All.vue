<template>
    <div class="m-3">
        <div class="row m-3">
         <div class="card cards-top col-lg-12">
            <div class="cards-head d-flex justify-content-between">
                    <div>
                       <h3><b>All Category</b></h3>
                    </div>
                    <router-link to="/create/category" class="btn btn-add btn-info text-white" id="add_new"><i class="fas fa-plus mr-1"></i>  Add New Category</router-link>
            </div>
            <div class="card-body">
                              <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-bordered text-center" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Category Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr v-for="(category,index) in categories" :key="category.id">
                                            <td>{{index+1}}</td>
                                            <td>{{ category.categories_name }}</td>
                                            <td>
                                              <router-link :to="`/edit/category/${category.id}`" class="btn btn-info">Edit</router-link>
                                              <a @click="deleteCategory(category.id)" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                              </div>
                            </div>
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
            categories:[],     
          }
        },
        created(){
             this.allCategory();
        },
         methods:{
          allCategory(){
            axios.get('/api/category/')
            .then(({data}) => (this.categories = data))
            .catch()
          },
          deleteCategory(id){
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                axios.delete('/api/category/'+id)
                .then(()=>{
                     this.allCategory();
                })
                .catch(()=>{
                  this.$router.push('/create/category')
                })
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            })
          }
         }
    }
</script>

<style scoped>
  #em_photo{
    height: 40px;
    width: 40px;
  }
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
  .card-body{
    padding: 20px!important;
  }
  .btn-add{
    border-radius: 5rem;
  }
</style>
<template>
    <div class="m-3">
        <div class="row m-3">
         <div class="card cards-top col-lg-12">
            <div class="cards-head d-flex justify-content-between">
                    <div>
                       <h3><b>All Customer </b></h3>
                    </div>
                    <router-link to="/create/customer" class="btn btn-add btn-info text-white" id="add_new"> 
                    <i class="fas fa-plus mr-1"></i>Add New Customer</router-link>
            </div>
            <div class="card-body">
                              <div class="table-responsive">
                                <div class="d-flex justify-content-end mb-2"> 
                                  <label class="mb-0 d-flex align-items-center mr-2">Search:</label>
                                  <input type="text" v-model="searchTerm"  class="form-control" style="width:200px;">  
                                </div>
                                <table id="datatablesSimple" class="table table-bordered text-center" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Photo</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr v-for="(customer,index) in filtersearch" :key="customer.id">
                                            <td>{{index+1}}</td>
                                            <td>{{ customer.name }}</td>
                                            <td><img :src="`/${customer.photo}`"  id="em_photo"></td>
                                            <td>{{ customer.address }}</td>
                                            <td>{{ customer.phone }}</td>
                                            <td>
                                              <router-link :to="`/edit/customer/${customer.id}`" class="btn btn-info">Edit</router-link>
                                              <a @click="deleteCustomer(customer.id)" class="btn btn-danger">Delete</a>
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
               this.$router.push({ name:'/' })
            } 
        },
        data(){
          return{
            customers:[],
            searchTerm:'',       
          }
        },
        created(){
        this.allCustomer();
        },
        computed:{
         filtersearch(){
          return this.customers.filter(customer => {
             return customer.name.match(this.searchTerm)
           })
         }
       },
        methods:{
          allCustomer(){
            axios.get('/api/customer/')
            .then(({data}) => (this.customers = data))
            .catch()
          },
          deleteCustomer(id){
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
                axios.delete('/api/customer/'+id)
                .then(()=>{
                 this.customers = this.customers.filter(customer =>{
                    return customer.id !=id
                  })
                })
                .catch(()=>{
                  this.$router.push('/all/customer')
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
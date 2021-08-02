<template>
    <div class="m-3">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Supplier </li>
        </ol>
        <div class="row m-1">
         <div class="card cards-top col-lg-12">
            <div class="card-header d-flex justify-content-between">
                    <div>
                        <i class="fas fa-chart-area"></i>
                       All Supplier 
                    </div>
                    <router-link to="/create/supplier" class="btn btn-info text-white" id="add_new"> Add New Supplier</router-link>
            </div>
         </div>
        <div class="card mb-4">
              <div class="card-header tables-header">
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
                                            <th>E-Mail</th>
                                            <th>Phone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr v-for="(supplier,index) in filtersearch" :key="supplier.id">
                                            <td>{{index+1}}</td>
                                            <td>{{ supplier.name }}</td>
                                            <td><img :src="`/${supplier.photo}`"  id="em_photo"></td>
                                            <td>{{ supplier.address }}</td>
                                            <td>{{ supplier.email }}</td>
                                            <td>{{ supplier.phone }}</td>
                                            <td>
                                              <router-link :to="`/edit/supplier/${supplier.id}`" class="btn btn-info">Edit</router-link>
                                              <a @click="deleteSupplier(supplier.id)" class="btn btn-danger">Delete</a>
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
            suppliers:[],
            searchTerm:'',       
          }
        },
        created(){
        this.allSuppliers();
        },
        computed:{
         filtersearch(){
          return this.suppliers.filter(supplier => {
             return supplier.name.match(this.searchTerm)
           })
         }
       },
        methods:{
          allSuppliers(){
            axios.get('/api/supplier/')
            .then(({data}) => (this.suppliers = data))
            .catch()
          },
          deleteSupplier(id){
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
                axios.delete('/api/supplier/'+id)
                .then(()=>{
                 this.suppliers = this.suppliers.filter(supplier =>{
                    return supplier.id !=id
                  })
                })
                .catch(()=>{
                  this.$router.push('/create/supplier')
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
</style>
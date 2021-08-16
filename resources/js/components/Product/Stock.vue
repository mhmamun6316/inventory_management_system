<template>
    <div class="m-3">
        <div class="row m-3">
         <div class="card cards-top col-lg-12">
            <div class="cards-head d-flex justify-content-between">
                    <div>
                        <h3><b>All Product </b></h3>
                    </div>
                    <router-link to="/create/product" class="btn btn-add btn-info text-white" id="add_new"><i class="fas fa-plus mr-1"></i> Add New Product</router-link>
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
                                            <th>Category</th>
                                            <th>Buying Price</th>
                                            <th>Status</th>
                                            <th>Quantity</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr v-for="(product,index) in filtersearch" :key="product.id">
                                            <td>{{index+1}}</td>
                                            <td>{{ product.Product_name}}</td>
                                            <td><img :src="`/${product.image}`"  id="em_photo"></td>
                                            <td>{{ product.category.categories_name }}</td>
                                            <td>{{ product.buying_price }}</td>
                                            <td v-if="product.product_quantity >= 1"><span class="badge badge-success">Availble</span></td>
                                            <td v-else><span class="badge badge-danger">Stock Out</span></td>
                                            <td>{{ product.product_quantity }}</td>
                                            <td>
                                              <router-link :to="`/stock/edit/product/${product.id}`" class="btn btn-info">Edit</router-link>
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
            products:[],
            searchTerm:'',       
          }
        },
        created(){
        this.allProduct();
        },
        computed:{
         filtersearch(){
          return this.products.filter(product => {
             return product.Product_name.match(this.searchTerm)
           })
         }
       },
        methods:{
          allProduct(){
            axios.get('/api/product/')
            .then(({data}) => (this.products = data))
            .catch()
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
<template>
    <div class="m-3">
        <div class="row m-3">
         <div class="card cards-top col-lg-12">
            <div class="cards-head">
                    <div>
                       <h3><b>Today Orders </b></h3>
                    </div>
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
                            <th>Total</th>
                            <th>Pay</th>
                            <th>Due</th>
                            <th>PayBy</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr v-for="(order,index) in filtersearch" :key="order.id">
                            <td>{{index+1}}</td>
                            <td>{{ order.name }}</td>
                            <td>{{ order.total }}</td>
                            <td>{{ order.pay }}</td>
                            <td>{{ order.due }}</td>
                            <td>{{ order.payby }}</td>
                            <td>
                              <router-link :to="`/view/order/${order.id}`" class="btn btn-info">View Details</router-link>
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
            orders:[],
            searchTerm:'',       
          }
        },
        created(){
        this.allOrders();
        },
        computed:{
         filtersearch(){
          return this.orders.filter(order => {
             return order.name.match(this.searchTerm)
           })
         }
       },
        methods:{
          allOrders(){
            axios.get('/api/orders/')
            .then(({data}) => (this.orders = data))
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
    padding: 20px!important;
  }
  .card-body{
    padding: 0px!important;
  }
  .cards-head{
    margin-bottom: 20px;
  }
</style>
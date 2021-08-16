<template>
    <div class="m-3">
        <div class="row m-3">
         <div class="card cards-top col-lg-12">
            <div class="cards-head">
                <div>
                    <h3><b>Product Details </b></h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
             		<div class="col-lg-6 col-md-6 col-6">
             			<ul class="list-group">
						  <li class="list-group-item bg-info text-white">Customer Details</li>
						  <li class="list-group-item">Name: {{ orders.name }}</li>
						  <li class="list-group-item">Phone: {{ orders.phone }}</li>
						  <li class="list-group-item">Address: {{ orders.address }}</li>
						  <li class="list-group-item">Date : {{ orders.order_date }}</li>
						  <li class="list-group-item">Quantity: {{ orders.qty }}</li>
						</ul>
             		</div>
             		<div class="col-lg-6 col-md-6 col-6">
             			<ul class="list-group">
						  <li class="list-group-item">Sub Total: {{ orders.sub_total }}</li>
						  <li class="list-group-item">Vat: {{ orders.vat }} %</li>
						  <li class="list-group-item">Total: {{ orders.total }}</li>
						  <li class="list-group-item">Pay: {{ orders.pay }}</li>
						  <li class="list-group-item">Due: {{ orders.due }}</li>
						  <li class="list-group-item">Pay Through: {{ orders.payby }}</li>
						</ul>
             		</div>
             	</div> 
            </div>
          </div>
        </div>
        <div class="row m-3 mt-2">
         <div class="card col-lg-12">
          <div class="cards-head">
            <h3><b>Order  Details </b></h3>
          </div>
          <div class="card-body">
             <div class="row">
             	<div class="table-responsive">
	              <br>
	                <table class="table table-hover table-bordered" id="" width="100%" cellspacing="0">
	                  <thead>
	                    <tr >
	                      <th>Name</th>
	                      <th>Image</th>
	                      <th>Qty</th>
	                      <th>Unit Price</th>
	                      <th>Total</th>
	                    </tr>
	                  </thead> 
	                  <tbody>
	                    <tr v-for="detail in details" :key="detail.id">
	                      <td>{{ detail.Product_name }}</td>
	                      <td><img :src="'/'+detail.image" id="em_photo"></td>
	                      <td>{{ detail.pro_quantity }}</td>
	                      <td>{{ detail.product_price }}</td>
	                      <td>{{ detail.sub_total }}</td>
	                    </tr> 
	                  </tbody>
	                </table>
	              </div>
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
        		errors:{},
                orders:{},
        		details:{},
        	}
        },
        created(){

            let id = this.$route.params.id
        	axios.get('/api/order/details/'+id)
        	.then(({data}) => (this.orders = data))
        	.catch()

        	axios.get('/api/order/orderdetails/'+id)
        	.then(({data}) => (this.details = data))
        	.catch()

        },
        methods:{
            
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
  #em_photo{
      height: 40px;
      width: 40px;
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
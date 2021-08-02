 <template>
    <div>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Search Order</li>
        </ol>
        <!-- Icon Cards-->
       <div class="row container">
         <div class="card col-lg-12">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Search Orders 
            <router-link to="/order" class="btn btn-sm btn-info" id="add_new">Today Order</router-link>
          </div>
          <div class="row">
          	<div class="col-lg-6">
          	  <form @submit.prevent="searchDate">
	            <div class="card-body">
	                <div class="form-group">
		              <div class="form-row">
		               <div class="col-md-12">
		                <div class="form-group">
						    <label for="exampleFormControlSelect2">Search By Date</label>
						    <input type="date" required="" class="form-control" v-model="date">
						  </div>
		               </div><br>
		               <button type="submit" class="btn btn-success">Search</button>
		             </div>
		            </div>     
		          </div>
	            </form>
            </div>
            </div>
            <div class="row m-1 mt-2">
                <div class="card col-lg-12">
                <div class="card-header">
                    <i class="fas fa-chart-area"></i>
                     Order  Details 
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                        <br>
                            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                            <thead>
                                <tr >
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Vat</th>
                                <th>Total</th>
                                <th>Pay</th>
                                <th>Due</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <tr v-for="order in orders" :key="order.id">
                                <td>{{ order.name }}</td>
                                <td>{{ order.qty }}</td>
                                <td>{{ order.sub_total }}</td>
                                <td>{{ order.vat }}%</td>
                                <td>{{ order.total }}</td>
                                <td>{{ order.pay }}</td>
                                <td>{{ order.due }}</td>
                                </tr> 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td>{{qunatity}}Piece</td>
                                    <td>{{subtotal}}Tk</td>
                                    <td>{{vat}}Tk</td>
                                    <td>{{total}}Tk</td>
                                    <td>{{pay}}Tk</td>
                                    <td>{{due}}Tk</td>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                        </div> 
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
        		date:'',
                month:'',
                orders:'',
        	}
        },
        computed:{
         qunatity(){
           let sum=0;
           for(let i =0; i < this.orders.length; i++ ){
              sum += (parseFloat(this.orders[i].qty));
           }
           return sum;
         },
         subtotal(){
           let sub=0;
           for(let i =0; i < this.orders.length; i++ ){
              sub += (parseFloat(this.orders[i].sub_total));
           }
           return sub;
         },
         total(){
           let sub=0;
           for(let i =0; i < this.orders.length; i++ ){
              sub += (parseFloat(this.orders[i].total));
           }
           return sub;
         },
         pay(){
           let sub=0;
           for(let i =0; i < this.orders.length; i++ ){
              sub += (parseFloat(this.orders[i].pay));
           }
           return sub;
         },
         due(){
           let sub=0;
           for(let i =0; i < this.orders.length; i++ ){
              sub += (parseFloat(this.orders[i].due));
           }
           return sub;
         },
         vat(){
           let vat=0;
           vat=this.total-this.subtotal;
           return vat;
         }
       },
        methods:{ 	
        	searchDate(){
                var data={date:this.date}
        		axios.post('/api/search/date',data)
                .then(({data}) => (this.orders = data))
        		.catch(error => this.errors = error.response.data.errors)
        	}
        }
    	
    }
  
</script>

<style>
	
#add_new{
	float: right;
}
</style>
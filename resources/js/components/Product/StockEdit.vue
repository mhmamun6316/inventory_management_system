<template>
    <div class="m-3">
        <div class="row m-3">
         <div class="card cards-top col-lg-12">
            <div class="cards-head d-flex justify-content-between">
                <div>
                    <h3><b>Product Stock Update  </b></h3>
                </div>
            </div>
            <form @submit.prevent="StockUpdate">
                <div class="card-body">
                   <div class="row mb-3">
                     <div class="col-md-12">
                        <div class="form-floating">
                          <input class="form-control" type="text" placeholder="Enter your Email Address" v-model="form.product_quantity"/>
                          <label>product_quantity</label>
                          <small class="text-danger" v-if="errors.product_quantity"> {{ errors.product_quantity[0] }} </small>
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
               this.$router.push({ name:'/' })
            } 
        },
        data(){
        	return{
        		form:{
        			product_quantity:'',
        		},
        		errors:{},
        	}
        },
        created(){
        	let id = this.$route.params.id
        	axios.get('/api/product/'+id)
        	.then(({data}) => (this.form = data))
        	.catch()
        },
        methods:{
            StockUpdate(){
        		let id = this.$route.params.id
        		axios.post('/api/stock/update/product/'+id,this.form)
        		.then(() => {
        			this.$router.push('/stock')
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
    padding: 20px!important;
  }
  .card-body{
    padding: 0px!important;
  }
  .cards-head{
    margin-bottom: 20px;
  }
  button{
    margin: 0px!important;
  }
</style>
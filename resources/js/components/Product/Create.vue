<template>
    <div class="m-3">
        <div class="row m-3">
         <div class="card cards-top col-lg-12">
            <div class="cards-head d-flex justify-content-between">
                <div>
                    <h3><b>Product Insert </b></h3>
                </div>
                <router-link to="/all/product" class="btn btn-add btn-info text-white" id="add_new"><i class="fas fa-eye"></i> All Product</router-link>
            </div>
            <form @submit.prevent="productInsert" enctype="multipart/form-data">
                <div class="card-body">
                   <div class="row mb-3">
                     <div class="col-md-12">
                        <div class="form-floating">
                          <input class="form-control" type="text" placeholder="Enter your first name" v-model="form.product_name"/>
                          <label>Product Name</label>
                          <small class="text-danger" v-if="errors.product_name"> {{ errors.product_name[0] }} </small>
                        </div>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Category</label>
                          <select class="form-control" id="exampleFormControlSelect1" v-model="form.category_id">
                            <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.categories_name }}</option>
                          </select>
                          <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Supplier</label>
                            <select class="form-control" id="exampleFormControlSelect1" v-model="form.supplier_id">
                            <option :value="supplier.id" v-for="supplier in suppliers" :key="supplier.id">{{ supplier.name }}</option>
                          </select>
                          <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
                        </div>
                     </div>
                  </div> 
                  <div class="row mb-3">
                     <div class="col-md-4">
                        <div class="form-floating">
                          <input class="form-control" type="text" placeholder="Enter your first name" v-model="form.root"/>
                          <label>Root</label>
                          <small class="text-danger" v-if="errors.root"> {{ errors.root[0] }} </small>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-floating">
                          <input class="form-control" type="text" placeholder="Enter your Email Address" v-model="form.buying_price"/>
                          <label>Buying Price</label>
                          <small class="text-danger" v-if="errors.buying_price"> {{ errors.buying_price[0] }} </small>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-floating">
                          <input class="form-control" type="text" placeholder="Enter your Email Address" v-model="form.selling_price"/>
                          <label>Selling Price</label>
                          <small class="text-danger" v-if="errors.selling_price"> {{ errors.selling_price[0] }} </small>
                        </div>
                     </div>
                  </div>
                   <div class="row mb-3">
                     <div class="col-md-6">
                        <div class="form-floating">
                          <input class="form-control" type="date" placeholder="Enter your first name" v-model="form.buying_date"/>
                          <label>Buying Date</label>
                          <small class="text-danger" v-if="errors.buying_date"> {{ errors.buying_date[0] }} </small>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-floating">
                          <input class="form-control" type="text" placeholder="Enter your Email Address" v-model="form.product_quantity"/>
                          <label>product_quantity</label>
                          <small class="text-danger" v-if="errors.product_quantity"> {{ errors.product_quantity[0] }} </small>
                        </div>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <div class="col-md-6">
                        <div class="form-floating">
                          <input type="file" class="btn btn-info w-100" @change="onFileselected">
	                        <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-floating">
                          <img :src="form.image" style="height:100px; width: 100px;">
                        </div>
                     </div>
                  </div>   
                </div>
                <button type="submit" class="btn btn-success ml-3 mb-3">Submit</button>
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
        			product_name :'',
        			category_id:'',
        			supplier_id:'',
        			root :'',
        			buying_price:'',
        			selling_price : '',
        			buying_date:'',
        			image:'',
        			product_quantity:''
        		},
        		errors:{},
        		categories:{},
        		suppliers:{},
        	}
        },
        
        methods:{ 	
        	onFileselected(event){
        		let file=event.target.files[0];
        		if (file.size > 1048770) {
        			Notification.image_validation()
        		}else{
        			let reader = new FileReader();
        			reader.onload = event => {
        				this.form.image = event.target.result
        				//console.log(event.target.result);
        			};
        			reader.readAsDataURL(file);
        		}
        	},
          productInsert(){
        		axios.post('/api/product/',this.form)
        		.then(() => {
        			this.$router.push('/all/product')
        			Notification.success()
        		})
        		.catch(error => this.errors = error.response.data.errors)
        	}
        },
        created(){
        	axios.get('/api/category')
        	.then(({data}) => (this.categories = data))
        	axios.get('/api/supplier/')
        	.then(({data}) => (this.suppliers = data))
        },
    	
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
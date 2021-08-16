<template>
    <div class="m-2">
        <div class="row m-1">
              <div class="col-md-5 col-lg-5">
                <div class="row m-1">
                    <div class="card mb-4">
                        <div class="cards-head">
                            <div class="d-flex justify-content-between">
                                <div>
                                <h3><b>Customer Insert </b></h3>
                                </div>
                                <a class="btn btn-add text-white btn-info" data-toggle="modal" data-target="#exampleModal" id="add_new"><i class="fas fa-eye"></i> Add Customer</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="card in cards" :key="card.id">
                            <th>{{card.product_name}}</th>
                            <td><input type="text" readonly="" style="width: 20px;" :value="card.product_quantity">
                                <button @click.prevent="increment(card.id)" class="btn btn-sm btn-success">+</button>
                                <button @click.prevent="decrement(card.id)" class="btn btn-sm btn-danger" v-if="card.product_quantity>=2">-</button>
                                <button class="btn btn-sm btn-danger" v-else disabled>-</button>
                            </td>
                            <td>{{card.product_price}}</td>
                            <td>{{card.sub_total}}</td>
                            <td><a @click="removeItem(card.id)"  class="btn btn-sm btn-danger">x</a></td>
                          </tr>
                         </tbody>
                         </table>
                        </div>
                        <div>
                            <ul class="list-group">
                                <li class="subTotal list-group-item">
                                Total Quantity:
                                <strong>{{qty}}</strong>
                                </li>
                                <li class="subTotal list-group-item">
                                Sub Total:
                                <strong>{{subtotal}}</strong>
                                </li>
                                <li class="subTotal list-group-item">
                                Vat:
                                <strong> {{vats.vat}} % </strong>
                                </li>
                                <li class="subTotal list-group-item">
                                Total:
                                <strong> {{subtotal*vats.vat/100 + subtotal}} </strong>
                                </li>
                            </ul>
                         <br>
                         <form @submit.prevent="orderdone">
                            <label>Customer Name</label>
                            <select class="form-control" v-model="customer_id">
                                <option :value="customer.id" v-for="customer in customers" :key="customer.id">{{customer.name}}</option>
                            </select>
                            <label>Pay</label>
                            <input type="text" class="form-control" required="" v-model="pay">
                            <label>Due</label>
                            <input type="text" class="form-control" required="" v-model="due">
                            <label>Pay By </label>
                            <select class="form-control" v-model="payby">
                                <option value="HandCash">Hand Cash</option>
                                <option value="Cheaque">Cheaque</option>
                                <option value="GiftCard">Gift Card</option>
                            </select>
                            <br>
                            <button type="submit" class="btn btn-success">Submit</button>
                         </form>
                        </div>
                    </div>              
                </div>
              </div>
              <!--customer add modal--> 
             <!-- Modal -->
             <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
               <div class="modal-dialog" role="document">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">             
                    <form @submit.prevent="customerInsert" enctype="multipart/form-data">
                      <div class="form-group">
                      <div class="form-row">
                       <div class="col-md-6">
                        <div class="form-label-group">
                          <label for="firstName">Full Name</label>
                          <input type="text" v-model="form.name"  class="form-control">
                          <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                       </div>
                       <div class="col-md-6">
                        <div class="form-label-group">
                          <label for="lastName">Email Address</label>
                          <input type="text" v-model="form.email" class="form-control" >
                          <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                        </div>
                       </div>
                     </div>
                  </div>
                  <div class="form-group">
                      <div class="form-row">
                       <div class="col-md-6">
                        <div class="form-label-group">
                          <label for="firstName">Address</label>
                          <input type="text" v-model="form.address" class="form-control">
                          <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                        </div>
                       </div>
                       <div class="col-md-6">
                        <div class="form-label-group">
                          <label for="lastName">Phone</label>
                          <input type="text" v-model="form.phone" class="form-control">
                          <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                        </div>
                       </div>
                     </div>
                  </div>
                     <div class="form-group">
                      <div class="form-row">
                       <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="file" class="btn" @change="onFileselected">
                        </div>
                       </div>
                        <div class="col-md-6">
                          <img :src="form.photo" style="height:40px; width: 40px;">
                        </div>
                     </div>
                  </div>
                <button type="submit" class="btn btn-success">Submit</button>
                  </form>
                   </div>
                 </div>
               </div>
             </div>
             <!--end customer modal-->
              <div class="col-md-7 col-lg-7">
                <div class="row m-1">
                    <div class="card mb-4">
                        <!-- Category Wise Products -->
                        <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All Products</a>
                            </li>
                            <li class="nav-item" role="presentation" v-for="category in categories" :key="category.id">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" @click="subproduct(category.id)">{{ category.categories_name }}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="d-flex justify-content-end mb-2"> 
                                        <label class="mb-0 d-flex align-items-center mr-2">Search:</label>
                                        <input type="text" v-model="searchTerm"  class="form-control" style="width:200px;">  
                                        </div>
                                        <div class="col-md-3 col-sm-6" v-for="product in filtersearch" :key="product.id">
                                            <div class="card card-product" >
                                            <button class="btn btn-sm" @click.prevent="AddToCart(product.id)" v-if="product.product_quantity>=1">
                                                <td class="productIMage"><img :src="`/${product.image}`"  id="em_photo"></td>
                                                <div class="card-body mm">
                                                    <h5 class="card-title">{{ product.Product_name}}</h5>
                                                    <span v-if="product.product_quantity >= 1" class="badge badge-success">Available ({{ product.product_quantity }}) </span>
                                                    <span v-else class="badge badge-danger">Stock Out</span>
                                                </div>
                                            </button>
                                            <button class="btn btn-sm" v-else disabled>
                                                <td class="productIMage"><img :src="`/${product.image}`"  id="em_photo"></td>
                                                <div class="card-body mm">
                                                    <h5 class="card-title">{{ product.Product_name}}</h5>
                                                    <span v-if="product.product_quantity >= 1" class="badge badge-success">Available ({{ product.product_quantity }}) </span>
                                                    <span v-else class="badge badge-danger">Stock Out</span>
                                                </div>
                                            </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                              <div class="card-body">
                                <div class="row">
                                <div class="d-flex justify-content-end mb-2"> 
                                    <label class="mb-0 d-flex align-items-center mr-2">Search:</label>
                                    <input type="text" v-model="getsearchTerm"  class="form-control" style="width:200px;">  
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6" v-for="getproduct in getfiltersearch" :key="getproduct.id">
                                    <div class="card card-product" >
                                    <button  @click.prevent="AddToCart(getproduct.id)" class="btn btn-sm"    v-if="getproduct.product_quantity>=1">
                                        <td class="productIMage"><img :src="`/${getproduct.image}`"  id="em_photo"></td>
                                        <div class="card-body mm">
                                            <h5 class="card-title">{{ getproduct.Product_name }}</h5>
                                            <span class="badge badge-success" v-if="getproduct.product_quantity >= 1"> Available ({{ getproduct.product_quantity }}) </span>
                                            <span class="badge badge-danger" v-else>Stock Out</span>
                                        </div>
                                    </button>
                                    <button  @click.prevent="AddToCart(getproduct.id)" class="btn btn-sm" v-else disabled>
                                         <td class="productIMage"><img :src="`/${getproduct.image}`"  id="em_photo"></td>
                                        <div class="card-body mm">
                                            <h5 class="card-title">{{ getproduct.Product_name }}</h5>
                                            <span class="badge badge-success" v-if="getproduct.product_quantity >= 1"> Available ({{ getproduct.product_quantity }}) </span>
                                            <span class="badge badge-danger" v-else>Stock Out</span>
                                        </div>
                                    </button>
                                    </div>
                                   </div>
                                </div>
                                </div>
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
            form:{
              name :'',
              email :'',
              address:'',
              photo :'',
              phone:'',
            },
            customer_id:'',
            pay:'',
            due:'',
            payby:'',
            products:[],
            categories:'',
            getproducts:[],
            customers:'',
            searchTerm:'',
            getsearchTerm:'',
            errors:'',   
            cards:'',
            vats:'',
          }
        },
        created(){
            this.allProduct();
            this.allCategory();
            this.allCustomer();
            this.AllCart();
            this.vat();
            Reload.$on('AfterAdd', ()=>{
            this.AllCart();
            })
        },
        computed:{
         filtersearch(){
          return this.products.filter(product => {
             return product.Product_name.match(this.searchTerm)
           })
         },
         getfiltersearch(){
          return this.getproducts.filter(getproduct => {
             return getproduct.Product_name.match(this.getsearchTerm)
           })
         },
         qty(){
           let sum=0;
           for(let i =0; i < this.cards.length; i++ ){
              sum += (parseFloat(this.cards[i].product_quantity));
           }
           return sum;
         },
         subtotal(){
           let sub=0;
           for(let i =0; i < this.cards.length; i++ ){
              sub += (parseFloat(this.cards[i].sub_total));
           }
           return sub;
         }
       },
        methods:{
          // cart methods
          AddToCart(id){
            axios.get('/api/addTocart/'+id)
            .then(() => {
              Reload.$emit('AfterAdd');
              Notification.cart_success()
            })
          },
          AllCart(){
             axios.get('/api/allCart/')
            .then(({data}) => (this.cards = data))
            .catch()
          },
          removeItem(id){
              axios.get('/api/removeCart/'+id)
             .then(() => {
              Reload.$emit('AfterAdd');
              Notification.cart_delete()
            })
          },
          increment(id){
            axios.get('/api/increment/'+id)
            .then(() => {
               Reload.$emit('AfterAdd');
               Notification.cart_increment()
            })
          },
          decrement(id){
            axios.get('/api/decrement/'+id)
            .then(() => {
               Reload.$emit('AfterAdd');
               Notification.cart_decrement()
            })
          },
          vat(){
             axios.get('/api/vat/')
            .then(({data}) => (this.vats = data))
            .catch()
          },
          orderdone(){
            let total = this.subtotal*this.vats.vat /100 +this.subtotal;
            var data = {qty:this.qty, subtotal:this.subtotal, customer_id:this.customer_id, payby:this.payby, pay:this.pay, due:this.due, vat:this.vats.vat, total:total}
            axios.post('/api/orderdone/',data)
            .then(() => {
                Notification.success()
                this.$router.push('/order')
            })
          },
        //carts end
          allProduct(){
            axios.get('/api/product/')
            .then(({data}) => (this.products = data))
            .catch()
          },
          allCategory(){
            axios.get('/api/category/')
            .then(({data}) => (this.categories = data))
            .catch()
          },
          subproduct(id){
            axios.get('/api/getting/product/'+id)
                .then(({data}) => (this.getproducts = data))
                .catch(error => this.errors = error.response.data.errors)
           },
           allCustomer(){
            axios.get('/api/customer/')
            .then(({data}) => (this.customers = data))
            .catch()
           },
           //image validationmethod
           onFileselected(event){
            let file=event.target.files[0];
            if (file.size > 1048770) {
              Notification.image_validation()
            }else{
              let reader = new FileReader();
              reader.onload = event => {
                this.form.photo = event.target.result
                console.log(event.target.result);
              };
              reader.readAsDataURL(file);
            }
          },
          customerInsert(){
          axios.post('/api/customer/',this.form)
            .then(() => {
              $('#closeModal').click();
              this.allCustomer();
              Notification.success()
            })
            .catch(error => this.errors = error.response.data.errors)
          }
        }
    }
</script>

<style scoped>
    .card-product{
        margin-bottom: 5px;
    }
    .mm{
         padding: 5px!important;
         padding-top: 10px!important;
         text-align: center!important;;
    }
  #em_photo{
    height: 100%;
    width: 100%;
  }
  .productIMage{
      text-align: center;
  }
  .tables-header{
    padding: 0px!important;
    border-bottom:none!important;
  }
  .cards-top{
    padding: 0px!important;
  }
  .subTotal{
      display: flex;
      justify-content: space-between;
      align-items: center;
  }
   .card{
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    padding-bottom: 20px;
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
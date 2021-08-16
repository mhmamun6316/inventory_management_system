<template>
        <div>
            <main>
                    <div class="container-fluid px-4 mt-5">
                        <div class="row">
                          <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Todays Total Sell</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{totalSale}} Taka</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                               Todays Total Income</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{income}} Taka</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                              </div>
                          </div>
                          <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Todays Total Due
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{due}} Taka</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Expense</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{expense}} Taka</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div> 
                    <div class="container-fluid px-4 mt-2">
                        <div class="row">
                          <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Monthly Total Sell</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{totalmonth}} Taka</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                               Monthly Total Income</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{totalmonthpay}} Taka</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                              </div>
                          </div>
                          <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Monthly Total Due
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{totalmonthdue}} Taka</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Monthly Total Expense</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{totalmonthexpense}} Taka</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div> 
                    <div class="card  m-4">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-hover table-bordered text-center" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Photo</th>
                                            <th>Buying Price</th>
                                            <th>Status</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>  
                                        <tr v-for="(stockOut,index) in stockOuts" :key="stockOut.id">
                                            <td>{{index+1}}</td>
                                            <td>{{ stockOut.Product_name}}</td>
                                            <td><img :src="`/${stockOut.image}`"  id="em_photo"></td>
                                            <td>{{ stockOut.buying_price }}</td>
                                            <td v-if="stockOut.product_quantity >= 1"><span class="badge badge-success">Availble</span></td>
                                            <td v-else><span class="badge badge-danger">Stock Out</span></td>
                                            <td>{{ stockOut.product_quantity }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
            </main>
            <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small" style="font-size:16px;">
                            <div class="text-muted">Copyright &copy; 2021 All right reserved by <span class="text-primary">Mahedi Hassan Mamun</span></div>
                            <div class="text-muted">
                                <a>Privacy Policy</a>
                                &middot;
                                <a>Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
            </footer>
        </div>
</template>

<script>
    export default { 
    created(){
        if (!User.loggedIn()) {
            this.$router.push('/')
        }
    },

    data(){
          return{
            totalSale:'',
            income:'',
            due:'',
            expense:'',
            stockOuts:'',
            totalmonth:'',
            totalmonthpay:'',
            totalmonthdue:'',
            totalmonthexpense:'',
          }
    },
    mounted(){
        this.TodaySell();
        this.TodayIncome();
        this.TodayDue();
        this.TodayExpense();
        this.stockOut();
        this.TotalmonthSell();
        this.TotalmonthPay();
        this.TotalmonthDue();
        this.TotalmonthExpense();
    },
    methods:{
        TodaySell(){
            axios.get('api/today/sell')
            .then(({data})=>(this.totalSale=data))
            .catch()
        },
        TodayIncome(){
            axios.get('api/today/income')
            .then(({data})=>(this.income=data))
            .catch()
        },
        TodayDue(){
            axios.get('api/today/due')
            .then(({data})=>(this.due=data))
            .catch()
        },
        TodayExpense(){
            axios.get('api/today/expense')
            .then(({data})=>(this.expense=data))
            .catch()
        },
        stockOut(){
            axios.get('api/stockout')
            .then(({data})=>(this.stockOuts=data))
            .catch()
        },
        TotalmonthSell(){
            axios.get('api/total/month/sell')
            .then(({data})=>(this.totalmonth=data))
            .catch()
        },
        TotalmonthPay(){
            axios.get('api/total/month/pay')
            .then(({data})=>(this.totalmonthpay=data))
            .catch()
        },
        TotalmonthDue(){
            axios.get('api/total/month/due')
            .then(({data})=>(this.totalmonthdue=data))
            .catch()
        },
        TotalmonthExpense(){
            axios.get('api/total/month/expense')
            .then(({data})=>(this.totalmonthexpense=data))
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
  .border-left-primary{
      border-left: 5px solid #0275d8;
  }
  .border-left-success{
      border-left: 5px solid #5cb85c;
  }
  .border-left-info{
      border-left: 5px solid #5bc0de;
  }
  .border-left-warning{
      border-left: 5px solid #f0ad4e;
  }
  .card{
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  }
  .card-body{
    padding: 20px!important;
  }
</style>

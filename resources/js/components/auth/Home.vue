<template>
        <div>
            <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">{{totalSale}} Taka</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Todays Total Sell</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">{{income}} Taka</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Total Income</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">{{due}} Taka</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Total Due</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">{{expense}} Taka</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Total Expense</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="card mb-4">
                      <div class="card-header tables-header">
                         </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table id="datatablesSimple" class="table table-bordered text-center" width="100%" cellspacing="0">
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
          }
    },
    mounted(){
        this.TodaySell();
        this.TodayIncome();
        this.TodayDue();
        this.TodayExpense();
        this.stockOut();
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
        }
    }
}
</script>

<style scoped>
    #em_photo{
    height: 40px;
    width: 40px;
  }
</style>

<template>
    <div class="m-3">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Expense</li>
        </ol>
        <div class="row m-1">
         <div class="card cards-top col-lg-12">
            <div class="card-header d-flex justify-content-between">
                    <div>
                        <i class="fas fa-chart-area"></i>
                       All Expense 
                    </div>
                    <router-link to="/create/expense" class="btn btn-info text-white" id="add_new"> Add New Expense</router-link>
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
                                            <th>Details</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr v-for="(expense,index) in filtersearch" :key="expense.id">
                                            <td>{{index+1}}</td>
                                            <td>{{ expense.details }}</td>
                                            <td>{{ expense.amount }}</td>
                                            <td>{{ expense.expense_date }}</td>
                                            <td>
                                              <router-link :to="`/edit/expense/${expense.id}`" class="btn btn-info">Edit</router-link>
                                              <a @click="deleteExpense(expense.id)" class="btn btn-danger">Delete</a>
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
            expenses:[],
            searchTerm:'',       
          }
        },
        created(){
        this.allExpense();
        },
        computed:{
         filtersearch(){
          return this.expenses.filter(expense => {
             return expense.details.match(this.searchTerm)
           })
         }
       },
        methods:{
          allExpense(){
            axios.get('/api/expense/')
            .then(({data}) => (this.expenses = data))
            .catch()
          },
          deleteExpense(id){
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
                axios.delete('/api/expense/'+id)
                .then(()=>{
                 this.expenses = this.expenses.filter(expense =>{
                    return expense.id !=id
                  })
                })
                .catch(()=>{
                  this.$router.push('/create/expense')
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
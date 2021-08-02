<template>
    <div class="m-3">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Salary</li>
        </ol>
        <div class="row m-1">
         <div class="card cards-top col-lg-12">
            <div class="card-header d-flex justify-content-between">
                    <div>
                        <i class="fas fa-chart-area"></i>
                      View Monthly Salary
                    </div>
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
                                            <th>Name</th>
                                            <th>Month</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr v-for="(salary,index) in filtersearch" :key="salary.id">
                                            <td>{{index+1}}</td>
                                            <td>{{ salary.employe.name }}</td>
                                            <td>{{ salary.salary_month }}</td>
                                            <td>{{ salary.amount }}</td>
                                            <td>{{ salary.salary_date }}</td>
                                            <td>
                                              <router-link :to="`/edit/salary/${salary.id}`" class="btn btn-info">Edit Salary</router-link>
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
            salaries:[],
            searchTerm:'',       
          }
        },
        created(){
        this.viewSalary();
        },
        computed:{
         filtersearch(){
          return this.salaries.filter(salary => {
             return salary.employe.name.match(this.searchTerm)
           })
         }
       },
        methods:{
          viewSalary(){
            let id = this.$route.params.id
            axios.get('/api/salary/'+id)
            .then(({data}) => (this.salaries = data))
            .catch()
          },
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
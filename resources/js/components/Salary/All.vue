<template>
    <div class="m-3">
        <div class="row m-3">
         <div class="card cards-top col-lg-12">
            <div class="cards-head d-flex justify-content-between">
                    <div>
                        <h3><b>All Salary</b></h3>
                    </div>
            </div>
                            <div class="card-body">
                              <div class="table-responsive table-hover">
                                <div class="d-flex justify-content-end mb-2"> 
                                  <label class="mb-0 d-flex align-items-center mr-2">Search:</label>
                                  <input type="text" v-model="searchTerm"  class="form-control" style="width:200px;">  
                                </div>
                                <table id="datatablesSimple" class="table table-bordered text-center" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Month</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr v-for="(salary,index) in filtersearch" :key="salary.salary_month">
                                            <td>{{index+1}}</td>
                                            <td>{{ salary.salary_month }}</td>
                                            <td>
                                              <router-link :to="`/view/salary/${salary.salary_month}`" class="btn btn-info">View Salary</router-link>
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
        this.allSalary();
        },
        computed:{
         filtersearch(){
          return this.salaries.filter(salary => {
             return salary.salary_month.match(this.searchTerm)
           })
         }
       },
        methods:{
          allSalary(){
            axios.get('/api/salary/')
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
   .card{
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
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
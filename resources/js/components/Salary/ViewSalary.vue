<template>
    <div class="m-3">
        <div class="row m-3">
         <div class="card cards-top col-lg-12">
            <div class="cards-head d-flex justify-content-between">
                    <div>
                      <h3><b>View Monthly Salary </b></h3>
                    </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <div class="d-flex justify-content-end mb-2"> 
                  <label class="mb-0 d-flex align-items-center mr-2">Search:</label>
                  <input type="text" v-model="searchTerm"  class="form-control" style="width:200px;">  
                </div>
                <table id="datatablesSimple" class="table table-hover table-bordered text-center" width="100%" cellspacing="0">
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
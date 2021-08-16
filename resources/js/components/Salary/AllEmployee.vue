<template>
    <div class="m-3">
        <div class="row m-3">
         <div class="card cards-top col-lg-12">
            <div class="cards-head d-flex justify-content-between">
                    <div>
                       <h3><b>Employee Salary Pay </b></h3>
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
                                            <th>Name</th>
                                            <th>Photo</th>
                                            <th>Address</th>
                                            <th>Salary</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr v-for="(employee,index) in filtersearch" :key="employee.id">
                                            <td>{{index+1}}</td>
                                            <td>{{ employee.name }}</td>
                                            <td><img :src="`/${employee.photo}`"  id="em_photo"></td>
                                            <td>{{ employee.address }}</td>
                                            <td>{{ employee.salary }}</td>
                                            <td>
                                              <router-link :to="`/create/salary/${employee.id}`" class="btn btn-info">Pay Salary</router-link>
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
            employees:[],
            searchTerm:'',       
          }
        },
        created(){
        this.allEmployee();
        },
        computed:{
         filtersearch(){
          return this.employees.filter(employe => {
             return employe.name.match(this.searchTerm)
           })
         }
       },
        methods:{
          allEmployee(){
            axios.get('/api/employe/')
            .then(({data}) => (this.employees = data))
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
    padding: 20px!important;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  }
  .card-body{
    padding: 0px!important;
  }
  .cards-head{
    margin-bottom: 20px;
  }
  .btn-add{
    border-radius: 5rem;
  }
</style>
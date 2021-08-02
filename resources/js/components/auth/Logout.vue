<template>
    
</template>

<script type="text/javascript">
 export default { 
  created(){
    localStorage.removeItem('token')
    localStorage.removeItem('user')
    Toast.fire({
          icon: 'success',
          title: 'Successfully Log Out!'
        })
    this.$router.push('/')
  }
}
</script>
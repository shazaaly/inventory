<template>


</template>


<script type="text/javascript">
    export default {
        created() {
            //    here we are deleting token and user from Application local storage
            //    clear method in AppStorage js:
            localStorage.removeItem('token')
            localStorage.removeItem('user')
            Toast.fire({
                icon: 'success',
                title: 'Signed out successfully'
            })
            this.$router.push({name: '/'})

        }


    }


</script>


<style type="text/css">


</style>

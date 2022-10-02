<template>
    <form>
        <h1>Login</h1>
        <v-text-field/>
        <v-text-field/>
        <v-btn depressed elevation="3" raised text x-large :loading="loading"> Login </v-btn>
    </form>
</template>

<script>
    export default{
        data: ()=>({
            username: null,
            password: null,
            loading: false
        })
    }
</script>

<style scoped>
    form{
        width: 90%;
        position: relative;    
        left:5%;
        top:5%;
        transform: translate(-95% -95%);
    }
    button{
        position: relative;    
        left:35%;
        top: 35%;
        transform: translate(-65% -65%); 
        width: 30%;
    }
</style>
<style>

</style>
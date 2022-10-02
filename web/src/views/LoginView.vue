<template>
    <form>
        <h1>Login</h1>
        <v-text-field v-model="username"/>
        <v-text-field v-model="password" type="password"/>
        <v-btn depressed elevation="3" raised text x-large :loading="loading" @click="login"> Login </v-btn>
    </form>
</template>

<script>
    export default{
        data: ()=>({
            username: null,
            password: null,
            loading: false
        }),
        beforeCreate(){
            if(this.$store.state.user != null)
                this.$router.push('/')
        },
        methods:{
            login(){
                console.log(this.username, this.password)
                fetch("http://localhost/api/login",{
                    method: "POST",
                    body: JSON.stringify({
                        username: this.username,
                        password: this.password
                    })
                }).then(async response=>{
                    if(response.status == 200){
                        let token = await response.json();
                        localStorage.setItem("token", token);
                        this.$router.push('/')
                    }
                })
            }
        }
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
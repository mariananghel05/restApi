<template>
    <div @mouseenter="getPos" @mousemove="getPos" class="">
        <label class="p-2">{{info}}</label>
        <input placeholder="Username" v-model="username" class="form-control-lg p-2"/>
        <input placeholder="Password" type="password" v-model="password" class="form-control-lg p-2" />
        <button @click="login" class="btn btn-primary p-2">login</button>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                info: null,
                username: null,
                password: null
            }
        },
        
        beforeCreate(){
            if(this.$store.state.username !== null)
                this.$router.push({name: 'home'})
        },
        methods: {
            login(){
                fetch("http://localhost/api/login", {
                    method: "POST",
                    body: JSON.stringify({
                        "username": this.username,
                        "password": this.password
                    })
                }).then(async (response) => {
                    let user = await response.json();
                    if(typeof user === "string")
                        this.info = user
                    else{
                        this.$store.commit("fetchUser", user);
                        this.$router.push("/");
                    }
                    });
            }
        }
    }

</script>
<style scoped>
    div {
        position: relative;
        display: flex;
        flex-direction: column;
        top:20vh;
        place-items: center;
        }

        div>*{
            margin: 10px;
        }
        button{
            width: 250px;
        }
        label{
            color: red;
            font-size: 20px;
        }
</style>
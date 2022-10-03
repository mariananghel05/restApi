<template>
<v-app id="inspire">
  <v-navigation-drawer v-model="drawer" app>
      <ul>
        <li><router-link to="/">Home</router-link></li>
      </ul>
    </v-navigation-drawer>
    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>Application</v-toolbar-title>
      <router-link to="/login" v-if="this.$store.state.user == null">Login</router-link>
      <router-link to="/" v-if="this.$store.state.user != null">{{this.$store.state.user.username}}</router-link>
    </v-app-bar>

    <v-main>
      <!--  -->
      <router-view/>
    </v-main>
  </v-app>
</template>


<script>

export default {
  name: 'App',

  data: () => ({
    drawer: false
  }),
  methods:{
    
  },
  mounted(){
      fetch("http://localhost/api/fetchuser?Authorization=" + localStorage.getItem("token"), {
        method:"GET"
      }).then( async response =>{
        if(response.status == 200){
            let user = await  response.json();
            this.$store.state.user = user;
        }
        if(response.status == 401)
          return;
      })
  }
}
</script>

<style scoped>
  a{
    margin-right: 20px;
    text-decoration: none;
    color: black;
    font-size: 20px;
    transition: 0.1s;
  }
  a:hover{
    color: #333355;
  }
  ul{
    position: relative;
    list-style: none;
    left:35%;
    top: 5%;
    transform: translate(-0% -65%); 
  }
</style>
<style>
  body{
    transition: 0.5s;
    animation: show 1.5s;
  }
  @keyframes show {
    0%{
      opacity: 0;

    }
    100%{
      opacity: 1;
    }
  }
</style>
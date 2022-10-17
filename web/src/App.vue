<template>
<v-app id="inspire">
  <v-navigation-drawer v-model="drawer" app>
      <ul>
        <li><router-link to="/about">About</router-link></li>
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/dosar_credite">Dosar Credite</router-link></li>
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
<style >
  body{
    transition: 0.5s;
    animation: show 1.5s;
  }
  main{
        animation: show 0.5s;
        
    }
  @keyframes show {
    0%{
      opacity: 0;

    }
    100%{
      opacity: 1;
    }
  }
  @keyframes hide {
    0%{
      opacity: 1;

    }
    100%{
      opacity: 0;
    }
  }
  .hide{
    animation: hide 0.5s;
  }
    
</style>
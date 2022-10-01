<template>
<Navbar/>
  <router-view/>
</template>
<script>
import Navbar from './components/Navbar.vue';
export default {
    data() {
        return {};
    },
    created() {
      fetch("http://localhost/api/fetchuser", {
            method: "GET"
        }).then(async (response) => {
            let user = await response.json();
            console.log(user)
            if(user.status_code){
              this.$store.state.username = null
              this.$store.state.user.username = null
            }
            else{
            this.$store.commit("fetchUser", user);
            }
          });
    },
    methods: {},
    components: { Navbar }
}
</script>
<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>

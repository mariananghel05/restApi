<template>
<v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
    >
      <!--  -->
    </v-navigation-drawer>

    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>Application</v-toolbar-title>
      <router-link to="/login" >Login</router-link>
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
    drawer: null
  }),
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

</style>
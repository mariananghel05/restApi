<template>
    <nav class="navbar navbar-expand-lg bg-light border-bottom">
  <div class="container-fluid">
    <router-link class="navbar-brand" to="/">Navbar scroll</router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Prezentare</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">etc</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            etc lista
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Alt etc</a>
        </li>
      </ul>
      <router-link v-if="this.$store.state.user.username == null" to="/login">Login</router-link>
      <li v-if="this.$store.state.user.username != null" class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{this.$store.state.user.username}}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">etc</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" @click="logout">logut</a></li>
          </ul>
        </li>
    </div>
  </div>
</nav>
</template>

<script>
    export default{
        name:"Navbar",
        methods:{
            logout(){
                this.$store.state.username = null
                this.$store.state.user.username = null
                document.cookie = "token=null;path=/"
            }
        }
    }
</script>
<style scoped>
    li{
        list-style-type: none;
   }
</style>
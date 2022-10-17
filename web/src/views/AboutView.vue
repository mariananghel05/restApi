<template>
  <div class="about">
    <h1>This is an about page</h1>
  </div>
</template>
<style scoped>
    div{
        position: relative;
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
</style>
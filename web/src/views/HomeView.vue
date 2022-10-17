<template>
  <div>
    <HelloWorld />
  </div>
</template>

<script>
import { defineComponent } from 'vue';

// Components
import HelloWorld from '../components/HelloWorld.vue';

export default defineComponent({
  name: 'HomeView',

  components: {
    HelloWorld,
  },
});
</script>

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

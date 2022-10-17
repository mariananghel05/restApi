<template>
    <div>
        <h1><span>Buna </span>{{nume}} {{prenume}}</h1>
        <v-text-field placeholder="Nume" v-model="nume"/>
        <v-text-field placeholder="Prenume" v-model="prenume"/>
        <h1>Incarca documente:     <v-file-input chips accept=".pdf" multiple label="Apasa pentru a alege"></v-file-input></h1>
    </div>
</template>

<script>
export default {
    data: ()=>({
        nume: null,
        prenume: null
    }),
    beforeUnmount(){
        let div = document.querySelector('div')[0];
        div.classList.add("hide");
        window.event.preventDefault();
    }

}
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
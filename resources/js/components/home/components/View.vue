<template>

  <v-main>
   
    <!-- <v-app-bar-nav-icon
            color="white"
               
                @click="drawer = !drawer"
            ></v-app-bar-nav-icon> -->
  
    <v-fade-transition mode="out-in">
      <router-view />
    </v-fade-transition>
  </v-main>
</template>

<script>
  export default {
    name: 'BaseView',
    data() {
      return {
         drawer: true,
          group: null,
      }
    },
    watch: {
      group () {
        this.drawer = false 
      },
    },
  }
</script>

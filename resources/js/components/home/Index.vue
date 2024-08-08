<template>

  <!-- App.vue -->
  
  
  
      <v-app  >
  
        <!-- <home-app-bar :user="this.$props.user"  /> -->
           
          <home-view />
          <!-- <home-footer /> -->
     
      </v-app>
  </template>
  
  <script>
  export default {
    props: {
    user: {
      type: Object,
    },
  },
      name: "HomeLayout",
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
      computed: {
         height () {
          switch (this.$vuetify.breakpoint.name) {
            case 'xs': return 220
            case 'sm': return 400
            case 'md': return 500
            case 'lg': return 600
            case 'xl': return 800
          }
        },
      },
      components: {
          HomeAppBar: () => import("../home/components/AppBar"),
          HomeView: () => import("../home/components/View"),
          HomeFooter: () => import("../home/components/Footer"),
          /* ,
          HomeSettings: () => import("@/layouts/home/Settings"),
           */
      },
      mounted() {
        console.log(this.$vuetify.application.top)
    this.$store.state.usuario = this.$props.user;

      },
      methods: {
        isMobile() {
    return this.$vuetify.breakpoint.xsOnly;
  }
      },
  };
  </script>
<template>
  <div>
    <home-app-bar :user="this.$props.user" :invert="false" />
    <br>
    <br>
    <div v-if="!isMobile()">
      
      <div class="d-flex flex-column justify-space-between align-center">
      <!-- <v-img src="/img/pepita.jpg"  >    
      </v-img> -->

      <div v-if="hora == true">
        <v-img src="/img/MAYA_CAFE_LIBRE_IMAGEN.png"  >
     
      </v-img>
    </div>
    <div  v-else>
      <v-img src="/img/pepita.jpg"  >    
      </v-img>
    </div>



    </div>
  </div>
        <div v-else>
          <div class="d-flex flex-column justify-space-between align-center">
            <div v-if="hora == true">
      <v-img src="/img/MAYA_CAFE_LIBRE_IMAGEN.png"  class="ml-auto"  max-heigth="100%" >    
      </v-img>
    </div>
    <div  v-else>
      <v-img src="/img/pepita.jpg"   class="ml-auto"  max-heigth="100%">    
      </v-img>
    </div>


          <!-- <v-img src="/img/pepita.jpg"  class="ml-auto"  max-heigth="100%"  >    
          </v-img> -->
        </div>
      </div>
    
    <!-- <dash-menu> </dash-menu> -->
  </div>
</template>

<script>
export default {
  props: {
    user: {
      type: Object,
    },
    invert: {
      type: Object,
    },
  },
  name: "PageIndex",
  data() {
    return {
      vtext: "",
      valuecarlos: "",
      valuejonu: "",
      hora:true,
      form: {
        id: "",
      },
    };
  },
  components: {
    
  },
  mounted() {
    // window.Echo = new Echo({
    //   broadcaster: 'pusher',
    //   key: 'ASDASD2121',
    //   wsHost: window.location.hostname,
    //   wsPort: 6001,
    //   disableStats: true,
    //   //enabledTransports: ['ws', 'wss'], // <-- only use ws and wss as valid transports
    //    forceTLS: false,
    // })
    // let that = this;
    // window.Echo.channel('home').listen('NewMessage', (e) => {
    //   that.vtext = e.message;
    //   console.log(e.message)
    // })
    this.GetHora();
  },
  methods: {
    isMobile() {
      if (
        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
          navigator.userAgent
        )
      ) {
        return true;
      } else {
        return false;
      }
    },
    GetHora(){
      const date = new Date();
      console.log("date",date.getHours());
      let hora = date.getHours();
      
      if (  hora > 8 &&  hora < 13) {
       this.hora =  true;
       console.log("verdadero");
      } else {
        this.hora =  false;
        console.log("false");
      }
    }
  },
};
</script>
 
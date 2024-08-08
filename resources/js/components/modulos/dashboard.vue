<template>
  <div>
    <v-img src="/img/pepita.jpg" aspect-ratio="2" contain>
      <home-app-bar :user="this.$props.user" :invert="false" />
    </v-img>
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
  },
  methods: {
    saludar() {
      // axios.post('/user', {
      //   firstName: 'Fred',
      //   lastName: 'Flintstone'
      // })
      // .then(function (response) {
      //   console.log(response);
      // })
      // .catch(function (error) {
      //   console.log(error);
      // });
      // let that = this;
      //  let url ='http://192.168.8.73:8000/api/saluda2/';
      //             axios.post(url,this.form)
      //             .then(function(response) {
      //                  that.vtext = esponse.data.saludo;
      //                 console.log(response.data.saludo)
      //             })
      //             .catch(error => {
      //                 Errores de validación
      //             });
      //post('http://192.168.8.73:8000/api/saluda2/'+this.form)
      // const data = await fecth('http://192.168.8.73:8000/api/saluda2/'+this.form)
      // const response = await data.json()
      //console.log(response.saludo)
      // this.vtext = response.saludo;
    },
  },
};
</script>
 
<template>
    <div>
             <embed :src="RutaPdf" type="application/pdf" width="100%" height="600px">
      <!-- <dash-menu> </dash-menu> -->
    </div>
  </template>
  
  <script>
  export default {
    name: "PageIndex",
    data() {
      return {
        vtext: "",
        valuecarlos: "",
        valuejonu: "",
        idPdf:0,
        RutaPdf:"",
        form: {
          id: "",
        },
      };
    },
    components: {},
    mounted() {
      this.generarId();
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
      generarId(){
        var ListaVino = "/pdf/cartadevinos.pdf";
        var ListaUrdesa = "/pdf/menu_urdesa.pdf";
        var ListaPLC = "/pdf/menu_plc.pdf";
        var ListaArcos = "/pdf/menu_pls.pdf";

          this.idPdf =  this.$route.params.id;
          //carta de vino
          if (this.idPdf == 1) {
            this.RutaPdf = ListaVino;
          }

          //urdesa
          if (this.idPdf == 2) {
            this.RutaPdf = ListaUrdesa;
          }

          //plc
          if (this.idPdf == 3) {
            this.RutaPdf = ListaPLC;
          }
          //arcos
          if (this.idPdf == 4) {
            this.RutaPdf = ListaArcos;
          }
                 
        },
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
   
<template>
    <div>
      <v-snackbar
        v-model="snackbar"
        :timeout="timeout"
        absolute
        top
        :color="color"
      >
        <v-icon>{{ icono }}</v-icon>
        {{ text }}
      </v-snackbar>
  
      <v-row
        class="bgimagen"
        align="center"
        justify="center"
        v-if="vshow1 === true"
      >
        <v-col cols="12" sm="6" align="center" justify="center">
          <v-card
            color="rgb(220, 222, 225,0.7)"
            rounded="xl"
            elevation="15"
            class="text-md-center"
          >
            <v-card-title primary-title class="justify-center">
              <v-img
                class="align-content-center"
                src="/img/IMG_6151.PNG"
                max-width="200"
              >
              </v-img>
            </v-card-title>
            <v-card-title primary-title class="justify-center">
              Ingresa Usuario y Contraseña
            </v-card-title>
           <v-card-text>
            <v-text-field
                name="name"
                v-model="usuario"
                label="ingrese usuario"
                id="user"
                type="E-mail"
               
            ></v-text-field>
            <v-text-field
                name="name"
                v-model="credenciales"
                label="ingrese Credenciales"
                id="id"
                type="password"
            ></v-text-field>
           </v-card-text>
  
            <v-card-actions class="justify-center">
              <v-btn color="success" @click="SetPrimerLayaout()">Siguiente</v-btn>
            </v-card-actions>
          </v-card>
          <!-- <span
            >Para reservas mayores a 10 personas, por favor contáctarse al número
            xxxxxxxxxx.</span -->
          
        </v-col>

      </v-row>
      <!-- cantidad de persona -->
      <v-row no-gutters 
        class="bgimagen"
        align="center"
        justify="center"
        v-if="vshow2 === true"
      >
      <v-col cols="12" sm="12">
        <v-system-bar color="purple darken-4" dark class="white--text">
      <v-spacer></v-spacer>
      <v-icon @click="logout()">mdi-account</v-icon>
      <span>{{ usuario }}  </span></v-system-bar
    >
    <v-row no-gutters >
      <v-col cols="12"  >
        <v-card outlined tile elevation="15" class="rounded-lg">
          <v-system-bar color="deep-purple accent-4" dark class="white--text"
            >Criterios de Búsqueda</v-system-bar
          >
          <v-card-text>
            <v-row>
              <v-col cols="12" sm="3">
                <v-select
                  :items="icons"
                  v-model="buscar.local"
                  item-text="descripcion"
                  item-value="red_social_id"
                  persistent-hint
                  single-line
                  label="Locales"
                ></v-select>
              </v-col>
              <v-col cols="12" sm="3">
                <br />
                <label for="">Fecha inicio</label>
                <input type="date" />
              </v-col>
              <v-col cols="12" sm="3">
                <br />
                <label for="">Fecha fin</label>
                <input type="date" />
              </v-col>
              <v-col cols="12" sm="3">
                <br />
                <v-btn color="success" @click="GetReservas()">Buscar</v-btn>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="12" sm="12"  >
        <v-card
          :loader-height="5"
          :loading="loading"
          outlined
          tile
          elevation="8"
          class="rounded-lg"
        >
          <v-system-bar color="error" dark class="white--text"
            >Reservas por estaciones</v-system-bar
          >
          <v-card-text>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
            ></v-text-field>

            <v-data-table
              :headers="headers"
              :items="ListaReservas"
              :search="search"
              class="elevation-1"
            >
              <template v-slot:[`item.Acciones`]="{ item }">
                <v-icon
                  medium
                  color="primary"
                  class="mr-2"
                  @click="GenerarModalSeguimientoVisulizar(item)"
                >
                  mdi-pencil
                </v-icon>
              </template>
            </v-data-table>
            <div style="width: auto; text-align: center"></div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
      </v-col>
      </v-row>
           <!-- empieza el dialogo -->
    <v-row justify="center">
      <v-dialog v-model="dialogSeguimiento" persistent max-width="600px">

        <v-form ref="formSeguimiento">
          <v-card>
            <v-card-title>
              <span class="text-h5">Actualizar Reserva</span>
            </v-card-title>
            <v-card-text> </v-card-text>
            <v-subheader> Seleccione el local </v-subheader>

            <v-card-title primary-title>
              <v-btn-toggle>
                <v-btn
                  v-for="icon in icons"
                  :key="icon.red_social_id"
                  @click="GenerarMesas(icon.red_social_id)"
                >
                  <v-icon :color="icon.color" size="25px">
                    {{ icon.icono }}
                  </v-icon>
                  {{ icon.descripcion }}
                </v-btn>
              </v-btn-toggle>
            </v-card-title>
            <v-subheader> Seleccione el tipo de mesa </v-subheader>
            <v-card-title primary-title class="justify-center">
              Elige Cantidad de personas
            </v-card-title>
            <v-card-title primary-title class="justify-center">
              <v-chip-group
                active-class="red--text"
                v-model="registrar.numero_persona"
                column
              >
                <v-chip
                  v-for="icon in states"
                  :key="icon"
                  :value="icon"
                  @click="registrar.numero_persona = icon"
                >
                  {{ icon }}
                </v-chip>
              </v-chip-group>
            </v-card-title>
            <v-card-title primary-title class="justify-center">
              Seleccione el ambiente
            </v-card-title>
            <v-card-text primary-title class="justify-center">
              <v-row align="center" justify="center">
                <v-chip-group
                  active-class="red--text"
                  
                  column
                >
                  <v-chip
                    v-for="item in Lista_llenar"
                    :key="item.red_social_id"
                    :value="item.red_social_id"
                    @click="onCardClick(item)"
                  >
                    <span> {{ item.descripcion }}</span>
                  </v-chip>
                </v-chip-group>
              </v-row>
            </v-card-text>
            <v-subheader> Seleccione la fecha </v-subheader>
            <v-card-text>
              <v-container>
                <v-row align="center" justify="center">
                  <v-date-picker
                    date
                    v-model="registrar.fecha_reserva"
                    :min="new Date().toISOString().substr(0, 10)"
                    @click:date="GetHoraFecha()"
                  >
                  </v-date-picker>
                </v-row>
                <v-row>
                  <v-chip-group
                    active-class="black--text"
                    column
                    
                  >
                    <div
                      v-for="tag in ListHora"
                      :key="tag.hora"
                      :value="tag.hora"
                    >
                      <v-chip
                        color="success"
                        v-if="tag.estado == 0"
                        @click="GetValidarHora(tag)"
                      >
                        {{ tag.hora }}
                      </v-chip>
                      <v-chip v-else color="red" @click="GetValidarHora(tag)">
                        {{ tag.hora }}</v-chip
                      >
                    </div>
                  </v-chip-group>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="dialogSeguimiento = false"
              >
                Cerrar
              </v-btn>
              <v-btn color="blue darken-1" text @click="PostGrabar()">
                Actualizar Reserva
              </v-btn>
            </v-card-actions>
            <v-snackbar
      v-model="snackbar"
      :timeout="timeout"
      absolute
      button
      :color="color"
    >
      <v-icon>{{ icono }}</v-icon>
      {{ text }}
    </v-snackbar>
          </v-card>
        </v-form>
      </v-dialog>
    </v-row>
    <!-- fin del dialogo -->
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
    data() {
      return {
        search:"",
        vshow1: true,
        vshow2: false,
        vshow3: false,
        vshow4: false,
        vshow5: false,
        vshow6: false,
        vshow7: false,
        snackbar: false,
        color: "purple darken-4",
        text: "",
        icono: "mdi-checkbox-marked",
        timeout: 4000,
        loader: null,
        loading: false,
        icons: [],
        states: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
        selected: "",
        fecha_buscar: new Date().toISOString().slice(0, 10),
        fecha_buscar_hasta: new Date().toISOString().slice(0, 10),
        usuario:"",
        credenciales:"",
        identificacion:"",
        registrar: {
          id: 0,
          id_empresa: 1,
          id_sucursal: "",
          id_mesa: "",
          numero_persona: "",
          id_cliente_reserva: "",
          fecha_reserva: new Date(
            Date.now() - new Date().getTimezoneOffset() * 60000
          )
            .toISOString()
            .substr(0, 10),
          hora_reserva: "",
          hora_estado: "",
          descripcion: "",
          celular: "",
          pago: 0,
          transaccion: "",
          valor: 0,
          des_local: "",
          des_mesa: "",
          terminos: false,
          terminoCheck: false,
        },
        mesas: [],
        justify: ["start", "center", "end", "space-around", "space-between"],
        Lista_llenar: [],
  
        e1: 1,
  
        ruta: "",
        playerOptions: {
          // videojs options
          muted: true,
          language: "en",
          playbackRates: [0.7, 1.0, 1.5, 2.0],
          sources: [
            {
              type: "video/mp4",
              src: "https://cdn.theguardian.tv/webM/2015/07/20/150716YesMen_synd_768k_vp8.webm",
            },
          ],
          poster: "/static/images/author.jpg",
        },
        dialog: false,
        form: {
          local: 0,
          mesa: 0,
          hora: "",
          celular: "",
          fecha: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
            .toISOString()
            .substr(0, 10),
          nombres: "",
          apellidos: "",
          cedula: "",
          cliente: "",
          usuario: "",
          password: "",
          comentario: "",
          correo_electronico: "",
        },
        ListHora: [],
        ListaHoraReservada: [],
        rules: {
          age: [
            (val) =>
              val < 11 ||
              `Si la cantidad es mayor a 10 personas es obligatorio cancelar la reserva`,
          ],
        },
        nameRulesCedula: [
          (v) => !!v || "Campo es Requerido",
          (v) => (v && v.length <= 10) || "Campo minimo 10 caracteres",
        ],
        nameRulesTelefono: [],
        nameRules: [
          (v) => !!v || "Campo es Requerido",
          (v) => (v && v.length <= 25) || "Campo minimo 25 caracteres",
        ],
  
        nameRules2: [
          (v) => !!v || "Campo es Requerido",
          (v) => (v && v.length <= 25) || "Name must be less than 25 characters",
        ],
  
        emailRules: [
          (v) => !!v || "E-mail is required",
          (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
        ],
        phone: {
          number: "",
          valid: false,
          country: undefined,
        },
        CabeceraTotalCodigo:[{
                    text: "Estacion",
                    align: "start",

                    value: "descripcion",
                    class: "yellow lighten-1",
                    },
                    { text: "total", value: "codigo", class: "orange lighten-1 borderWidth:8" },
                
                ],
      
      ListaTotalCodigo:[],
      CabeceraTotalRegistrado:[{
                    text: "Estacion",
                    align: "start",

                    value: "descripcion",
                    class: "yellow lighten-1",
                    },
                    { text: "total", value: "total_registro", class: "orange lighten-1 borderWidth:8" },
                
                ],
      
      ListaTotalRegistrado:[],


      CabeceraTotalCodigoIdentificacion:[{
                    text: "Estacion",
                    align: "start",

                    value: "descripcion",
                    class: "yellow lighten-1",
                    },
                    { text: "total", value: "codigo", class: "orange lighten-1 borderWidth:8" },
                
                ],
      
      ListaTotalCodigoIdentificacion:[],
      CabeceraTotalRegistradoIdentificacion:[{
                    text: "Estacion",
                    align: "start",

                    value: "descripcion",
                    class: "yellow lighten-1",
                    },
                    { text: "total", value: "total_registro", class: "orange lighten-1 borderWidth:8" },
                
                ],
      
      ListaTotalRegistradoIdentificacion:[],
      headers: [
        {
          text: "Código",
          align: "start",

          value: "id",
          class: "primary white--text",
        },
        {
          text: "Local",
          align: "start",

          value: "sucursal",
          class: "primary white--text",
        },
        {
          text: "Mesa",
          value: "sucursa_mesa",
          class: "indigo darken-2 white--text",
        },
        {
          text: "Nombres",
          value: "nombres",
          class: "primary white--text",
        },
        {
          text: "Apellidos",
          value: "apellidos",
          class: "primary white--text",
        },
        {
          text: "Celular",
          value: "celular",
          class: "indigo darken-2 white--text",
        },
         
        {
          text: "Mensaje",
          value: "datafast",
          class: "indigo darken-2 white--text",
        },
        {
          text: "Alergia",
          value: "descripcion",
          class: "indigo darken-2 white--text",
        },
        {
          text: "Fecha",
          value: "fecha_reserva",
          class: "indigo darken-2 white--text",
        },
        {
          text: "Hora",
          value: "hora_reserva",
          class: "indigo darken-2 white--text",
        },
       
        {
          text: "Acciones",
          value: "Acciones",
          class: "indigo darken-2 white--text",
        },
      ],
      ListaReservas: [],
      loadingbutton: false,
      dialogSeguimiento: false,
      registrar: {
        id:0,
        id_empresa: 1,
        id_sucursal: "",
        id_mesa: "",
        numero_persona: "",
        id_cliente_reserva: "",
        fecha_reserva: new Date(
          Date.now() - new Date().getTimezoneOffset() * 60000
        )
          .toISOString()
          .substr(0, 10),
        hora_reserva: "",
        hora_estado: "",
        descripcion: "",
        celular: "",
        pago: 0,
        transaccion: "",
        valor: 0,
        des_local: "",
        des_mesa: "",
      },
      Lista_llenar: [],
      ListHora: [],
      buscar: {
        local: 0,
        orde: "",
        fechaini: "",
        fechafin: "",
      },
      };
      
    },
    mounted() {
      //this.GenerarHoras();
     // this.GetSucursal();
      // this.GetHoraFecha();
      this.GetSucursal();
    },
    computed: {
      //   player() {
      //     return this.$refs.videoPlayer.player
      //   }
    },
    methods: {
      logout() {
      window.location.replace("/logout");
    },
     
      SetPrimerLayaout() {
        if (
          this.usuario == null ||
          this.usuario == 0
        ) {
          this.mensajeAler("Debe ingresar credencial", false);
          return;
        }

        if (
          this.credenciales == null ||
          this.credenciales == 0
        ) {
          this.mensajeAler("Debe ingresar credencial", false);
          return;
        }
       let auth={
                email:this.usuario,
                password:this.credenciales
            };

        let url =
          this.$store.getters.getRuta +
          "/login";
        this.Lista_llenar = [];
        axios
          .post(url,auth)
          .then((response) => {
            
              console.log("datos",response);
              if(response.status===422){
                console.log(response.data.errors);
                    
                }else{
                  
                       this.vshow1 = false;
            this.vshow2 = true;
                }
           
          })
          .catch((error) => {
            console.log("aqui", error);
          });



        // if (this.credenciales == 'Copede$@2024*-') {
           
        //     this.vshow1 = false;
        //     this.vshow2 = true;
          
        // }else{
        //     this.mensajeAler("Credencial incorrecta", false);
        //     return; 
        // }
  
       
      },
      GetHoraFecha() {
      console.log("click");
      let ListaActual = [];
      this.ListHora = [];
      this.ListaHoraReservada = [];
      let url =
        this.$store.getters.getRuta +
        "/modulos/admision/reservas/GetFechaReserva/" +
        this.registrar.fecha_reserva +
        "/" +
        this.registrar.id_sucursal +
        "/" +
        this.registrar.id_mesa;

      axios
        .get(url)
        .then((response) => {
          console.log("ListaActual1", response.data.data);
          // ListaActual.push(response.data.data);
          this.ListHora = response.data.listaValida;

          // response.data.data.forEach((element) => {
          //   let objeto = {};
          //   objeto.horthisa_reserva = element.hora_reserva;
          //   ListaActual.push(objeto);
          // });
        })
        .catch((error) => {});

      var names = ListaActual.map(function (item) {
        return item["hora"];
      });

      console.log(names);

      console.log("ListaActual3", names);
      //fecha de reserva
      var moment = require("moment");
      var date = moment("12:00", "HH:mm");
      var time = [];

      for (let k of ListaActual) {
        console.log("verificar7", k);
        // typeof (k) = string
      }

      console.log("verificar3", Object.values(ListaActual));
      // do {
      //   this.ListHora.push(date.format("HH:mm"));
      //   date.add(60, "minutes");
      //   //     const resultado =  this.ListaHoraReservada.includes(date.format("HH:mm"));
      // } while (date <= moment("23:59", "HH:mm"));
    },
    onCardClick(n) {
      this.registrar.id_mesa = n.red_social_id;
      console.log("mesa", this.registrar.id_mesa);
      this.registrar.des_mesa = n.descripcion;
    },
    GenerarModalSeguimientoVisulizar(item) {
      this.registrar= {
          id: 0,
          id_empresa: 1,
          id_sucursal: "",
          id_mesa: "",
          numero_persona: "",
          id_cliente_reserva: "",
          fecha_reserva: new Date(
            Date.now() - new Date().getTimezoneOffset() * 60000
          )
            .toISOString()
            .substr(0, 10),
          hora_reserva: "",
          hora_estado: "",
          descripcion: "",
          celular: "",
          pago: 0,
          transaccion: "",
          valor: 0,
          des_local: "",
          des_mesa: "",
          terminos: false,
          terminoCheck: false,
        };
      this.dialogSeguimiento = true;
 
      this.registrar.id = item.id;
    },
    GenerarMesas(id) {
      this.registrar.id_sucursal = id;
      let url =
        this.$store.getters.getRuta +
        "/modulos/admision/reservas/GetMesasPorSucursal/" +
        id;
      this.Lista_llenar = [];
      axios
        .get(url)
        .then((response) => {
          response.data.data.forEach((item) => {
            let objeto = {};

            objeto.red_social_id = item.id;
            objeto.local = item.Sucursal_Id;
            objeto.descripcion = item.descripcion;
            objeto.icono = item.icono;
            objeto.color = item.color;
            objeto.src = item.src;
            this.Lista_llenar.push(objeto);
          });
        })
        .catch((error) => {
          console.log("aqui", error);
        });
    },

    generar() {
      try {
       
        if (this.$store.state.usuario.length != 0) {
          this.usuario.apellido = this.$store.state.usuario.apellido;
          this.usuario.nombre = this.$store.state.usuario.nombre;
        } else {
          this.$router.push("/");
        }
      } catch (error) {
        this.$router.push("/");
      }
    },
    GetReservas() {
      let url =
        this.$store.getters.getRuta +
        "/modulos/clinico/reserva/GetReserva/0/0/" +
        this.buscar.local;
        this.ListaReservas = [];
      axios
        .get(url)
        .then((response) => {
          this.ListaReservas = response.data.data;
        })
        .catch((error) => {
          console.log("aqui", error);
        });
    },

    GetSucursal() {
      let url =
        this.$store.getters.getRuta + "/modulos/admision/reservas/GetSucursal";

      axios
        .get(url)
        .then((response) => {
          response.data.data.forEach((item) => {
            let objeto = {};

            objeto.red_social_id = item.Sucursal_Id;
            objeto.descripcion = item.Sucursal_Nombre;
            objeto.icono = item.campo1;
            objeto.color = item.Sucursal_Parroquia;
            objeto.url = "";
            this.icons.push(objeto);
            console.log("aqui");
          });

          console.log("aqui", response.data.data);
        })
        .catch((error) => {
          console.log("aqui", error);
        });
    },
    GetValidarHora(id) {
     
      this.registrar.hora_reserva = id.hora;
      
      this.registrar.hora_estado = id.estado;
    },
    PostGrabar() {
      if (this.registrar.hora_estado == 1) {
        this.mensajeAler("Esta hora no esta disponible", false);
        return;
      }

      let url =
        this.$store.getters.getRuta +
        "/modulos/admision/reservas/PostValidarUsuario";
      this.Lista_llenar = [];
      axios
        .post(url, this.registrar)
        .then((response) => {
          console.log("aqui", response.data.data);

          
          this.mensajeAler(true, true);
          this.GetReservas();
          this.dialogSeguimiento = false
        })
        .catch((error) => {
          this.mensajeAler(error, false);
          console.log("aqui", error);
          this.GetReservas();

          this.dialogSeguimiento = false;
          this.loading = false;
          this.loader = null;
        });
    },
    objectFindByKey(array, key, value) {
      for (var i = 0; i < array.length; i++) {
        if (array[i][key] === value) {
          return array[i];
        }
      }
      return null;
    },

      
      mensajeAler(value, value2) {
        if (value2) {
          if (value) {
            this.icono = "mdi-checkbox-marked";
            (this.color = "green"), (this.snackbar = true);
            this.text = "Transacción realizada de manera exitosa";
          } else {
            this.icono = "mdi-close-box";
            (this.color = "light-blue darken-4"), (this.snackbar = true);
            this.text = "Transacción actualizada de manera exitosa";
          }
        } else {
          this.icono = "mdi-close-box";
          (this.color = "red darken-4"), (this.snackbar = true);
          this.text = "Error en el sistema " + value;
        }
      },
    },
  };
  </script>
  <style  >
  .bgimagen {
    background-image: url("/img/fondo.jpg");
    background-size: cover;
    height: 110vh;
  }
  .bgimagen_dos {
    background-image: url("/img/fondo_dos.jpg");
    background-size: cover;
    height: 110vh;
  }
  .bgimagen_tres {
    background-image: url("/img/fondo_dosb.jpg");
    background-size: cover;
    height: 100vh;
  }
  .letraSpam { 
     font-size: 22px !important;
   }
  </style>
   
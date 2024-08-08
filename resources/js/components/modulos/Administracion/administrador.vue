<template>
  <div>
    <br />
    <v-system-bar color="purple darken-4" dark class="white--text">
      <v-spacer></v-spacer>
      <v-icon>mdi-account</v-icon>
      <span>{{ usuario.nombre }} {{ usuario.apellido }}</span></v-system-bar
    >
    <br />
    <v-row no-gutters justify="center">
      <v-col cols="12" class="pa-1">
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
    </v-row>

    <v-row no-gutters>
      <v-col cols="12" sm="12" class="pa-1">
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
import { prefix, url } from "../../../variables";
import { funcionesGlobales } from "../../../funciones";
export default {
  props: {
    user: {
      type: Object,
    },
  },
  data() {
    return {
      buscar: {
        local: 0,
        orde: "",
        fechaini: "",
        fechafin: "",
      },
      states: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
      icons: [],
      snackbar: false,
      color: "purple darken-4",
      text: "",
      icono: "mdi-checkbox-marked",
      timeout: 4000,
      EstacionItem: "",
      mesItem: "",
      diaItem: "",
      diaActual: "",
      anioItem: "",
      justify: ["start", "center", "end", "space-around", "space-between"],
      Listanio: ["2022", "2023", "2024"],
      Listames: [
        { id: "01", mes: "Enero" },
        { id: "02", mes: "Febrero" },
        { id: "03", mes: "Marzo" },
        { id: "04", mes: "Abril" },
        { id: "05", mes: "Mayo" },
        { id: "06", mes: "Junio" },
        { id: "07", mes: "Julio" },
        { id: "08", mes: "Agosto" },
        { id: "09", mes: "Septiembre" },
        { id: "10", mes: "Octubre" },
        { id: "11", mes: "Noviembre" },
        { id: "12", mes: "Diciembre" },
      ],
      ListEstaciones: [],
      loadingTag: {
        loading1: true,
        loading2: true,
        loading3: true,
        loading4: true,
        loading5: true,
      },
      loadingCar: {
        loading1: true,
        loading2: true,
        loading3: true,
        loading4: true,
      },
      fecha_buscar: new Date().toISOString().slice(0, 10),
      ruta: "",

      //fin

      //fin

      loading: false,
      sliderTimer: null,
      search: "",
      usuario: {
        nombre: "",
        apellido: "",
        usuario: "",
      },
      headers: [
        {
          text: "Código",
          align: "start",

          value: "id",
          class: "primary white--text",
        },
        // {
        //   text: "Local",
        //   align: "start",

        //   value: "sucursal",
        //   class: "primary white--text",
        // },
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
          text: "orden de Trans.",
          value: "transaccion",
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
      /***GRID ESTACIONES */
      searchEstaciones: "",

      /**chart dia */

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
    };
  },
  mounted() {
    //  setInterval(  this.GenerarVentasDiariasFecha(), 8000);
    // this.GenerarTotalVentas();
    let that = this;
    this.generar();
    this.GetSucursal();

    //this.GenerarToken();
  },
  methods: {
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
      this.dialogSeguimiento = true;
      console.log("consola_item", item);
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
    objectFindByKey(array, key, value) {
      for (var i = 0; i < array.length; i++) {
        if (array[i][key] === value) {
          return array[i];
        }
      }
      return null;
    },
  },
};
</script>
 
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
            Selecciona el local de tu preferencia
          </v-card-title>
          <v-card-title primary-title class="justify-center">
            <v-chip-group
              active-class="red--text"
              v-model="registrar.id_sucursal"
              column
            >
              <v-chip
                v-for="icon in icons"
                :key="icon.red_social_id"
                :value="icon.red_social_id"
                @click="GenerarMesas(icon)"
              >
                {{ icon.descripcion }}
              </v-chip>
            </v-chip-group>
          </v-card-title>

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
    <v-row
      class="bgimagen"
      align="center"
      justify="center"
      v-if="vshow2 === true"
    >
      <v-col cols="12" sm="6" align="center" justify="center">
        <v-card
          color="rgb(220, 222, 225,0.7)"
          rounded="xl"
          elevation="15"
          class="text-md-center"
        >
          <v-card-title primary-title class="justify-center">
            Elige Cantidad de personas
          </v-card-title>
          <v-card-title primary-title class="justify-center">
            <v-slider
              v-model="registrar.numero_persona"
              :rules="rules.age"
              color="green"
              label="Nº Personas"
              hint="Elige Cantidad"
              min="0"
              max="50"
              thumb-label
            ></v-slider>
            <!-- <v-chip-group
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
            </v-chip-group> -->
          </v-card-title>
          <v-card-title primary-title class="justify-center">
            Seleccione el ambiente
          </v-card-title>
          <v-card-text primary-title class="justify-center">
            <v-row align="center" justify="center">
              <v-chip-group
                active-class="red--text"
                v-model="registrar.id_mesa"
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
          <v-card-text>
            <v-text-field
              outlined
              rounded
              v-model="form.comentario"
              name="name"
              label="¿Tienes alguna alergia o restricción que debamos saber?"
              multi-line
            ></v-text-field>
          </v-card-text>

          <v-card-actions class="justify-center">
            <v-btn color="success" @click="backPrimerLayaout()">Atras</v-btn>
            <v-btn color="success" @click="SetSegundoLayaout">Siguiente</v-btn>
          </v-card-actions>
        </v-card>
        <!-- <span
          >Para reservas mayores a 10 personas, por favor contáctarse al número
          xxxxxxxxxx.</span
        > -->
      </v-col>
    </v-row>
    <!-- fecha y hora -->
    <v-row
      class="bgimagen_dos"
      align="center"
      justify="center"
      v-if="vshow3 === true"
    >
      <v-col cols="12" sm="6" align="center" justify="center">
        <v-card
          color="rgb(220, 222, 225,0.7)"
          rounded="xl"
          elevation="15"
          class="text-md-center"
        >
          <v-card-title primary-title class="justify-center">
            Seleccione Fecha y Hora
          </v-card-title>

          <v-card-text primary-title class="justify-center">
            <v-container>
              <v-row align="center" justify="center" color="transparent">
                <v-date-picker
                  date
                  v-model="registrar.fecha_reserva"
                  :min="new Date().toISOString().substr(0, 10)"
                  @click:date="GetHoraFecha()"
                >
                </v-date-picker>
              </v-row>
              <v-row align="center" justify="center">
                <v-chip-group active-class="black--text" column>
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

          <v-card-actions class="justify-center">
            <v-btn color="success" @click="backSegundoLayaout()">Atras</v-btn>
            <v-btn color="success" @click="SetTercerLayaoutDatos()"
              >Siguiente</v-btn
            >
          </v-card-actions>
        </v-card>
        <!-- <span
          >Para reservas mayores a 10 personas, por favor contáctarse al número
          xxxxxxxxxx.</span
        > -->
      </v-col>
    </v-row>
<!-- datos personales -->
    <v-row
      class="bgimagen"
      align="center"
      justify="center"
      v-if="vshow4 === true"
    >
      <v-col cols="12" sm="6" align="center" justify="center">
        <v-card
          color="rgb(220, 222, 225,0.7)"
          rounded="xl"
          elevation="15"
          class="text-md-center"
        >
          <v-card-title primary-title class="justify-center">
            Datos Personales
          </v-card-title>

          <v-card-text>
            <v-container>
              <v-row>
                <v-col>
                  <vue-tel-input-vuetify
                    outlined
                    rounded
                    :valid-characters-only="true"
                    select-label="Code"
                    @input="onInput"
                    :require="true"
                    :error-messages="nameRulesTelefono"
                    :preferred-countries="['ec', 'gb', 'ua', 'us']"
                    v-model="form.celular"
                  ></vue-tel-input-vuetify>
                </v-col>
                <v-col>
                  <v-text-field
                    outlined
                    rounded
                    v-model="form.cedula"
                    :counter="10"
                    :rules="nameRulesCedula"
                    label="Cedula"
                    required
                    @keydown="GetCliente(form.cedula)"
                  ></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <v-text-field
                    outlined
                    rounded
                    v-model="form.nombres"
                    :counter="25"
                    :rules="nameRules"
                    label="Nombres"
                    required
                  ></v-text-field>
                </v-col>
                <v-col>
                  <v-text-field
                    outlined
                    rounded
                    v-model="form.apellidos"
                    :counter="25"
                    :rules="nameRules"
                    label="Apellidos"
                    required
                  ></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <v-text-field
                    outlined
                    rounded
                    v-model="form.correo_electronico"
                    :rules="emailRules"
                    label="Correo"
                    required
                  ></v-text-field>
                </v-col>
              </v-row>
              <!-- <v-row>
                    <v-col>
                      <v-text-field
                      outlined
                         rounded
                        v-model="form.comentario"
                        :counter="25"
                        :rules="nameRules"
                        label="Comentario"
                        required
                      ></v-text-field>
                    </v-col>
                  </v-row> -->
            </v-container>
          </v-card-text>

          <v-card-actions class="justify-center">
            <v-btn color="success" @click="backTercerLayaout()">Atras</v-btn>

            <v-btn
              class="ma-2"
              :loading="loading"
              :disabled="loading"
              color="primary"
              @click="SetCliente()"
            >
              Siguiente
              <template v-slot:loader>
                <span class="custom-loader">
                  <v-icon light>mdi-cached</v-icon>
                </span>
              </template>
            </v-btn>
          </v-card-actions>
        </v-card>
        <!-- <span
          >Para reservas mayores a 10 personas, por favor contáctarse al número
          xxxxxxxxxx.</span
        > -->
      </v-col>
    </v-row>
<!-- datos tarjeta -->
    <v-row
      class="bgimagen"
      align="center"
      justify="center"
      v-if="vshow5 === true"
    >
      <v-col cols="12" sm="6" align="center" justify="center"   v-if="registrar.numero_persona >10">
        <v-card
          color="rgb(220, 222, 225,0.7)"
          rounded="xl"
          elevation="15"
          class="text-md-center"
        
        >
        <v-card-text background-color="success">
            <v-container>
              <v-row>
                <v-col>
                  <span class="letraSpam"><b> Reserva en : </b> </span>
                  <span class="letraSpam"
                    >{{ registrar.des_local }} - Mesa:
                    {{ registrar.des_mesa }}</span
                  >
                </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <span class="letraSpam"><b>Hora de Reserva: </b></span>
                  <span class="letraSpam">{{ registrar.hora_reserva }} </span>
                </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <span class="letraSpam"><b>Fecha de Reserva: </b></span>
                  <span class="letraSpam">{{ registrar.fecha_reserva }} </span>
                </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <span class="letraSpam"><b>Nombre de la reserva</b> </span>
                  <span class="letraSpam">{{ form.nombres }} {{ form.apellidos }} </span>
                </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <span class="letraSpam"><b>Cantidad de Persona </b></span>
                  <span class="letraSpam">{{ registrar.numero_persona }} </span>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-title primary-title class="justify-center">
            Datos de la tarjeta
          </v-card-title>

          <v-card-text>
            <form  :action="'/modulos/admision/reservas/SetEstado'" data-brands="VISA MASTER" class="paymentWidgets"
     >
      </form>
          </v-card-text>

          <v-card-actions class="justify-center">
            <v-btn color="success" @click="backQuintoLayaout()">Atras</v-btn>

            <v-btn
              class="ma-2"
              :loading="loading"
              :disabled="loading"
              color="primary"
              @click="SetquintoLayaoutDatos()"
            >
              Siguiente
              <template v-slot:loader>
                <span class="custom-loader">
                  <v-icon light>mdi-cached</v-icon>
                </span>
              </template>
            </v-btn>
          </v-card-actions>
          <div class="footer">
              <p>Footer</p>
            </div>
        </v-card>
        <!-- <span
          >Para reservas mayores a 10 personas, por favor contáctarse al número
          xxxxxxxxxx.</span
        > -->
      </v-col>
      <!-- v-else -->
      <v-col cols="12" sm="6" align="center" justify="center" v-else>
        <v-card
          color="rgb(220, 222, 225,0.7)"
          rounded="xl"
          elevation="15"
          class="text-md-center"
        >
          <v-card-title primary-title class="justify-center">
            Datos de la tarjeta
          </v-card-title>

          <v-card-text>
          <h4>Estamos Proximo a Terminar, presione siguiente</h4>  
          </v-card-text>

          <v-card-actions class="justify-center">
            <v-btn color="success" @click="backQuintoLayaout()">Atras</v-btn>

            <v-btn
              class="ma-2"
              :loading="loading"
              :disabled="loading"
              color="primary"
              @click="SetquintoLayaoutDatos()"
            >
              Siguiente
              <template v-slot:loader>
                <span class="custom-loader">
                  <v-icon light>mdi-cached</v-icon>
                </span>
              </template>
            </v-btn>
          </v-card-actions>
        </v-card>
        <!-- <span
          >Para reservas mayores a 10 personas, por favor contáctarse al número
          xxxxxxxxxx.</span
        > -->
      </v-col>
    </v-row>
      <!-- Generar Reserva -->
    <v-row
      class="bgimagen_tres"
      align="center"
      justify="center"
      v-if="vshow6 === true"
    >
      <v-col cols="12" sm="6">
        <v-card
          color="rgb(220, 222, 225,0.8)"
          rounded="xl"
          elevation="15"
          class="text-sm-center"
        >
          <v-card-text background-color="success">
            <v-container>
              <v-row>
                <v-col>
                  <span class="letraSpam"><b> Reserva en : </b> </span>
                  <span class="letraSpam"
                    >{{ registrar.des_local }} - Mesa:
                    {{ registrar.des_mesa }}</span
                  >
                </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <span class="letraSpam"><b>Hora de Reserva: </b></span>
                  <span class="letraSpam">{{ registrar.hora_reserva }} </span>
                </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <span class="letraSpam"><b>Fecha de Reserva: </b></span>
                  <span class="letraSpam">{{ registrar.fecha_reserva }} </span>
                </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <span class="letraSpam"><b>Nombre de la reserva</b> </span>
                  <span class="letraSpam">{{ form.nombres }} {{ form.apellidos }} </span>
                </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <span class="letraSpam"><b>Cantidad de Persona </b></span>
                  <span class="letraSpam">{{ registrar.numero_persona }} </span>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-text>
            <v-container>
              <v-row align="center" justify="center">
                <v-col cols="6">
                  <v-checkbox v-model="registrar.terminoCheck" color="green">
                    <template v-slot:label>
                      <div @click.stop="" align="center" justify="center">
                        Acepta
                        <a href="#" @click.prevent="registrar.terminos = true"
                          >términos</a
                        >
                        y condiciones.
                      </div>
                    </template>
                  </v-checkbox>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions class="justify-center">
            <v-btn class="ma-2" color="primary" @click="PostGrabar()">
              Agendar
              <template v-slot:loader>
                <span class="custom-loader">
                  <v-icon light>mdi-cached</v-icon>
                </span>
              </template>
            </v-btn>
          </v-card-actions>
          <v-dialog v-model="registrar.terminos" width="40%">
            <v-card>
              <v-card-title class="text-h6">   Términos y condiciones </v-card-title>
              <v-card-text>
               
                <ul>
                  <li>
                    Consentimiento para recibir comunicaciones de Pizza Libre
                  </li>
                  <li>
                    Debe de estar el 70 % de las personas para las cuales se
                    solicita la reserva para poder pasar a la mesa
                  </li>
                  <li>Solo podría reservarse el 50 % del local</li>
                  <li>
                    El tiempo de espera es de 10 minutos para mantener la
                    reserva
                  </li>
                  <li>El abono es consumible no reembolsable</li>
                </ul>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn text color="purple" @click="registrar.terminos = false">
                  Ok
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-card>
        <span
          >Para reservas mayores a 10 personas, por favor contáctarse al número
          xxxxxxxxxx.</span
        >
      </v-col>
    </v-row>
  </div>
</template>
<script>
import { forEach } from "lodash";
import { prefix, url } from "../../../variables";
import { forIn } from "lodash";
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
      Lista:{
        amount:0,
        
      },
      ListaId:"",
      
    };
  },
  mounted() {
    //this.GenerarHoras();
    this.GetSucursal();
    // this.GetHoraFecha();
  },
  computed: {
    //   player() {
    //     return this.$refs.videoPlayer.player
    //   }
  },
  methods: {
    onBeforeSubmitCard:function(){
            if ($(".wpwl-control-cardHolder").val() === "") {
                $(".wpwl-control-cardHolder").addClass("wpwl-has-error");
                $(".wpwl-control-cardHolder").after("<div class='wpwl-hint-cardHolderError'>Campo requerido</div>");
                $(".wpwl-button-pay").addClass("wpwl-button-error").attr("disabled","disabled");
                return false;
            }else{
                return true;
            }
        },
      submit() {
     
      let url =
        this.$store.getters.getRuta +
        "/modulos/admision/reservas/SetEstado";

      axios
        .post(url, ListaEnviar)
        .then((response) => {
         
          console.log("crearpago",response.data.data );
          // ListaActual.push(response.data.data);
          this.ListaId = response.data.data.id;
          console.log("crearpagoid", this.ListaId );
          let recaptchaScript = document.createElement('script');
      recaptchaScript.setAttribute('src', 'https://test.oppwa.com/v1/paymentWidgets.js?checkoutId='+this.ListaId )
      document.head.appendChild(recaptchaScript);
     // console.log("crearpago",response.data.data );
          // response.data.data.forEach((element) => {
          //   let objeto = {};
          //   objeto.horthisa_reserva = element.hora_reserva;
          //   ListaActual.push(objeto);
          // });
        

        })
        .catch((error) => {

          console.log("erorores",error);
        });
    },
    SetCrearPago(){
     
      this.Lista.amount = 100;
      let ListaEnviar = {
        amount:100,
      }
      let url =
        this.$store.getters.getRuta +
        "/modulos/admision/reservas/SetGenerarPago";

      axios
        .post(url, ListaEnviar)
        .then((response) => {
         
          console.log("crearpago",response.data.data );
          // ListaActual.push(response.data.data);
          this.ListaId = response.data.data.id;
          console.log("crearpagoid", this.ListaId );
          let recaptchaScript = document.createElement('script');
      recaptchaScript.setAttribute('src', 'https://test.oppwa.com/v1/paymentWidgets.js?checkoutId='+this.ListaId )
      document.head.appendChild(recaptchaScript);
     // console.log("crearpago",response.data.data );
          // response.data.data.forEach((element) => {
          //   let objeto = {};
          //   objeto.horthisa_reserva = element.hora_reserva;
          //   ListaActual.push(objeto);
          // });
          var div = document.createElement("div");
div.style.width = "500px";
    div.style.height0 = "500px";
    div.style.background = "red";
    div.style.color = "white";
    div.innerHTML = "HELLO";
    div.classList.add("paymentWidgets")

    document.body.appendChild(div);
    this.registrar.transaccion = this.ListaId;
    this.PostGrabar();

        })
        .catch((error) => {

          console.log("erorores",error);
        });
    },
    onCardClick(n) {
      this.registrar.id_mesa = n.red_social_id;
      this.registrar.des_mesa = n.descripcion;
    },
    GetCliente(cedula) {


      if (cedula.length <=9) {
        return;
      }
     
      let url =
        this.$store.getters.getRuta +
        "/modulos/admision/reservas/GetCliente/" +
        cedula;
      this.Lista_llenar = [];
      axios
        .get(url)
        .then((response) => {
          this.form.apellidos = response.data.data.apellidos;
          this.form.nombres = response.data.data.nombres;
          this.form.correo_electronico = response.data.data.correo;
          
        })
        .catch((error) => {
          console.log("aqui", error);
        });
    },

    onInput(formattedNumber, { number, valid, country }) {
      this.phone.number = number.international;
      this.phone.valid = valid;
      this.phone.country = country && country.name;

      if (!this.phone.valid) {
        this.nameRulesTelefono.push("Error al Validar numero");
      } else {
        this.nameRulesTelefono = [];
        this.form.celular = this.phone.number;
      }
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
    GetValidarHora(id) {
      
      this.registrar.hora_reserva = id.hora;
     
      this.registrar.hora_estado = id.estado;
    },
    SetPrimerLayaout() {
      if (
        this.registrar.id_sucursal == null ||
        this.registrar.id_sucursal == 0
      ) {
        this.mensajeAler("Debe Seleccionar local", false);
        return;
      }

      this.vshow1 = false;
      this.vshow2 = true;
    },
    backPrimerLayaout() {
      this.vshow1 = true;
      this.vshow2 = false;
      this.vshow3 = false;
      this.vshow4 = false;
      this.vshow5 = false;
      this.vshow6 = false;
    },
    backSegundoLayaout() {
      this.vshow1 = false;
      this.vshow2 = true;
      this.vshow3 = false;
      this.vshow4 = false;
      this.vshow5 = false;
      this.vshow6 = false;
      this.ListHora = [];
    },
    backTercerLayaout() {
      this.vshow1 = false;
      this.vshow2 = false;
      this.vshow3 = true;
      this.vshow4 = false;
      this.vshow5 = false;
      this.vshow6 = false;
    },
    backCuartoLayaout() {
      this.vshow1 = false;
      this.vshow2 = false;
      this.vshow3 = false;
      this.vshow4 = true;
      this.vshow5 = false;
      this.vshow6 = false;
    },
    backQuintoLayaout() {
      this.vshow1 = false;
      this.vshow2 = false;
      this.vshow3 = false;
      this.vshow4 = true;
      this.vshow5 = false;
      this.vshow6 = false;
    },
    // SetSegundoLayaout() {
    //   this.vshow1 = false;
    //   this.vshow2 = false;
    //   this.vshow3 = true;
    // },
    SetSegundoLayaout() {
      if (
        this.registrar.numero_persona == null ||
        this.registrar.numero_persona == 0
      ) {
        this.mensajeAler("Debe Seleccionar el número de persona", false);
        return;
      }

      if (this.registrar.id_mesa == null || this.registrar.id_mesa == 0) {
        this.mensajeAler("Debe Seleccionar el ambiente", false);
        return;
      }
      this.vshow1 = false;
      this.vshow2 = false;
      this.vshow3 = true;
    },
    SetTercerLayaoutDatos() {
      if (this.registrar.hora_estado == 1) {
        this.mensajeAler("Esta hora no esta disponible", false);
        return;
      }
      if (
        this.registrar.hora_reserva == 0 ||
        this.registrar.hora_reserva == "" ||
        this.registrar.hora_reserva == null
      ) {
        this.mensajeAler("Debe Seleccionar Hora de reserva", false);
        return;
      }
      this.vshow1 = false;
      this.vshow2 = false;
      this.vshow3 = false;
      this.vshow4 = true;
    },

    SetquintoLayaoutDatos() {
      this.vshow1 = false;
      this.vshow2 = false;
      this.vshow3 = false;
      this.vshow4 = false;
      this.vshow5 = false;
      this.vshow6 = true;
    },
    SetSiguienteLocales() {
      if (
        this.registrar.numero_persona == null ||
        this.registrar.numero_persona == 0
      ) {
        this.mensajeAler("Debe Seleccionar el numero de persona", false);
        return;
      }
      if (this.registrar.id_mesa == null || this.registrar.id_mesa == 0) {
        this.mensajeAler("Debe Seleccionar tipo de Mesa", false);
        return;
      }
      this.e1 = 2;
    },
    PostGrabar() {
      // if (this.registrar.terminoCheck == false) {
      //   this.mensajeAler("Debe Aceptar términos y condiciones", false);
      //   return;
      // }
     // this.e1 = 5;

      let url =
        this.$store.getters.getRuta +
        "/modulos/admision/reservas/PostValidarUsuario";
      this.Lista_llenar = [];
      axios
        .post(url, this.registrar)
        .then((response) => {
         

          //window.location.replace("/");
          this.mensajeAler(true, true);
        })
        .catch((error) => {
          this.mensajeAler(true, true);
          // console.log("aqui", error);
          // window.location.replace("/");

          this.loading = false;
          this.loader = null;
        });
    },
    SetCliente() {
      //  return
      this.loading = true;

      this.loader = "loading";

      if (this.isValidCI(this.form.cedula)) {
        let url =
          this.$store.getters.getRuta +
          "/modulos/admision/reservas/PostValidarUsuarioCliente";

        axios
          .post(url, this.form)
          .then((response) => {
            if (response.data.data) {
              this.mensajeAler(true, true);
            } else {
              this.mensajeAler(false, true);
            }
            this.registrar.id_cliente_reserva = response.data.id;
            this.registrar.celular = this.form.celular;
            this.registrar.descripcion = this.form.comentario;

            this.vshow1 = false;
            this.vshow2 = false;
            this.vshow3 = false;
            this.vshow4 = false;
            this.vshow5 = true;

            this.SetCrearPago();
          })
          .catch((error) => {
            let objeto = [];
            objeto = Object.values(error.response.data.errors);
            //   console.log(objeto);
            //   console.log(objeto.length);

            for (let index = 0; index < objeto.length; index++) {
              // const element = array[index];
              // console.log(objeto.[index][0]);
              this.mensajeAler(objeto[index][0], false);
            }
            this.loading = false;
            this.loader = null;
          });
      } else {
        this.loading = false;
        this.loader = null;
      }
      this.loading = false;
      this.loader = null;
    },
    GenerarModal(value) {
      this.dialog = true;
    },

    GenerarMesas(id) {
      this.registrar.numero_persona = "";
      this.registrar.id_mesa = "";

      this.registrar.des_local = id.descripcion;
      this.registrar.id_sucursal = id.red_social_id;
      let url =
        this.$store.getters.getRuta +
        "/modulos/admision/reservas/GetMesasPorSucursal/" +
        id.red_social_id;
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

    objectFindByKey(array, key, value) {
      for (var i = 0; i < array.length; i++) {
        if (array[i][key] === value) {
          return array[i];
        }
      }
      return null;
    },

    isValidCI(ci) {
      var isNumeric = true;
      var total = 0,
        individual;

      for (var position = 0; position < 10; position++) {
        // Obtiene cada posición del número de cédula
        // Se convierte a string en caso de que 'ci' sea un valor numérico
        individual = ci.toString().substring(position, position + 1);

        if (isNaN(individual)) {
          console.log(ci, position, individual, isNaN(individual));
          isNumeric = false;
          break;
        } else {
          // Si la posición es menor a 9
          if (position < 9) {
            // Si la posición es par, osea 0, 2, 4, 6, 8.
            if (position % 2 == 0) {
              // Si el número individual de la cédula es mayor a 5
              if (parseInt(individual) * 2 > 9) {
                // Se duplica el valor, se obtiene la parte decimal y se aumenta uno
                // y se lo suma al total
                total += 1 + ((parseInt(individual) * 2) % 10);
              } else {
                // Si el número individual de la cédula es menor que 5 solo se lo duplica
                // y se lo suma al total
                total += parseInt(individual) * 2;
              }
              // Si la posición es impar (1, 3, 5, 7)
            } else {
              // Se suma el número individual de la cédula al total
              total += parseInt(individual);
            }
          }
        }
      }

      if (total % 10 != 0) {
        total = total - (total % 10) + 10 - total;
      } else {
        total = 0;
      }

      if (isNumeric) {
        // El total debe ser igual al último número de la cédula
        console.log(ci, total, individual);
        console.log(ci, typeof ci, ci.length);
        // La cédula debe contener al menos 10 dígitos
        if (ci.toString().length != 10) {
          this.mensajeAler(
            "La cedula ingresada debe ser de 10 digitos.",
            false
          );

          return false;
        }

        // El número de cédula no debe ser cero
        if (parseInt(ci, 10) == 0) {
          this.mensajeAler("La cedula ingresada no puede ser cero.", false);

          return false;
        }

        // El total debe ser igual al último número de la cédula
        if (total != parseInt(individual)) {
          this.mensajeAler("La cedula ingresada no es valida.", false);
          // alert("La c\u00E9dula ingresada no es v\u00E1lida.");
          return false;
        }

        console.log("cédula válida", ci);
        return true;
      }

      // Si no es un número

      this.mensajeAler("El dato solo puede contener numeros.", false);
      return false;
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
 .footer {
  
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: rgb(221, 219, 219);
  color: rgb(14, 12, 12);
  text-align: center;
}
</style>
 
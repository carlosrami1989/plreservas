<template>
  <div>
    <v-divider></v-divider>

    <v-row>
      <v-col cols="12">
        <v-card outlined tile elevation="8" :loader-height="5" :loading="true" class="rounded-lg">
          <v-system-bar color="indigo darken-2" dark class="white--text">
            Complemento de la Información</v-system-bar>
          <v-card-text>
           
            <v-row>


              <v-col cols="12" sm="3">

                <v-text-field label="Numero Orden" hide-details="auto"></v-text-field>

              </v-col>
              <v-col cols="12" sm="3">

                <v-text-field label="Numero Guia" hide-details="auto"></v-text-field>
              </v-col>
              <v-col cols="12" sm="3">
                <br>
                <label for="">Fecha inicio</label>
                <input type="date">


              </v-col>
              <v-col cols="12" sm="3">
                <br>
                <label for="">Fecha fin</label>
                <input type="date">


              </v-col>
            </v-row>




            <br>
            <!-- <v-btn color="success" @click="GenerarExcel()" >Cargar Archivo</v-btn> -->
            <v-btn class="ma-2" :loading="loadingbutton" :disabled="loadingbutton" color="success"
              @click="consultasOrden()">
              Generar Busqueda
              <template v-slot:loader>
                <span class="custom-loader">
                  <v-icon light>mdi-cached</v-icon>
                </span>
              </template>
            </v-btn>
          </v-card-text>
          <br>

        </v-card>
      </v-col>
    </v-row>
    <v-row no-gutters>

      <v-col cols="12" sm="12" class="pa-1">
        <v-card :loader-height="5" :loading="loading" outlined tile elevation="8" class="rounded-lg">
          <v-system-bar color="indigo darken-2" dark class="white--text">GASTOS POR ESTACION</v-system-bar>
           
          <v-card-title>
            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line
              hide-details></v-text-field>
          </v-card-title>
          <v-data-table :headers="headers" :items="ListaGastos" :search="search" class="elevation-1">
            <template v-slot:item.id="{ item }">
              <v-chip color="red" dark v-if="item.estado_upload == 'LIQ'">
                {{ item.orden }}
              </v-chip>
              <v-chip color="green" dark v-else>
                {{ item.orden }}
              </v-chip>
            </template>
              
            <template v-slot:item.actions="{ item }">
              <v-icon medium color="red" class="mr-2"  v-if="item.estado_upload == 'LIQ'"
                
                >
               mdi-close-circle
              </v-icon>
              <v-icon medium color="primary" class="mr-2" v-else
               @click="
                GenerarModalSeguimientoVisulizar(
                  item
                )
                ">
               mdi-pencil
              </v-icon>
            </template>

          </v-data-table>
          <div style="width: auto; text-align: center"></div>
        </v-card>
      </v-col>

    </v-row>

    <!-- empieza el dialogo -->
    <v-row justify="center">
      <v-dialog v-model="dialogSeguimiento" persistent max-width="600px">
        <v-form ref="formSeguimiento">
          <v-card>
            <v-card-title>
              <span class="text-h5">Ingreso de Guias / Rutas</span>
            </v-card-title>
            <v-card-text>
              <v-chip
              class="ma-2"
              color="success"
              label
            >
             
            Orden:  {{ modelLista.orden }}
            </v-chip>

            <v-chip
              class="ma-2"
              color="orange"
              label
            >
              <v-icon left>
                mdi-account-circle-outline
              </v-icon>
             Cliente:{{ modelLista.cliente }}
            </v-chip>

            <v-chip
              class="ma-2"
              color="cyan"
              label
            >
              
            Estación:  {{ modelLista.estacion }}
            </v-chip>

            <v-chip
              class="ma-2"
              color="light-blue lighten-4"
              label
            >
              
            Producto:  {{ modelLista.producto }}
            </v-chip>
            <v-chip
              class="ma-2"
              color="primary"
              label
            >
             
             Volumen {{ modelLista.volumen }}
            </v-chip>
            </v-card-text>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12">
                    <v-text-field label="Guias" hint="Ingrese el numero de guia" 
                    type="number"  v-model="modelLista.guia" required></v-text-field>
                  </v-col>
                  <v-col cols="12"  >
                    <v-combobox append-outer-icon="mdi-filter" v-model="modelLista.id_estacion_w" 
                    :items="itemsEstacion"
                      :search-input.sync="searchEstacion" hide-selected item-text="descripcion" item-value="id"
                      label="Seleccione el destino"   persistent-hint small-chips>
                      <template v-slot:no-data>
                        <v-list-item>
                          <v-list-item-content>
                            <v-list-item-title>
                              No results matching "<strong>{{
                                searchEstacion
                              }}</strong>". Press <kbd>enter</kbd> to
                              create a new one
                            </v-list-item-title>
                          </v-list-item-content>
                        </v-list-item>
                      </template>
                    </v-combobox>
                  </v-col>
                  <v-col cols="12" sm="6">
                    <v-text-field label="Placa" hint="Ingrese el numero de Placa" 
                     v-model="modelLista.placa" required></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6">
                    <v-text-field label="Km" hint="Ingrese el Kilometraje" 
                      required v-model="modelLista.km"></v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6">
                    <v-text-field label="Galones" hint="Ingrese los galones" 
                    type="number" required v-model="modelLista.galones"></v-text-field>
                  </v-col>
                  
                  <v-col cols="12">
                    <v-text-field label="Observación" 
                    v-model="modelLista.observacion"
                    hint="Observación del Seguimiento"></v-text-field>
                  </v-col>
                 

                </v-row>
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
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="dialogSeguimiento = false">
                Cerrar
              </v-btn>
              <v-btn color="blue darken-1" text @click="UpdateComplemento()">
                Agregar Seguimiento
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-dialog>
    </v-row>
    <!-- fin del dialogo -->
  
  </div>
  <!-- aqui termina :v -->
</template>
<script>
import { prefix, url } from "../../../variables";

export default {
  props: {
    user: {
      type: Object,
    },
  },
  data() {
    return {
      snackbar: false,
            color:'purple darken-4',
            text: '',
            icono:"mdi-checkbox-marked",
      timeout: 4000,

      loadingbutton: false,
      rating1: 5,
      rating2: 4.5,
      Upload: null,
      search: '',
      loading: false,
      headers: [
        {
          text: 'Orden',

          value: 'id',

        },
        { text: 'Estado', value: 'estado_upload' },

        { text: 'Cliente', value: 'cliente' },
        { text: 'Estacion', value: 'estacion' },


        // { text: 'Fecha Emision', value: 'fecha_emision' },
        // { text: 'Fe. Venci', value: 'fecha_vencimiento' },
        // { text: 'Fe. Venta', value: 'fecha_venta' },
        { text: 'Volumen', value: 'volumen' },
        { text: 'Producto', value: 'producto' },

        { text: 'guia', value: 'orden_lis.guia' },
        { text: 'placa', value: 'orden_lis.placa' },
        { text: 'estacion_w', value: 'orden_lis.estacion_w' },
        // { text: 'estacion_w', value: 'orden_lis.estacion_w' },
        { text: 'Accion', value: 'actions' },


      ],
      ListaGastos: [],
      dialogSeguimiento: false,
      modelEstacion:null,
      itemsEstacion:[],
      searchEstacion:null,
      modelLista:{
        estado:null,
        cliente:null,
        estacion:null,
        orden:null,
        producto:null,
        volumen:null,
        codigo:null,
        cod_estacion:null,
        id_estacion_w:null,
        estacion_w:null,
        fecha_emision:null,
        fecha_vencimiento:null,
        fecha_venta:null,

        guia:null,
        nombre:null,
        placa:null,
        km:null,
        galones:null,
        observacion:null,

      },

    };
  },
  mounted() {
this.consultasEmpresas();
    // this.consultasTotales();
    // this.consultasDashboard();
    // this.totalesCirugia();
  },
  methods: {
    consultasEmpresas() {
            let that = this;
            let url =
                this.$store.getters.getRuta +
                "/modulos/admision/paciente/ConsultaEstaciones";

            axios
                .get(url)
                .then((response) => {
                    this.itemsEstacion = response.data.Resp;
                })
                .catch((error) => {
                    //Errores de validación
                });
        },
    GenerarModalSeguimientoVisulizar(item) {
      this.dialogSeguimiento = true;
      this.modelLista.orden =item.orden;
      this.modelLista.cliente =item.cliente;
      this.modelLista.estacion =item.estacion;
      this.modelLista.producto =item.producto;
      this.modelLista.volumen =item.volumen;

      this.modelLista.codigo =item.codigo;
      this.modelLista.cod_estacion =item.cod_estacion;
      this.modelLista.fecha_emision =item.fecha_emision;
      this.modelLista.fecha_vencimiento =item.fecha_vencimiento;
      this.modelLista.fecha_venta =item.fecha_venta;

      let that = this;
      // let url = "/modulos/admision/paciente/GetSeguimiento/" + item.id;

      // axios
      //   .get(url)
      //   .then((response) => {
      //     this.ListaTareasSeguimientoV =
      //       response.data.listasSeguimiento;
      //     this.dialogSeguimientoVisualizar = true;
      //   })
      //   .catch((error) => {
      //     //Errores de validación
      //   });
    },
    UpdateComplemento() {
      // console.log(value);

      let url =
        this.$store.getters.getRuta +
        "/modulos/transporte/transporte/UpdateOrden";
      let ListEstacionesRecorrer = [];
      this.ListEstaciones = [];
      axios
        .post(url,this.modelLista)
        .then((response) => {
        console.log("response",response.data);
          if (response.data.status  == 0) {
            this.mensajeAler(response.data.data,false);
          }
          if (response.data.status  == 1) {
            this.mensajeAler(response.data.data,false);
          }
          if (response.data.status  == 2) {
            this.Limpiar();
            this.mensajeAler(true,true);
            this.consultasOrden();
          }
       
    
         
        })
        .catch((error) => {
          //Errores de validación
          let objeto = [];
                    objeto = Object.values(error.response.data.errors);
                    console.log(objeto);

                    for (const iterator of objeto) {
                        console.log("iterator", iterator);
                        for (let key of iterator) {
                            this.mensajeAler(key, false);
                        }
                    }
        });
    },
    consultarExcel(value) {
      // console.log(value);

      window.open(
        this.$store.getters.getRuta +
        "/modulos/admision/paciente/generacionExcel"
      );
    },
    Limpiar(){
      this.dialogSeguimiento = false;
      this.modelLista.estado = null;
      this.modelLista.orden = null;
      this.modelLista.cliente = null;
      this.modelLista.estacion = null;
      this.modelLista.producto = null;
      this.modelLista.volumen = null;

      this.modelLista.codigo =null;
      this.modelLista.cod_estacion = null;
      this.modelLista.id_estacion_w = null;
      this.modelLista.estacion_w = null;
 
      this.modelLista.fecha_emision =     null;
      this.modelLista.fecha_vencimiento = null;
      this.modelLista.fecha_venta =null;

      this.modelLista.guia =     null;
      this.modelLista.nombre = null;
      this.modelLista.km =null;
      this.modelLista.galones =null;
      this.modelLista.observacion =null;
    },
    consultasOrden() {
      let that = this;
      this.ListaGastos = [];
      let url =
        this.$store.getters.getRuta +
        "/modulos/transporte/transporte/GetOrden/2022-01-01/2022-01-01/0/0";
      let ListEstacionesRecorrer = [];
      this.ListEstaciones = [];
      axios
        .get(url)
        .then((response) => {
          this.ListaGastos = response.data.data;

        })
        .catch((error) => {
          //Errores de validación
        });
    },
    GenerarExcel() {
      this.loadingbutton = true;
      let that = this;
      let url =
        this.$store.getters.getRuta +
        "/modulos/transporte/transporte/subir";
      //console.log("token", this.$store.getters.tokeGasquil);
      let formData = new FormData();

      formData.append('file', this.Upload);

      axios
        .post(url, formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
        .then((response) => {
          this.ListaGastos = response.data.data;
          console.log("_ListaDes", response.data.data);
          this.loadingbutton = false;

        })
        .catch((error) => {
          this.loadingbutton = false;
        });
    },
    mensajeAler(value,value2){
      if (value2) {
         if (value) {
            this.icono = "mdi-checkbox-marked"
            this.color = "green",
             this.snackbar = true;
            this.text = "Transacción realizada de manera exitosa";
          } else {
             this.icono = "mdi-close-box"
             this.color = "light-blue darken-4",
             this.snackbar = true;
             this.text = "Transacción actualizada de manera exitosa";
           
          }

         
            
          } else {
             this.icono = "mdi-close-box"
             this.color = "red darken-4",
             this.snackbar = true;
             this.text = "Error en el sistema " + value;
            
          }
      },

  },
};
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
.v-btn.outlined {
  position: relative;
  top: -40px;
  left: 0px;
}

td {
  font-size: 15px !important;
}

.custom-loader {
  animation: loader 1s infinite;
  display: flex;
}

@-moz-keyframes loader {
  from {
    transform: rotate(0);
  }

  to {
    transform: rotate(360deg);
  }
}

@-webkit-keyframes loader {
  from {
    transform: rotate(0);
  }

  to {
    transform: rotate(360deg);
  }
}

@-o-keyframes loader {
  from {
    transform: rotate(0);
  }

  to {
    transform: rotate(360deg);
  }
}

@keyframes loader {
  from {
    transform: rotate(0);
  }

  to {
    transform: rotate(360deg);
  }
}
</style>

 
</style>


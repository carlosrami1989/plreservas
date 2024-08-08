<template>
    <div>
        <v-divider></v-divider>
      
        <v-row>
            <v-col cols="12"   > 
            <v-card
                    outlined
                    tile
                    elevation="8"
                    :loader-height="5"
                    :loading="true"
                    class="rounded-lg"
                >
                    <v-system-bar
                        color="indigo darken-2"
                        dark
                        class="white--text"
                    >
                        Cargar Archivo</v-system-bar
                    >
                    <v-card-text>
                        <v-file-input
                  
                    accept="text/xls"
                    placeholder="Pick an avatar"
                    prepend-icon="mdi-file-excel-box"
                    color-="green"
                    label="Avatar"
                    v-model="Upload"
                ></v-file-input>
                <br>
                <!-- <v-btn color="success" @click="GenerarExcel()" >Cargar Archivo</v-btn> -->
                <v-btn
                    class="ma-2"
                    :loading="loadingbutton"
                    :disabled="loadingbutton"
                    color="info"
                    @click="GenerarExcel()"
                   
                    >
                    Cargar Información
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
    <v-card
        :loader-height="5"
        :loading="loading"
        outlined
        tile
        elevation="8"
        class="rounded-lg"
    >
        <v-system-bar
            color="indigo darken-2"
            dark
            class="white--text"
            >GASTOS POR ESTACION</v-system-bar
        >
        <v-card-title>
        <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
            
        ></v-text-field>
        </v-card-title>
        <v-data-table
        :headers="headers"
        :items="ListaGastos"
        :search="search"
        class="elevation-1"
        >
        <template v-slot:item.id="{ item }">
      <v-chip
        color="red"
        dark
        v-if="item.estado_existe == 1"
      >
        {{ item.orden }}
      </v-chip>
      <v-chip
        color="green"
        dark
        v-else
      >
        {{ item.orden }}
      </v-chip>
    </template>

</v-data-table>
        <div style="width: auto; text-align: center"></div>
    </v-card>
</v-col>

</v-row>
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
            loadingbutton:false,
            rating1: 5,
            rating2: 4.5,
            Upload:null,
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
            { text: 'codigo', value: 'codigo' },
            { text: 'codigo Estación', value: 'cod_estacion' },
            { text: 'Fecha Emision', value: 'fecha_emision' },
            { text: 'Fe. Venci', value: 'fecha_vencimiento' },
            { text: 'Fe. Venta', value: 'fecha_venta' },
            { text: 'Volumen', value: 'volumen' },
            { text: 'Producto', value: 'producto' },
            { text: 'Valor', value: 'valor' },
            { text: 'Factura', value: 'factura' },
            { text: 'Autorización', value: 'autorizacion' },
            { text: 'Fe. Aut.', value: 'fecha_autorizacion' },
            { text: 'Correo', value: 'correo' },
            { text: 'Identificacion', value: 'identificacion' },
            { text: 'existe', value: 'estado_existe' },
            ],
            ListaGastos:[],

           
        };
    },
    mounted() {
       
        // this.consultasTotales();
        // this.consultasDashboard();
        // this.totalesCirugia();
    },
    methods: {
        consultarExcel(value) {
            // console.log(value);

            window.open(
                this.$store.getters.getRuta +
                    "/modulos/admision/paciente/generacionExcel"
            );
        },

        GenerarExcel() {
          this.loadingbutton =true;
          let that = this;
          let url =
              this.$store.getters.getRuta +
              "/modulos/transporte/transporte/subir";
          //console.log("token", this.$store.getters.tokeGasquil);
           let formData = new FormData();
    
    formData.append('file', this.Upload);
          
          axios
              .post(url,formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
              .then((response) => {
                this.ListaGastos = response.data.data;
                  console.log("_ListaDes",response.data.data);
                  this.loadingbutton =false;
                   
              })
              .catch((error) => {
                this.loadingbutton =false;
              });
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


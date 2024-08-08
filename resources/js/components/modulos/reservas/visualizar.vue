<template>
    <div>
        <v-row no-gutters>
            <v-col cols="12" class="pa-1">
                <v-card outlined tile elevation="8" class="rounded-lg">
                    <v-system-bar color="indigo darken-2" dark class="white--text">Locales</v-system-bar>

                    dfdsfds
                </v-card>

            </v-col>
        </v-row>
        <v-row no-gutters>
            <v-col cols="12" sm="2" class="pa-1">

                <v-card outlined tile elevation="8" class="rounded-lg">
                    <v-system-bar color="indigo darken-2" dark class="white--text">AÑO</v-system-bar>

                    <v-chip-group active-class="success" column>
                        <v-chip v-for="tag in Listanio" :key="tag" @click="Consultaanio(tag)">
                            {{ tag }}
                        </v-chip>
                    </v-chip-group>
                </v-card>



            </v-col>

            <v-col cols="12" sm="10" class="pa-1">
                <v-card outlined tile elevation="8" class="rounded-lg">
                    <v-system-bar color="indigo darken-2" dark class="white--text">mes</v-system-bar>
                    <v-chip-group active-class="success" column>
                        <v-chip v-for="tag in Listames" :key="tag.id" @click="ConsultaMes(tag.id)">
                            {{ tag.mes }}
                        </v-chip>
                    </v-chip-group>
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
                    <v-data-table :headers="headers" :items="ListaGastos" :search="search" group-by="estacion" show-group-by
                        class="elevation-1"></v-data-table>
                    <div style="width: auto; text-align: center"></div>
                </v-card>
            </v-col>

        </v-row>

        <v-row no-gutters>

            <v-col cols="12" sm="12" class="pa-1">
                <v-card :loader-height="5" :loading="loading" outlined tile elevation="8" class="rounded-lg">
                    <v-system-bar color="indigo darken-2" dark class="white--text">CONSOLIDADO DE VENTAS POR
                        ESTACION</v-system-bar>
                    <v-card-title>
                         
                        <v-card-text>
                            <label>Seleccione Fecha :</label>
                            <input type="date" v-model="fecha_buscar" @change="consultasEstacionesPorDia">      
                          
                            <v-text-field v-model="searchEstaciones" append-icon="mdi-magnify" label="Search" single-line
                                hide-details></v-text-field>
                            <v-data-table :headers="CabeceraEstacione" :items="ListaConsolidadoEstaciones"
                                :search="searchEstaciones" :items-per-page="30">

                            </v-data-table>
                            <v-row dense
                        xl="4"
                        md="2">
                        <v-col >
                             <v-tooltip right>
                              <template v-slot:activator="{ on, attrs }">
                                <v-btn
                                  color="green"
                                  dark
                                  v-bind="attrs"
                                  v-on="on"
                                     @click="GenerarDocumentoExcel()"

                                 
                                >
                                   <v-icon>mdi-file-excel-box</v-icon>
                                </v-btn>
 
                              </template>
                              <span>Generar Excel</span>
                            </v-tooltip>
                               
                          </v-col>
                          
                        </v-row>
                        <br>
                            <v-divider></v-divider>
                             
                            <canvas id="EstacionesPorDia" height="120px" width="auto"></canvas>
                        </v-card-text>

                    </v-card-title>

                    <div style="width: auto; text-align: center"></div>
                </v-card>
            </v-col>

        </v-row>
        <v-snackbar v-model="snackbar" :timeout="timeout" absolute top :color="color">
            <v-icon>{{ icono }}</v-icon>
            {{ text }}

        </v-snackbar>
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
            snackbar: false,
            color: 'purple darken-4',
            text: '',
            icono: "mdi-checkbox-marked",
            timeout: 4000,
            EstacionItem: "",
            mesItem: "",
            diaItem: "",
            diaActual: "",
            anioItem: "",
            justify: [
                "start",
                "center",
                "end",
                "space-around",
                "space-between",
            ],
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
            fecha_buscar: new Date().toISOString().slice(0,10),
            ruta: "",
            ListaManguera: [
                {
                    cod_manguera: 1,
                    des_manguera: "diesel",
                    src: "/img/diesel.png",
                },
                {
                    cod_manguera: 2,
                    des_manguera: "super",
                    src: "/img/super.png",
                },
                { cod_manguera: 3, des_manguera: "eco", src: "/img/eco.png" },
                {
                    cod_manguera: 4,
                    des_manguera: "eco Plus",
                    src: "/img/ecoplus.png",
                },
                {
                    cod_manguera: 2,
                    des_manguera: "super",
                    src: "/img/super.png",
                },
                { cod_manguera: 5, des_manguera: "eco", src: "/img/eco.png" },
                { cod_manguera: 6, des_manguera: "eco", src: "/img/eco.png" },
                {
                    cod_manguera: 4,
                    des_manguera: "eco Plus",
                    src: "/img/ecoplus.png",
                },
            ],

            //dolares
            ProductoMes: [],
            GalonesTotalMes: [],
            MontoTotalMes: [],
            //fin

            //ventasdiariasFechaApertura
            IndiceVentas: [],
            GalonesEcoDiariaApertura: [],
            GalonesDieselDiariaApertura: [],
            GalonesSuperDiariaApertura: [],
            GalonesEcoPlusDiariaApertura: [],

            MontoEcoDiariaApertura: [],
            MontoDieselDiariaApertura: [],
            MontoSuperDiariaApertura: [],
            MontoEcoPlusDiariaApertura: [],

            GalonesDiariaApertura: [],
            MontoTotalMesDiariaApertura: [],
            chartDiariaApertura: null,
            chartDiariaFechaApertura: null,
            vardatosFechaApertMonto: null,

            //fin

            //fin

            //ventasdiariasFechaAperturaMes
            IndiceVentasMes: [],
            GalonesEcoDiariaAperturaMes: [],
            GalonesDieselDiariaAperturaMes: [],
            GalonesSuperDiariaAperturaMes: [],
            GalonesEcoPlusDiariaAperturaMes: [],

            MontoEcoDiariaAperturaMes: [],
            MontoDieselDiariaAperturaMes: [],
            MontoSuperDiariaAperturaMes: [],
            MontoEcoPlusDiariaAperturaMes: [],
 

            //fin
            indice: [],
            valores: [],

            DescripcionTotalMes: [],

            chartGalonesMes: null,
            loading: false,
            sliderTimer: null,
            search: '',
            headers: [
                {
                    text: 'Estación',
                    align: 'start',

                    value: 'estacion',
                    class: "primary white--text"

                },
                { text: 'Nombre Cuenta', value: 'pc_nomcta', class: "indigo darken-2 white--text" },
                { text: 'Concepto', value: 'cc_concepto', class: "indigo darken-2 white--text" },
                { text: 'Fecha', value: 'cc_fecha', class: "indigo darken-2 white--text" },
                { text: 'Glosa', value: 'dc_glosa', class: "indigo darken-2 white--text" },
                { text: 'Valor Debe', value: 'dc_valdeb', class: "indigo darken-2 white--text" },
                { text: 'Valor Haber', value: 'dc_valhab', class: "indigo darken-2 white--text" },
            ],
            ListaGastos: [],
            /***GRID ESTACIONES */
            searchEstaciones: '',
            CabeceraEstacione: [
                {
                    text: 'Estación',
                    align: 'start',

                    value: 'des_estacion',
                    class: "indigo darken-2 white--text"

                },
                { text: 'Fecha', value: 'dia', class: "indigo darken-2 white--text " },
                { text: 'Monto Dolares', value: 'total_dolares', class: "indigo darken-2 white--text" },
                { text: 'Galones', value: 'galones', class: "indigo darken-2 white--text" },

            ],
            ListaConsolidadoEstaciones: [],
            /**chart dia */
            IndiceVentasEstaciones: [],
            GalonesDiariaApertura: [],
            MontoTotalMesDiariaApertura: [],
            chartDiarioApertura: null,
        };
    },
    mounted() {
      
      
        //  setInterval(  this.GenerarVentasDiariasFecha(), 8000);
        // this.GenerarTotalVentas();
        let that = this;
        this.consultasEstaciones();
       this.consultasEstacionesPorDia();
        this.sliderTimer= setInterval(function () {
          //  console.log("hola");
         
           that.totalesEstacionDia();
    }, 4000);
        //this.GenerarToken();
    },
    methods: {
        generar() {
            if ( this.$store.state.usuario == null) {
                
            }

        },
        GenerarDocumentoExcel(){
            
            let that = this;
          
            let form = {
                fecha:this.fecha_buscar
            }
            let url =
              this.$store.getters.getRuta +
              "/modulos/admision/paciente/generacionExcelEstacion";
              axios.post(url,form, {responseType: 'blob'},
             ).then(response => {
    
                  //console.log(response.data);
                  
                  const url = window.URL.createObjectURL(new Blob([response.data]));
                  const link = document.createElement('a');
                  link.href = url;
                  link.setAttribute('download', 'Reporte_de_registros'+ this.fecha_buscar+ '.xls'); //or any other extension
                  document.body.appendChild(link);
                  link.click();
    
                })
                .catch(error => {
                  console.log(error);
                });
            
             
          },
        consultasEstacionesPorDia() {
          
            let that = this;
            let url =
                this.$store.getters.getRuta +
                "/modulos/admision/paciente/GetEstacionPorDia/"+ this.fecha_buscar;
            let ListaConsolidado = [];
            this.ListEstaciones = [];
            this.ListaConsolidadoEstaciones = [];
            this.IndiceVentasEstaciones = [];
            this.GalonesDiariaApertura = [];
            this.MontoTotalMesDiariaApertura = [];
            if (this.chartDiarioApertura != null) {
                this.chartDiarioApertura.clear();
                this.chartDiarioApertura.destroy();   
            }
            axios
                .get(url)
                .then((response) => {

                    this.ListaConsolidadoEstaciones = response.data.Resp;
                   
                    //  that.valor = response.data.data;
                    let objeto = {};
                    for (let index = 0; index < this.ListaConsolidadoEstaciones.length; index++) {
                        //const element = array[index];
                       // console.log("for",this.MontoTotalMes);
                      // console.log("consolidado", this.ListaConsolidadoEstaciones[index].des_estacion);
                        objeto.estacion =  this.ListaConsolidadoEstaciones[index].des_estacion;
                        this.IndiceVentasEstaciones.push(objeto.estacion);
                        objeto.galones_dia = this.ListaConsolidadoEstaciones[index].galones;
                        this.GalonesDiariaApertura.push(objeto.galones_dia);
                        objeto.monto_dia = this.ListaConsolidadoEstaciones[index].total_dolares;
                        this.MontoTotalMesDiariaApertura.push(objeto.monto_dia);
                    }

                    //  console.log("TOTALES", this.IndiceVentasEstaciones);
                    //  console.log("TOTALES", this.GalonesDiariaApertura);
                    //  console.log("TOTALES", this.MontoTotalMesDiariaApertura);
                   this.totalesEstacionDia();

                })
                .catch((error) => {
                    //Errores de validación
                });
        },
        totalesEstacionDia() {
            this.loading = false;
            var cirSuspendida = {
                label: "GALONES VENDIDO POR DIA",
                data: this.GalonesDiariaApertura,
                backgroundColor: "#00008B",
                borderColor: "#00008B",
                lineTension: 0,
                fill: false,
             
            };
            var CirMontoDolares = {
                label: "MONTO EN DOLARES VENDIDO POR DIA",
                data: this.MontoTotalMesDiariaApertura,
                backgroundColor: "#008000",
                borderColor: "#008000",
                lineTension: 0,
                fill: false,
              
            };
            var totalesData = {
                labels: this.IndiceVentasEstaciones,
                datasets: [cirSuspendida, CirMontoDolares],
            };
            var chartOptions = {
                legend: {
                    display: true,
                    position: "top",
                    labels: {
                        boxWidth: 80, 
                        fontColor: "black",
                    },
                }, 
            };

            
            this.vardatos = document
                .getElementById("EstacionesPorDia")
                .getContext("2d");
            this.chartDiarioApertura = new Chart(this.vardatos, {
                type: "bar",

                data: totalesData,
                options: chartOptions,
                //options: chartOptions
            });
         clearInterval(this.sliderTimer);
        },
        consultasEstaciones() {
            let that = this;
            let url =
                this.$store.getters.getRuta +
                "/modulos/admision/paciente/ConsultaEstaciones";
            let ListEstacionesRecorrer = [];
            this.ListEstaciones = [];
            axios
                .get(url)
                .then((response) => {

                    ListEstacionesRecorrer = response.data.Resp;
                    console.log("ListaEstaciones1", ListEstacionesRecorrer);
                    //  that.valor = response.data.data;

                    ListEstacionesRecorrer.forEach(element => {
                        let objeto = {};
                        objeto.id = element.id;
                        objeto.nombre = element.descripcion;
                        objeto.icon = "mdi-fuel";
                        objeto.color = "primary";
                        this.ListEstaciones.push(objeto);
                    });
                    let objeto = {};
                    objeto.id = 0;
                    objeto.nombre = "TODAS LAS ESTACIONES";
                    objeto.icon = "mdi-fuel";
                    objeto.color = "primary";
                    this.ListEstaciones.push(objeto);


                })
                .catch((error) => {
                    //Errores de validación
                });
        },
        Consultaanio(id) {
            this.anioItem = id;
            this.consultasGastos();
        },
        ConsultaMes(id) {
            this.mesItem = id;
            this.consultasGastos();
        },
        ConsultaEstacionItem(id) {
            this.EstacionItem = id;
            this.consultasGastos();
        },

        consultasGastos() {
            let that = this;


            if (this.EstacionItem === "") {
                this.mensajeAler("selecione la estación", false);
                return;
            }
            if (this.anioItem === "") {
                this.mensajeAler("selecione el año", false);
                return;
            }
            if (this.mesItem === "") {
                this.mensajeAler("selecione el mes", false);
                return;
            }
            let url =
                this.$store.getters.getRuta +
                "/modulos/admision/paciente/ConsultaGastosEDS/" + this.EstacionItem + "/" + this.mesItem + "/" + this.anioItem;

            let ListaGastosArr
            this.ListaGastos = [];
            this.loading = true;
            axios
                .get(url)
                .then((response) => {

                    ListaGastosArr = response.data.Resp;

                    ListaGastosArr.forEach(element => {
                        let objeto = {};
                        objeto.estacion = element.estacion;
                        objeto.pc_nomcta = element.pc_nomcta;
                        objeto.cc_concepto = element.cc_concepto;
                        objeto.cc_fecha = element.cc_fecha;
                        objeto.dc_glosa = element.dc_glosa;
                        objeto.dc_valdeb = element.dc_valdeb;
                        objeto.dc_valhab = element.dc_valhab;

                        this.ListaGastos.push(objeto);
                    });
                    this.loading = false;
                    //  that.valor = response.data.data;

                    //  ListEstacionesRecorrer.forEach(element => {
                    //     let objeto = {};
                    //     objeto.id = element.id;
                    //     objeto.nombre = element.descripcion;
                    //     objeto.icon = "mdi-fuel";
                    //     objeto.color = "primary";
                    //     this.ListEstaciones.push(objeto);
                    //  });
                    //  let objeto = {};
                    //  objeto.id = "0";
                    //     objeto.nombre = "TODAS LAS ESTACIONES";
                    //     objeto.icon = "mdi-fuel";
                    //     objeto.color = "primary";
                    //     this.ListEstaciones.push(objeto);


                })
                .catch((error) => {
                    //Errores de validación
                });
        },

        mensajeAler(value, value2) {
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
<style scoped>
h3 {
    margin: 40px 0 0;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    display: inline-block;
    margin: 0 10px;
}

a {
    color: #42b983;
}
</style>
<style>
td {
    font-size: 20px !important;
}

.v-icon.outlined {
    position: relative;
    top: -40px;
    left: 0px;
}
</style>

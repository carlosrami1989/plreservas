<template>
    <div>
       

        <v-row no-gutters>
            <v-col cols="12" sm="2" class="align-center">
                <v-img
                    src="/img/logo.bmp"
                    class="grey darken-4"
                    max-width="500"
                >
                </v-img>
                <h2>{{ this.NombreEstacion }}</h2>
            </v-col>

            <v-col cols="12" sm="2" class="pa-1">
                <v-card
                    outlined
                    tile
                    elevation="8"
                    class="rounded-lg"
                    :loader-height="5"
                    :loading="true"
                >
                    <v-card-text>
                        <v-icon x-large color="orange"> mdi-file</v-icon>
                        <br class="align-center" />
                        <div style="width: auto; text-align: center">
                            <h1>55</h1>
                        </div>
                        Transacciones por día
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" sm="2" class="pa-1">
                <v-card
                    :loader-height="5"
                    :loading="true"
                    outlined
                    tile
                    elevation="8"
                    class="rounded-lg"
                >
                    <v-card-text>
                        <v-icon large medium color="purple"> mdi-fuel</v-icon>
                        <br class="align-center" />
                        <div style="width: auto; text-align: center">
                            <h1>55</h1>
                        </div>
                        Total de Galones
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" sm="2" class="pa-1">
                <v-card
                    :loader-height="5"
                    :loading="true"
                    outlined
                    tile
                    elevation="8"
                    class="rounded-lg"
                >
                    <v-card-text>
                        <v-icon large medium color="green">
                            mdi-cash-multiple</v-icon
                        >
                        <br class="align-center" />
                        <div style="width: auto; text-align: center">
                            <h1>$55</h1>
                        </div>
                        Total en Montos
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" sm="2" class="py-1">
                <v-card
                    :loader-height="5"
                    :loading="true"
                    outlined
                    tile
                    elevation="8"
                    class="rounded-lg"
                >
                    <v-card-text>
                        <v-icon large medium color="primary">
                            mdi-chart-line</v-icon
                        >
                        <br class="align-center" />
                        <div style="width: auto; text-align: center">
                            <h1>$55</h1>
                        </div>
                        Descargar Informacion
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" sm="2" class="pa-1">
                <v-card
                    :loader-height="5"
                    :loading="true"
                    outlined
                    tile
                    elevation="8"
                    class="rounded-lg"
                >
                    <v-card-text>
                        <v-icon large medium color="primary">
                            mdi-chart-line</v-icon
                        >
                        <br class="align-center" />
                        <div style="width: auto; text-align: center">
                            <h1>$55</h1>
                        </div>
                        Total Por días en Galones
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>

        <v-row no-gutters>
            <v-col cols="12" sm="2" class="pa-1">
                <v-card outlined tile elevation="8" class="rounded-lg">
                    <v-system-bar
                        color="indigo darken-2"
                        dark
                        class="white--text"
                        >AÑO</v-system-bar
                    >

                    <v-chip-group active-class="success" column>
                        <v-chip
                            v-for="tag in Listanio"
                            :key="tag"
                            @click="anioItem = tag"
                        >
                            {{ tag }}
                        </v-chip>
                    </v-chip-group>
                </v-card>

                <v-card
                    :loader-height="5"
                    :loading="true"
                    outlined
                    tile
                    elevation="8"
                    class="rounded-lg"
                >
                    <v-system-bar
                        color="indigo darken-2"
                        dark
                        class="white--text"
                        >mes</v-system-bar
                    >
                    <v-chip-group active-class="success" column>
                        <v-chip
                            v-for="tag in Listames"
                            :key="tag.id"
                            @click="mesItem = tag.id"
                        >
                            {{ tag.mes }}
                        </v-chip>
                    </v-chip-group>
                </v-card>

                <v-card outlined tile elevation="8" class="rounded-lg">
                    <v-system-bar
                        color="indigo darken-2"
                        dark
                        class="white--text"
                        >Fechas</v-system-bar
                    >

                    <v-chip-group active-class="success" column> </v-chip-group>
                </v-card>
            </v-col>

            <v-col cols="12" sm="5" class="pa-1">
                <v-card
                    :loader-height="5"
                    :loading="true"
                    outlined
                    tile
                    elevation="8"
                    class="rounded-lg"
                >
                    <v-system-bar
                        color="indigo darken-2"
                        dark
                        class="white--text"
                        >Total del Mes</v-system-bar
                    >
                    <canvas
                        id="ventasPorMes"
                        height="300px"
                        width="auto"
                    ></canvas>
                    <div style="width: auto; text-align: center"></div>
                </v-card>
            </v-col>
            <v-col cols="12" sm="5"  class="pa-1">
                <v-card
                    :loader-height="5"
                    :loading="true"
                    outlined
                    tile
                    elevation="8"
                    class="rounded-lg"
                >
                    <v-system-bar
                        color="indigo darken-2"
                        dark
                        class="white--text"
                        >Total del día por montos</v-system-bar
                    >
                    <canvas
                        id="ventasPorFechaAperturaMonto"
                        height="143px"
                        width="auto"
                    ></canvas>
                </v-card>
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
                        Total Por días en Galones</v-system-bar
                    >
                    <canvas
                        id="ventasPorFechaApertura"
                        height="145px"
                        width="auto"
                    ></canvas>
                </v-card>
            </v-col>
        </v-row>

        <!-- aqui va otro grupo -->

        <v-row no-gutters>
            <v-col cols="12" sm="12" class="pa-1">
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
                        Comparativo de Meses</v-system-bar
                    >
                    <canvas
                        id="ventasFechaPorMes"
                        height="120px"
                        width="auto"
                    ></canvas>
                </v-card>
            </v-col>
        </v-row>
        <!-- <v-row>
            
            
            <v-col cols="12" sm="2" md="2" class="py-1"
            v-for="item in ListaManguera" :key="item.cod_manguera">
                <v-card class="pa-2" outlined tile>
                    <router-link :to="ruta"> 
                    <v-img
                         
                        :src="item.src"
                       
                    ></v-img>
                </router-link>        
                     
                        <v-card-text>
                            <v-icon large color="green">mdi-fuel </v-icon> {{ item.des_manguera }}
                        </v-card-text>
                         
                </v-card>
            </v-col>
             
 
        </v-row> -->
        <v-divider></v-divider>
        <br />
        <v-row> </v-row>
        <br />
        <v-divider></v-divider>
        <v-row> </v-row>
        <br />
        <br />
    </div>
</template>
<script>
import { prefix, url } from "../../variables";
import { funcionesGlobales } from "../../funciones";
export default {
    props: {
        user: {
            type: Object,
        },
    },
    data() {
        return {
            anioItem: "",
            mesItem: "",
            diaItem: "",
            diaActual: "",
            justify: [
                "start",
                "center",
                "end",
                "space-around",
                "space-between",
            ],
            Listanio: ["2022", "2023", "2024"],
            Listames: [
                { id: 1, mes: "Enero" },
                { id: 2, mes: "Febrero" },
                { id: 3, mes: "Marzo" },
                { id: 4, mes: "Abril" },
                { id: 5, mes: "Mayo" },
                { id: 6, mes: "Junio" },
                { id: 7, mes: "Julio" },
                { id: 8, mes: "Agosto" },
                { id: 9, mes: "Septiembre" },
                { id: 10, mes: "Octubre" },
                { id: 11, mes: "Noviembre" },
                { id: 12, mes: "Diciembre" },
            ],
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
            vardatosFechaApertMonto:null,

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

            GalonesDiariaApertura: [],
            MontoTotalMesDiariaApertura: [],
            chartMesApertura: null,

            //fin
            indice: [],
            valores: [],

            DescripcionTotalMes: [],

            chartGalonesMes: null,
            loading: true,
            sliderTimer:null,
            IdEstacionWeb:0,
            NombreEstacion:"",
        };
    },
    mounted() {
        this.generarId();
        const fecha = new Date();
       
       this.mesItem = fecha.getMonth();
      //  setInterval(  this.GenerarVentasDiariasFecha(), 8000);
       //  this.GenerarTotalVentas();
    let that = this;
    this.sliderTimer= setInterval(function () {
          //  console.log("hola");
         that.GenerarTotalVentas();
         
           that.GenerarVentasDiariasFecha();
           that.GenerarVentasDiariasFechaMes();
    }, 4000);


       //this.GenerarToken();
    },
    methods: {
        consultaMes(){


        },
        generarId(){
          this.IdEstacionWeb =  this.$route.params.id;          
          this.NombreEstacion =  this.$route.params.nombre;          
        },
        GenerarTaks() {
            // let url =
            //     this.$store.state.ApiGasquil +
            //     "Dashboard/GetVentasDiariosFechaApertura";
          //  console.log("se activo");
            let url =
                this.$store.getters.getRuta +
                "/modulos/admision/paciente/GetDia";

             let ListaVentasFecha = [];
             let ListaVentasFecha2 = [];
             let _ListaComparar = ["DIESEL", "ECO", "SUPER"];
           

            axios
                .get(url)
                .then((response) => {
                  //  ListaVentasFecha.push(response.data.Resp);
                   
                   ListaVentasFecha= response.data.Resp;
                 
                })
                .catch((error) => {
                  
                });
        },
        GenerarModal(value) {
            this.dialog = true;
        },
    
        GenerarFactura() {
            let url = this.$store.state.ApiGasquil + "Transactor/GetFactura";

            let _Lista = [];
            const headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${this.$store.getters.tokeGasquil}`,
            };

            axios
                .get(url, { headers: headers })
                .then((response) => {
                    _Lista = JSON.parse(response.data.Resp);
                  //  console.log(_Lista);
                    let objeto = {};
                    for (let index = 0; index < _Lista.length; index++) {
                        //const element = array[index];
                        objeto.fecha = _Lista[index].fech;
                        this.indice.push(objeto.fecha);
                        objeto.peso = _Lista[index].total;
                        that.value.push(objeto.peso);
                    }
                })
                .catch((error) => {
                    // let objeto = [];
                    // objeto = Object.values(error.response.data.errors);
                    // for (
                    //     let index = 0;
                    //     index < objeto.length;
                    //     index++
                    // ) {
                    //     this.mensajeAler(objeto[index][0], false);
                    // }
                });
        },

        GenerarDespacho() {
            let url = this.$store.state.ApiGasquil + "Transactor/GetDespacho";

            let _ListaDes = [];
            const headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${this.$store.getters.tokeGasquil}`,
            };

            axios
                .get(url, { headers: headers })
                .then((response) => {
                    //  _ListaDes = JSON.parse(response.data.Resp);
                  //  console.log(response.data);
                })
                .catch((error) => {
                    // let objeto = [];
                    // objeto = Object.values(error.response.data.errors);
                    // for (
                    //     let index = 0;
                    //     index < objeto.length;
                    //     index++
                    // ) {
                    //     this.mensajeAler(objeto[index][0], false);
                    // }
                });
        },

        GenerarTurnos() {
            let url =
                this.$store.state.ApiGasquil + "Transactor/GetDetallesTurnos";

            let _ListaDes = [];
            const headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${this.$store.getters.tokeGasquil}`,
            };
            let _Lista = {
                fecha: "2023-01-15",
            };

            axios
                .get(url, { fecha: "2023-01-15" }, { headers: headers })
                .then((response) => {
                    //  _ListaDes = JSON.parse(response.data.Resp);
                  //  console.log(response.data);
                })
                .catch((error) => {
                    // let objeto = [];
                    // objeto = Object.values(error.response.data.errors);
                    // for (
                    //     let index = 0;
                    //     index < objeto.length;
                    //     index++
                    // ) {
                    //     this.mensajeAler(objeto[index][0], false);
                    // }
                });
        },
        GenerarTotalVentasClick() {
            
            var Navidad = new Date();
            this.mesItem = Navidad.getMonth() + 1 ;
            this.anioItem = Navidad.getUTCFullYear();
            this.ProductoMes= [];
            this.GalonesTotalMes= [];
            this.MontoTotalMes= [];
          
            let that = this;
            let url =
                this.$store.getters.getRuta +
                "/modulos/admision/paciente/GetMes/"+this.IdEstacionWeb+"/"+ this.mesItem+"/"+ this.anioItem;
           let _ListaDes = [];
           
           
            axios
                .get(url)
                .then((response) => {
                    
                    _ListaDes =  response.data.Resp;
                    console.log("_ListaDes",_ListaDes);
                    let objeto = {};
                    for (let index = 0; index < _ListaDes.length; index++) {
                        //const element = array[index];
                       // console.log("for",this.MontoTotalMes);
                        objeto.producto = _ListaDes[index].descripcion;
                        this.ProductoMes.push(objeto.producto);
                        objeto.galones_mes = _ListaDes[index].galones;
                        this.GalonesTotalMes.push(objeto.galones_mes);
                        objeto.monto = _ListaDes[index].total;
                        this.MontoTotalMes.push(objeto.monto);
                    }
                    console.log("_ListaDes",this.MontoTotalMes);
                   this.totalesMes();
                })
                .catch((error) => {});
        },
        GenerarTotalVentas() {
            var Navidad = new Date();
            this.mesItem = Navidad.getMonth() + 1 ;
            this.anioItem = Navidad.getUTCFullYear();
 
          
            let that = this;
            let url =
                this.$store.getters.getRuta +
                "/modulos/admision/paciente/GetMes/"+this.IdEstacionWeb+"/"+ this.mesItem+"/"+ this.anioItem;
           let _ListaDes = [];
           
           
            axios
                .get(url)
                .then((response) => {
                    
                    _ListaDes =  response.data.Resp;
                    console.log("_ListaDes",_ListaDes);
                    let objeto = {};
                    for (let index = 0; index < _ListaDes.length; index++) {
                        //const element = array[index];
                        console.log("for",this.MontoTotalMes);
                        objeto.producto = _ListaDes[index].descripcion;
                        this.ProductoMes.push(objeto.producto);
                        objeto.galones_mes = _ListaDes[index].galones;
                        this.GalonesTotalMes.push(objeto.galones_mes);
                        objeto.monto = _ListaDes[index].total;
                        this.MontoTotalMes.push(objeto.monto);
                    }
                    console.log("_ListaDes",this.MontoTotalMes);
                   this.totalesMes();
                })
                .catch((error) => {});
        },
        totalesMes() {
            this.loading = false;
            var cirSuspendida = {
                label: "GALONES VENDIDO POR MES",
                data: this.GalonesTotalMes,
                backgroundColor: "rgba(255, 0, 0, 1)",
                borderColor: "rgba(99, 132, 0, 1)",
                // lineTension: 0,
                // fill: false,
                // borderColor: "orange",
                // backgroundColor: "transparent",
                // borderDash: [5, 5],
                // pointBorderColor: "orange",
                // pointBackgroundColor: "rgba(255,150,0,0.5)",
                // pointRadius: 5,
                // pointHoverRadius: 10,
                // pointHitRadius: 30,
                // pointBorderWidth: 1,
                // pointStyle: "rectRounded",
            };
            var CirMontoDolares = {
                label: "MONTO EN DOLARES VENDIDO POR MES",
                data: this.MontoTotalMes,
                backgroundColor: "rgb(0, 100, 0)",
                borderColor: "rgb(0, 100, 0)",
                //  lineTension: 0,
                //  fill: false,

                // backgroundColor: "transparent",
                // borderDash: [5, 5],
                // pointBorderColor: "orange",
                // pointBackgroundColor: "rgba(255,150,0,0.5)",
                // pointRadius: 5,
                // pointHoverRadius: 10,
                // pointHitRadius: 30,
                // pointBorderWidth: 2,
                // pointStyle: "rectRounded",
            };
            var totalesData = {
                labels: this.ProductoMes,
                datasets: [cirSuspendida, CirMontoDolares],
            };
            var chartOptions = {
                // scales: {
                //     xAxes: [
                //         {
                //             barPercentage: 1,
                //             categoryPercentage: 0.6,
                //         },
                //     ],
                //     yAxes: [
                //         {
                //             id: "y-axis-density",
                //         },
                //         {
                //             id: "y-axis-gravity",
                //         },
                //     ],
                // },
            };
            this.vardatos = document
                .getElementById("ventasPorMes")
                .getContext("2d");
            this.chartGalonesMes = new Chart(this.vardatos, {
                type: "horizontalBar",

                data: totalesData,
                options: chartOptions,
                //options: chartOptions
            });
        },

        GenerarVentasDiariasFecha() {
            // let url =
            //     this.$store.state.ApiGasquil +
            //     "Dashboard/GetVentasDiariosFechaApertura";
          //  console.log("se activo");
            let url =
                this.$store.getters.getRuta +
                "/modulos/admision/paciente/GetDia/" + this.IdEstacionWeb;

             let ListaVentasFecha = [];
             let ListaVentasFecha2 = [];
             let _ListaComparar = ["DIESEL", "ECO", "SUPER"];
           

            axios
                .get(url)
                .then((response) => {
                  //  ListaVentasFecha.push(response.data.Resp);
                   
                   ListaVentasFecha= response.data.Resp;
                  console.log("ListaVentasFecha",ListaVentasFecha); 
 
                        for (let index in ListaVentasFecha) {
                      
                        const element = ListaVentasFecha[index];
                        for (
                            let item = 0;
                            item < element.length;
                            item++
                        ) {
                           
                          
                            if (item == 0) {
                              //  console.log("ListaVentasFecha", element[item].dia);
                                this.IndiceVentas.push(
                                    element[item].dia.replace(
                                        " 00:00:00",
                                        ""
                                    )
                                );
                            }
                        }
                        // //
                        if (element.length == 4) {
                        
                            for (
                                let item = 0;
                                item < element.length;
                                item++
                            ) {
                                let _descripcion = "";
                                _descripcion =element[
                                    item
                                ].descripcion
                                    .toString()
                                    .replace(/\s+/g, "");

                                if (
                                    _descripcion == "DIESEL".replace(/\s+/g, "")
                                ) {
                                    this.GalonesDieselDiariaApertura.push(
                                        element[item].galones
                                    );
                                    this.MontoDieselDiariaApertura.push(
                                       element[item].total
                                    );
                                }
                                if (_descripcion == "ECO".replace(/\s+/g, "") || _descripcion == "EXTRA CON ETANOL".replace(/\s+/g, "")) {
                                    this.GalonesEcoDiariaApertura.push(
                                       element[item].galones
                                    );
                                    this.MontoEcoDiariaApertura.push(
                                       element[item].total
                                    );
                                }
                                if (
                                    _descripcion == "SUPER".replace(/\s+/g, "")
                                ) {
                                    this.GalonesSuperDiariaApertura.push(
                                       element[item].galones
                                    );
                                    this.MontoSuperDiariaApertura.push(
                                       element[item].total
                                    );
                                }
                                if (
                                    _descripcion ==
                                    "ECOPLUS89".replace(/\s+/g, "")
                                ) {
                                    this.GalonesEcoPlusDiariaApertura.push(
                                       element[item].galones
                                    );
                                    this.MontoEcoPlusDiariaApertura.push(
                                       element[item].total
                                    );
                                }
                            }
                        }

                        if (
                            element.length == 3 ||
                            element.length == 2
                        ) {
                        
                            let _listaExiste3 = [];
                            for (
                                let item2 = 0;
                                item2 < element.length;
                                item2++
                            ) {
                                let _descripcion = "";
                                _descripcion =element[
                                    item2
                                ].descripcion.replace(/\s+/g, "");

                                _listaExiste3.push(_descripcion);

                                if (
                                    _descripcion == "DIESEL".replace(/\s+/g, "")
                                ) {
                                    this.GalonesDieselDiariaApertura.push(
                                       element[item2].galones
                                    );
                                    this.MontoDieselDiariaApertura.push(
                                       element[item2].total
                                    );
                                }
                                if (_descripcion == "ECO".replace(/\s+/g, "")) {
                                    this.GalonesEcoDiariaApertura.push(
                                       element[item2].galones
                                    );
                                    this.MontoEcoDiariaApertura.push(
                                       element[item2].total
                                    );
                                }
                                if (
                                    _descripcion == "SUPER".replace(/\s+/g, "")
                                ) {
                                    this.GalonesSuperDiariaApertura.push(
                                       element[item2].galones
                                    );
                                    this.MontoSuperDiariaApertura.push(
                                       element[item2].total
                                    );
                                }
                                if (
                                    _descripcion ==
                                    "ECOPLUS89".replace(/\s+/g, "")
                                ) {
                                    this.GalonesEcoPlusDiariaApertura.push(
                                       element[item2].galones
                                    );
                                    this.MontoEcoPlusDiariaApertura.push(
                                       element[item2].total
                                    );
                                }
                            }

                            let _listaResult = [];

                            for (var i of _ListaComparar) {
                                //console.log(i+"----> for 1")
                                let _resultList = _listaExiste3.filter(
                                    (element2) => element2 == i
                                );

                                if (_resultList.length == 0) {
                                    _listaResult.push(i);
                                }
                            }
                          //  console.log("_listaExiste3", _listaExiste3);
                          //  console.log("_listaResult", _listaResult);
                            for (var j of _listaResult) {
                                if (j == "DIESEL".replace(/\s+/g, "")) {
                                    this.GalonesDieselDiariaApertura.push(0);
                                    this.MontoDieselDiariaApertura.push(0);
                                }
                                if (j == "ECO".replace(/\s+/g, "") || j == "EXTRA CON ETANOL".replace(/\s+/g, "")) {
                                    this.GalonesEcoDiariaApertura.push(0);
                                    this.MontoEcoDiariaApertura.push(0);
                                }
                                if (j == "SUPER".replace(/\s+/g, "")) {
                                    this.GalonesSuperDiariaApertura.push(0);
                                    this.MontoSuperDiariaApertura.push(0);
                                }
                                if (j == "ECOPLUS89".replace(/\s+/g, "")) {
                                    this.GalonesEcoPlusDiariaApertura.push(0);
                                    this.MontoEcoPlusDiariaApertura.push(0);
                                }
                            }

                         
                        }
                    }
 
                    this.totalesDiarias();
                    this.totalesDiariasMonto();
                })
                .catch((error) => {
                  
                });
        },
        totalesDiarias() {
            var CirEco = {
                label: "Eco Pais - Galones",
                data: this.GalonesEcoDiariaApertura,
                backgroundColor: "rgba(1, 58 , 251)",
                // borderColor: "rgba(99, 132, 0, 1)",
                borderColor: "rgba(1, 58 , 251)",
                lineTension: 0,
                fill: false,
                //  borderColor: "orange",
                // backgroundColor: "transparent",
                //borderDash: [5, 5],
                // pointBorderColor: "orange",
                // pointBackgroundColor: "rgba(255,150,0,0.5)",
                // pointRadius: 5,
                // pointHoverRadius: 10,
                // pointHitRadius: 30,
                // pointBorderWidth: 1,
                // pointStyle: "rectRounded",
            };
            var CirSuper = {
                label: "Super-Galones",
                data: this.GalonesSuperDiariaApertura,
                //backgroundColor: "rgb(253, 245, 230)",
                borderColor: "rgb(174, 187, 187 )",
                //borderWidth: 1,
                fill: false,
                lineTension: 0,
                // backgroundColor: "transparent",
                //  borderDash: [5, 5],
                // pointBorderColor: "orange",
                // pointBackgroundColor: "rgba(255,150,0,0.5)",
                // pointRadius: 5,
                // pointHoverRadius: 10,
                // pointHitRadius: 30,
                // pointBorderWidth: 1,
                // pointStyle: "rectRounded",
            };
            var CirDiesel = {
                label: "Diese-Galones",
                data: this.GalonesDieselDiariaApertura,
                // backgroundColor: "rgb(255, 255,0)",
                // borderColor: "rgba(99, 132, 0, 1)",
                borderColor: "rgb(244, 208, 63 )",
                // borderWidth: 1,
                fill: false,
                lineTension: 0,

                // backgroundColor: "transparent",
                // borderDash: [5, 5],
                // pointBorderColor: "orange",
                // pointBackgroundColor: "rgba(255,150,0,0.5)",
                // pointRadius: 5,
                // pointHoverRadius: 10,
                // pointHitRadius: 30,
                // pointBorderWidth: 1,
                // pointStyle: "rectRounded",
            };
            // var CirEcoPlus = {
            //     label: "Eco-Plus",
            //     data: this.GalonesEcoPlusDiariaApertura,
            //     //  backgroundColor: "rgba(255, 0, 0, 1)",
            //     borderColor: "rgba(255, 0, 0, 1)",
            //     fill: false,
            //     lineTension: 0,
            //     // fill: false,
            //     // borderColor: "orange",
            //     // backgroundColor: "transparent",
            //     //   borderDash: [5, 5],
            //     // pointBorderColor: "orange",
            //     // pointBackgroundColor: "rgba(255,150,0,0.5)",
            //     // pointRadius: 5,
            //     // pointHoverRadius: 10,
            //     // pointHitRadius: 30,
            //     // pointBorderWidth: 1,
            //     // pointStyle: "rectRounded",
            // };
            var totalesData = {
                labels: this.IndiceVentas,
                datasets: [CirEco, CirDiesel, CirSuper],
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
                // scales: {
                //     xAxes: [
                //         {
                //             barPercentage: 1,
                //             categoryPercentage: 0.6,
                //         },
                //     ],
                //     yAxes: [
                //         {
                //             id: "y-axis-density",
                //         },
                //         {
                //             id: "y-axis-gravity",
                //         },
                //     ],
                // },
            };
            this.vardatosFechaApert = document
                .getElementById("ventasPorFechaApertura")
                .getContext("2d");
            this.chartDiariaApertura = new Chart(this.vardatosFechaApert, {
                type: "line",

                data: totalesData,
                options: chartOptions,
                //options: chartOptions
            });
        },

        totalesDiariasMonto() {
            var CirEco = {
                label: "Eco Pais-Monto",
                data: this.MontoEcoDiariaApertura,
                backgroundColor: "rgba(1, 58 , 251)",
                // borderColor: "rgba(99, 132, 0, 1)",
                borderColor: "rgb(0, 0, 0)",
                borderWidth: 1,
                fill: false,
                //  borderColor: "orange",
                // backgroundColor: "transparent",
                borderDash: [5, 5],
                // pointBorderColor: "orange",
                // pointBackgroundColor: "rgba(255,150,0,0.5)",
                // pointRadius: 5,
                // pointHoverRadius: 10,
                // pointHitRadius: 30,
                // pointBorderWidth: 1,
                // pointStyle: "rectRounded",
            };
            var CirSuper = {
                label: "Super-Monto",
                data: this.MontoSuperDiariaApertura,
                backgroundColor: "rgb(253, 245, 230)",
                borderColor: "rgb(0, 0, 0)",
                borderWidth: 1,
                fill: false,

                // backgroundColor: "transparent",
                borderDash: [5, 5],
                // pointBorderColor: "orange",
                // pointBackgroundColor: "rgba(255,150,0,0.5)",
                // pointRadius: 5,
                // pointHoverRadius: 10,
                // pointHitRadius: 30,
                // pointBorderWidth: 1,
                // pointStyle: "rectRounded",
            };
            var CirDiesel = {
                label: "Diese-Monto",
                data: this.MontoDieselDiariaApertura,
                backgroundColor: "rgb(255, 255,0)",
                // borderColor: "rgba(99, 132, 0, 1)",
                borderColor: "rgb(0, 0, 0)",
                borderWidth: 1,
                fill: false,
 
                // backgroundColor: "transparent",
                borderDash: [5, 5],
                // pointBorderColor: "orange",
                // pointBackgroundColor: "rgba(255,150,0,0.5)",
                // pointRadius: 5,
                // pointHoverRadius: 10,
                // pointHitRadius: 30,
                // pointBorderWidth: 1,
                // pointStyle: "rectRounded",
            };
            // var CirEcoPlus = {
            //     label: "Eco-Plus/Monto",
            //     data: this.MontoEcoPlusDiariaApertura,
            //     backgroundColor: "rgba(255, 0, 0, 1)",
            //     borderColor: "rgba(99, 132, 0, 1)",
            //     lineTension: 0,
            //     fill: false,
            //     borderColor: "orange",
            //     // backgroundColor: "transparent",
            //     borderDash: [5, 5],
            //     // pointBorderColor: "orange",
            //     // pointBackgroundColor: "rgba(255,150,0,0.5)",
            //     // pointRadius: 5,
            //     // pointHoverRadius: 10,
            //     // pointHitRadius: 30,
            //     // pointBorderWidth: 1,
            //     // pointStyle: "rectRounded",
            // };

            var totalesData = {
                labels: this.IndiceVentas,
                datasets: [CirEco, CirDiesel, CirSuper],
            };
            var chartOptions = {
                // scales: {
                //     xAxes: [
                //         {
                //             barPercentage: 1,
                //             categoryPercentage: 0.6,
                //         },
                //     ],
                //     yAxes: [
                //         {
                //             id: "y-axis-density",
                //         },
                //         {
                //             id: "y-axis-gravity",
                //         },
                //     ],
                // },
            };
            this.vardatosFechaApertMonto = document
                .getElementById("ventasPorFechaAperturaMonto")
                .getContext("2d");
            this.chartDiariaFechaApertura = new Chart(
                this.vardatosFechaApertMonto,
                {
                    type: "bar",

                    data: totalesData,
                    options: chartOptions,
                    //options: chartOptions
                }
            );
        },

        GenerarVentasDiariasFechaMes() {
            clearInterval(this.sliderTimer);
            let ListaVentasFechaMes = [];
       
            let url =
                this.$store.getters.getRuta +
                "/modulos/admision/paciente/GetMes/"+this.IdEstacionWeb+"/99"+"/0";

            axios
                .get(url)
                .then((response) => {
                    ListaVentasFechaMes = response.data.Resp;
                    console.log("ListaVentasFechaMes", ListaVentasFechaMes );

                    for (let index in ListaVentasFechaMes) {
                      
                      const element = ListaVentasFechaMes[index];
                    // for (
                    //     let index = 0;
                    //     index < ListaVentasFechaMes.length;
                    //     index++
                    // )
                     
                        

                        for (
                            let item = 0;
                            item < element.length;
                            item++
                        ) {
                           
                            if (item == 0) {
                                this.IndiceVentasMes.push(
                                    funcionesGlobales.MesesNumeros(
                                        element[item].mes
                                    )
                                );
                            }
                            if (
                                element[item].descripcion ==
                                "DIESEL"
                            ) {
                                this.GalonesDieselDiariaAperturaMes.push(
                                    element[item].galones
                                );
                                this.MontoDieselDiariaAperturaMes.push(
                                    element[item].total
                                );
                            }
                            if (
                                element[item].descripcion ==
                                "ECO" || element[item].descripcion ==
                                "EXTRA CON ETANOL"
                            ) {
                                this.GalonesEcoDiariaAperturaMes.push(
                                    element[item].galones
                                );
                                this.MontoEcoDiariaAperturaMes.push(
                                    element[item].total
                                );
                            }
                            if (
                                element[item].descripcion ==
                                "SUPER"
                            ) {
                                this.GalonesSuperDiariaAperturaMes.push(
                                    element[item].galones
                                );
                                this.MontoSuperDiariaAperturaMes.push(
                                    element[item].total
                                );
                            }
                            // if (element[item].descripcion == "ECOPLUS 89") {
                            //     this.GalonesEcoPlusDiariaAperturaMes.push(element[item].galones);                                    t
                            //     this.MontoEcoPlusDiariaAperturaMes.push(element[item].total);

                            // }
                        }
                    }

                    this.totalesComparativoMes();
                   // this.totalesDiariasMonto();
                      
                  
                })
                .catch((error) => {});
        },

        totalesComparativoMes() {
            var CirEco = {
                label: "Eco Pais - Galones",
                data: this.GalonesEcoDiariaAperturaMes,
                backgroundColor: "rgb(1, 58 , 251 )",
                // borderColor: "rgba(99, 132, 0, 1)",
                borderColor: "rgb(0, 0, 0)",
                borderWidth: 1,
                // fill: false,
                //  borderColor: "orange",
                // backgroundColor: "transparent",
                // borderDash: [5, 5],
                // pointBorderColor: "orange",
                // pointBackgroundColor: "rgba(255,150,0,0.5)",
                // pointRadius: 5,
                // pointHoverRadius: 10,
                // pointHitRadius: 30,
                // pointBorderWidth: 1,
                // pointStyle: "rectRounded",
            };
            var CirSuper = {
                label: "Super-Galones",
                data: this.GalonesSuperDiariaAperturaMes,
                backgroundColor: "rgb(253, 245, 230)",
                borderColor: "rgb(0, 0, 0)",
                borderWidth: 1,

                // backgroundColor: "transparent",
                // borderDash: [5, 5],
                // pointBorderColor: "orange",
                // pointBackgroundColor: "rgba(255,150,0,0.5)",
                // pointRadius: 5,
                // pointHoverRadius: 10,
                // pointHitRadius: 30,
                // pointBorderWidth: 1,
                // pointStyle: "rectRounded",
            };
            var CirDiesel = {
                label: "Diese-Galones",
                data: this.GalonesDieselDiariaAperturaMes,
                backgroundColor: "rgb(255, 255,0)",
                // borderColor: "rgba(99, 132, 0, 1)",
                borderColor: "rgb(0, 0, 0)",
                borderWidth: 1,

                // backgroundColor: "transparent",
                //borderDash: [5, 5],
                // pointBorderColor: "orange",
                // pointBackgroundColor: "rgba(255,150,0,0.5)",
                // pointRadius: 5,
                // pointHoverRadius: 10,
                // pointHitRadius: 30,
                // pointBorderWidth: 1,
                // pointStyle: "rectRounded",
            };
            // var CirEcoPlus = {
            //     label: "Eco-Plus",
            //     data: this.GalonesEcoPlusDiariaAperturaMes,
            //     backgroundColor: "rgb(255, 0, 0, 1)",
            //     borderColor: "rgb(99, 132, 0, 1)",
            //     borderWidth: 1,

            //     // backgroundColor: "transparent",
            //     // borderDash: [5, 5],
            //     // pointBorderColor: "orange",
            //     // pointBackgroundColor: "rgba(255,150,0,0.5)",
            //     // pointRadius: 5,
            //     // pointHoverRadius: 10,
            //     // pointHitRadius: 30,
            //     // pointBorderWidth: 1,
            //     // pointStyle: "rectRounded",
            // };
            var totalesDataMes = {
                labels: this.IndiceVentasMes,
                datasets: [CirDiesel, CirEco, CirSuper],
            };
            var chartOptions = {
                // scales: {
                //     xAxes: [
                //         {
                //             barPercentage: 1,
                //             categoryPercentage: 0.6,
                //         },
                //     ],
                //     yAxes: [
                //         {
                //             id: "y-axis-density",
                //         },
                //         {
                //             id: "y-axis-gravity",
                //         },
                //     ],
                // },
            };
            this.vardatosFechaApertMes = document
                .getElementById("ventasFechaPorMes")
                .getContext("2d");
            this.chartMesApertura = new Chart(this.vardatosFechaApertMes, {
                type: "bar",

                data: totalesDataMes,
                options: chartOptions,
                //options: chartOptions
            });
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
.v-icon.outlined {
    position: relative;
    top: -40px;
    left: 0px;
}
</style>

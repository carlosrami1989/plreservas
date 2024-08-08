<template>
    <div>
        <!-- hola
        <v-btn color="primary" dark @click="GenerarToken()">dddd</v-btn>
        <v-btn color="primary" dark @click="GenerarFactura()"
            >CONSULTAR FACTURAS</v-btn
        >
        <v-btn color="primary" dark @click="GenerarDespacho()"
            >CONSULTAR DESPACHOS</v-btn
        >
        <v-btn color="primary" dark @click="GenerarTurnos()"
            >CONSULTAR TURNOS</v-btn
        >

        <v-btn color="primary" dark @click="GenerarVentasDiariasFecha()"
            >VENTAS DIARIAS</v-btn
        > -->
        <br />
        <br />
        <v-row>
            <v-col>
                <v-card class="pa-2" outlined tile elevation="8">
                    <canvas
                        id="ventasPorMes"
                        height="120px"
                        width="auto"
                    ></canvas>

                    <v-divider></v-divider>
                    <v-card-text>
                        <v-icon large color="black"> mdi-chart-line</v-icon>
                        Total del Mes
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <br />
        <v-row>
            <v-col class="py-1">
                <v-card outlined tile elevation="8">
                    <canvas
                        id="ventasPorFechaApertura"
                        height="120px"
                        width="auto"
                    ></canvas>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-icon medium color="primary"> mdi-chart-line</v-icon>
                        Total Por días en Galones
                    </v-card-text>
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
        <v-row>
            <!-- <v-col cols="12" sm="6" class="py-1">
                <v-card  outlined tile elevation="8">
                   
                    <canvas id="ventasPorFechaApertura" 
                    height="120px" width="auto"
                    
                    ></canvas>
                   <v-divider></v-divider>
                        <v-card-text>
                            <v-icon medium color="primary">
                                mdi-chart-line</v-icon> Total Por días en Galones
                        </v-card-text>
                         
                </v-card>
            </v-col> -->
            <v-col cols="12" sm="6" class="py-1">
                <v-card outlined tile elevation="8">
                    <canvas
                        id="ventasPorFechaAperturaMonto"
                        height="120px"
                        width="auto"
                    ></canvas>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-icon medium color="primary">mdi-cash-lock</v-icon>
                        Total Por días en Montos
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <br />
        <v-divider></v-divider>
        <v-row>
            <v-col>
                <v-card class="pa-2" outlined tile elevation="8">
                    <canvas
                        id="ventasFechaPorMes"
                        height="120px"
                        width="auto"
                    ></canvas>

                    <v-divider></v-divider>
                    <v-card-text>
                        <v-icon large color="black"> mdi-chart-line</v-icon>
                        Comparativo de Meses
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <!-- <v-row>
            <v-col cols="12" sm="2" md="2" class="py-1"  >
                <canvas
              id="ventas_diarias"
              height="120px"
              width="auto"
              
             
            ></canvas>
            </v-col>
        </v-row> -->
        <v-divider></v-divider>
        <br />
        <v-row>
            <v-col cols="12" sm="6" class="py-1">
                <v-card
                                        max-height="344"
                                        max-width="200"
                                        elevation="24"
                                    >
                                        <v-card-title primary-title>
                                            <v-icon
                                                class="outlined"
                                                size="70"
                                                color="purple darken-2"
                                            >
                                                mdi-book-multiple
                                            </v-icon>

                                            <v-btn
                                                color="orange lighten-2"
                                                text
                                                @click="dialog = true"
                                                >Tareas
                                            </v-btn>
                                        </v-card-title>

                                        <v-card-subtitle> </v-card-subtitle>
                                    </v-card>
            </v-col>
            <v-col cols="12" sm="6" class="py-1">
                <v-card
                                        max-height="344"
                                        max-width="200"
                                        elevation="24"
                                    >
                                        <v-card-title primary-title>
                                            <v-icon
                                                class="outlined"
                                                size="70"
                                                color="purple darken-2"
                                            >
                                                mdi-book-multiple
                                            </v-icon>

                                            <v-btn
                                                color="orange lighten-2"
                                                text
                                                @click="dialog = true"
                                                >Tareas
                                            </v-btn>
                                        </v-card-title>

                                        <v-card-subtitle> </v-card-subtitle>
                                    </v-card>
            </v-col>
        </v-row>
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
            justify: [
                "start",
                "center",
                "end",
                "space-around",
                "space-between",
            ],
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
        };
    },
    mounted() {
        this.ruta = prefix + "/modulos/visor/pantalla";
        // this.consultasTotales();

        // this.consultasDashboard();
        // this.totalesCirugia();
       // this.GenerarToken();
    },
    methods: {
        GenerarModal(value) {
            this.dialog = true;
        },
        GenerarToken() {
            let url = this.$store.state.ApiGasquil + "login/Authenticate";

            let _Lista = {
                Username: "Admin",
                Password: "shieldd2021",
            };
            const headers = {
                "Content-Type": "application/json",
            };

            axios
                .post(url, _Lista, { headers: headers })
                .then((response) => {
                    this.$store.getters.tokeGasquil = response.data.Resp;

                    this.GenerarTotalVentas();
                    this.GenerarVentasDiariasFecha();
                    this.GenerarVentasDiariasFechaMes();
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
                    console.log(_Lista);
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
                    console.log(response.data);
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
                    console.log(response.data);
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
        GenerarTotalVentas() {
            let url =
                this.$store.state.ApiGasquil +
                "Dashboard/GetVentasMes?M=" +
                "03" +
                "&A=" +
                "2023";

            let _ListaDes = [];
            const headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${this.$store.getters.tokeGasquil}`,
            };
            // let _Lista = {
            //     M: "01",
            //     A: "2023",
            //     D:"0",
            // };
            console.log("token", this.$store.getters.tokeGasquil);
            axios
                .get(url, { headers: headers })
                .then((response) => {
                    _ListaDes = JSON.parse(response.data.Resp);

                    let objeto = {};
                    for (let index = 0; index < _ListaDes.length; index++) {
                        //const element = array[index];
                        objeto.producto = _ListaDes[index].Descripcion;
                        this.ProductoMes.push(objeto.producto);
                        objeto.galones_mes = _ListaDes[index].Galones;
                        this.GalonesTotalMes.push(objeto.galones_mes);
                        objeto.monto = _ListaDes[index].TotalDolares;
                        this.MontoTotalMes.push(objeto.monto);
                    }

                    this.totalesMes();
                })
                .catch((error) => {});
        },
        totalesMes() {
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
                type: "bar",

                data: totalesData,
                options: chartOptions,
                //options: chartOptions
            });
        },

        GenerarVentasDiariasFecha() {
            let url =
                this.$store.state.ApiGasquil +
                "Dashboard/GetVentasDiariosFechaApertura";

            let ListaVentasFecha = [];
            let _ListaComparar = ["DIESEL", "ECO", "SUPER", "ECOPLUS89"];
            const headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${this.$store.getters.tokeGasquil}`,
            };

            axios
                .get(url, { headers: headers })
                .then((response) => {
                    ListaVentasFecha = JSON.parse(response.data.Resp);
                    for (
                        let index = 0;
                        index < ListaVentasFecha.length;
                        index++
                    ) {
                        //llno mis datos
                        for (
                            let item = 0;
                            item < ListaVentasFecha[index].length;
                            item++
                        ) {
                            if (item == 0) {
                                this.IndiceVentas.push(
                                    ListaVentasFecha[index][item].dia.replace("T00:00:00", "")
                                );
                            }
                        }
                        // //
                        if (ListaVentasFecha[index].length == 4) {
                             console.log("entro en el 4 ",ListaVentasFecha[index].length);
                        console.log("-------------------------------");
                            for (
                                let item = 0;
                                item < ListaVentasFecha[index].length;
                                item++
                            ) {
                                let _descripcion = "";
                                _descripcion = ListaVentasFecha[index][
                                    item
                                ].descripcion
                                    .toString()
                                    .replace(/\s+/g, "");

                                if (
                                    _descripcion == "DIESEL".replace(/\s+/g, "")
                                ) {
                                    this.GalonesDieselDiariaApertura.push(ListaVentasFecha[index][item].galones);
                                    this.MontoDieselDiariaApertura.push(
                                        ListaVentasFecha[index][item].total
                                    );
                                }
                                if (_descripcion == "ECO".replace(/\s+/g, "")) {
                                    this.GalonesEcoDiariaApertura.push(
                                        ListaVentasFecha[index][item].galones
                                    );
                                    this.MontoEcoDiariaApertura.push(
                                        ListaVentasFecha[index][item].total
                                    );
                                }
                                if (
                                    _descripcion == "SUPER".replace(/\s+/g, "")
                                ) {
                                    this.GalonesSuperDiariaApertura.push(
                                        ListaVentasFecha[index][item].galones
                                    );
                                    this.MontoSuperDiariaApertura.push(
                                        ListaVentasFecha[index][item].total
                                    );
                                }
                                if (
                                    _descripcion ==
                                    "ECOPLUS89".replace(/\s+/g, "")
                                ) {
                                    this.GalonesEcoPlusDiariaApertura.push(
                                        ListaVentasFecha[index][item].galones
                                    );
                                    this.MontoEcoPlusDiariaApertura.push(
                                        ListaVentasFecha[index][item].total
                                    );
                                }
                            }
                        }
                       
                        if (ListaVentasFecha[index].length == 3 || ListaVentasFecha[index].length == 2  ) {
                            console.log("entro en el 3 ",ListaVentasFecha[index].length);
                        console.log("-------------------------------");
                            let _listaExiste3 = [];
                            for (
                                let item2 = 0;
                                item2 < ListaVentasFecha[index].length;
                                item2++
                            ) {
                                let _descripcion = "";
                                _descripcion = ListaVentasFecha[index][item2].descripcion.replace(/\s+/g, "");

                               _listaExiste3.push(_descripcion);

                                if (
                                    _descripcion == "DIESEL".replace(/\s+/g, "")
                                ) {
                                    this.GalonesDieselDiariaApertura.push(
                                        ListaVentasFecha[index][item2].galones
                                    );
                                    this.MontoDieselDiariaApertura.push(
                                        ListaVentasFecha[index][item2].total
                                    );
                                }
                                if (_descripcion == "ECO".replace(/\s+/g, "")) {
                                    this.GalonesEcoDiariaApertura.push(
                                        ListaVentasFecha[index][item2].galones
                                    );
                                    this.MontoEcoDiariaApertura.push(
                                        ListaVentasFecha[index][item2].total
                                    );
                                }
                                if (
                                    _descripcion == "SUPER".replace(/\s+/g, "")
                                ) {
                                    this.GalonesSuperDiariaApertura.push(
                                        ListaVentasFecha[index][item2].galones
                                    );
                                    this.MontoSuperDiariaApertura.push(
                                        ListaVentasFecha[index][item2].total
                                    );
                                }
                                if (
                                    _descripcion ==
                                    "ECOPLUS89".replace(/\s+/g, "")
                                ) {
                                    this.GalonesEcoPlusDiariaApertura.push(
                                        ListaVentasFecha[index][item2].galones
                                    );
                                    this.MontoEcoPlusDiariaApertura.push(
                                        ListaVentasFecha[index][item2].total
                                    );
                                }
                            }

                     
                           
                            let _listaResult = [];

                            for (var i of _ListaComparar) {
                                //console.log(i+"----> for 1")
                                let _resultList = _listaExiste3.filter(
                                    (element) => element == i
                                );
                                
                                if (_resultList.length == 0) {
                                
                                    _listaResult.push(i);
                                }
                            }
                            console.log("_listaResult",_listaResult);
                            for (var j of _listaResult) {
                                if (
                                    j == "DIESEL".replace(/\s+/g, "")
                                ) {
                                    this.GalonesDieselDiariaApertura.push(0);
                                    this.MontoDieselDiariaApertura.push(0);
                                }
                                if (j == "ECO".replace(/\s+/g, "")) {
                                    this.GalonesEcoDiariaApertura.push(0);
                                    this.MontoEcoDiariaApertura.push(0);
                                }
                                if (
                                    j == "SUPER".replace(/\s+/g, "")
                                ) {
                                    this.GalonesSuperDiariaApertura.push(0);
                                    this.MontoSuperDiariaApertura.push(0);
                                }
                                if (
                                    j ==
                                    "ECOPLUS89".replace(/\s+/g, "")){
                                        this.GalonesEcoPlusDiariaApertura.push(0);
                                    this.MontoEcoPlusDiariaApertura.push(0);

                                    }
                            }
                             

                           console.log("_listaResult", _listaResult);
                        }

                       
                    }

                    console.log("IndiceVentas", this.IndiceVentas);

                    console.log(
                        "GalonesEcoDiariaApertura",
                        this.GalonesEcoDiariaApertura
                    );
                    console.log(
                        "GalonesDieselDiariaApertura",
                        this.GalonesDieselDiariaApertura
                    );
                    console.log(
                        "GalonesSuperDiariaApertura",
                        this.GalonesSuperDiariaApertura
                    );
                     
                    console.log(
                        "GalonesEcoPlusDiariaApertura",
                        this.GalonesEcoPlusDiariaApertura
                    );

                  
                    this.totalesDiarias();
                    this.totalesDiariasMonto();
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
            var CirEcoPlus = {
                label: "Eco-Plus",
                data: this.GalonesEcoPlusDiariaApertura,
             //  backgroundColor: "rgba(255, 0, 0, 1)",
                borderColor: "rgba(255, 0, 0, 1)",
                fill:false,
                lineTension: 0,
                // fill: false,
                // borderColor: "orange",
                // backgroundColor: "transparent",
                //   borderDash: [5, 5],
                // pointBorderColor: "orange",
                // pointBackgroundColor: "rgba(255,150,0,0.5)",
                // pointRadius: 5,
                // pointHoverRadius: 10,
                // pointHitRadius: 30,
                // pointBorderWidth: 1,
                // pointStyle: "rectRounded",
            };
            var totalesData = {
                labels: this.IndiceVentas,
                datasets: [CirEco, CirDiesel, CirSuper, CirEcoPlus],
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
            var CirEcoPlus = {
                label: "Eco-Plus/Monto",
                data: this.MontoEcoPlusDiariaApertura,
                backgroundColor: "rgba(255, 0, 0, 1)",
                borderColor: "rgba(99, 132, 0, 1)",
                lineTension: 0,
                fill: false,
                borderColor: "orange",
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

            var totalesData = {
                labels: this.IndiceVentas,
                datasets: [CirEco, CirDiesel, CirSuper, CirEcoPlus],
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
            let url =
                this.$store.state.ApiGasquil +
                "Dashboard/GetVentasDiariosFechaAperturaMes";

            let ListaVentasFechaMes = [];
            const headers = {
                "Content-Type": "application/json",
                Authorization: `Bearer ${this.$store.getters.tokeGasquil}`,
            };

            axios
                .get(url, { headers: headers })
                .then((response) => {
                    ListaVentasFechaMes = JSON.parse(response.data.Resp);
                    // console.log("ListaVentasFechaMes", ListaVentasFechaMes);

                    for (
                        let index = 0;
                        index < ListaVentasFechaMes.length;
                        index++
                    ) {
                        // console.log("element", ListaVentasFechaMes[index]);

                        // for (const key in ListaVentasFechaMesAper[index]) {
                        //     console.log("element",ListaVentasFechaMesAper[index][key]);
                        // }
                        // const element = ListaVentasFechaMesAper[index];

                        for (
                            let item = 0;
                            item < ListaVentasFechaMes[index].length;
                            item++
                        ) {
                            if (item == 0) {
                                this.IndiceVentasMes.push(
                                    funcionesGlobales.MesesNumeros(
                                        ListaVentasFechaMes[index][item].mes
                                    )
                                );
                            }
                            if (
                                ListaVentasFechaMes[index][item].descripcion ==
                                "DIESEL"
                            ) {
                                this.GalonesDieselDiariaAperturaMes.push(
                                    ListaVentasFechaMes[index][item].galones
                                );
                                this.MontoDieselDiariaAperturaMes.push(
                                    ListaVentasFechaMes[index][item].total
                                );
                            }
                            if (
                                ListaVentasFechaMes[index][item].descripcion ==
                                "ECO"
                            ) {
                                this.GalonesEcoDiariaAperturaMes.push(
                                    ListaVentasFechaMes[index][item].galones
                                );
                                this.MontoEcoDiariaAperturaMes.push(
                                    ListaVentasFechaMes[index][item].total
                                );
                            }
                            if (
                                ListaVentasFechaMes[index][item].descripcion ==
                                "SUPER"
                            ) {
                                this.GalonesSuperDiariaAperturaMes.push(
                                    ListaVentasFechaMes[index][item].galones
                                );
                                this.MontoSuperDiariaAperturaMes.push(
                                    ListaVentasFechaMes[index][item].total
                                );
                            }
                            // if (ListaVentasFechaMes[index][item].descripcion == "ECOPLUS 89") {
                            //     this.GalonesEcoPlusDiariaAperturaMes.push(ListaVentasFechaMes[index][item].galones);                                    t
                            //     this.MontoEcoPlusDiariaAperturaMes.push(ListaVentasFechaMes[index][item].total);

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
            var CirEcoPlus = {
                label: "Eco-Plus",
                data: this.GalonesEcoPlusDiariaAperturaMes,
                backgroundColor: "rgb(255, 0, 0, 1)",
                borderColor: "rgb(99, 132, 0, 1)",
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

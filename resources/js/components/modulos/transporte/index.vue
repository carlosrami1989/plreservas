<template>
    <div>
        <v-divider></v-divider>
        <br />
        <br />
        <br />
        <v-row>
            
            <v-col cols="12" sm="3" md="3">
                <v-card max-width="250" elevation="24">
                    <v-card-text>
                        <v-btn color="success" height="auto" class="outlined">
                            <v-icon size="80"> mdi-upload </v-icon>
                        </v-btn>
                        
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <router-link to="/modulos/transporte/upload">
                            <v-chip color="success"  active>Cargar Archivo </v-chip>
                        </router-link>
                    </v-card-actions>
                </v-card>
            </v-col>
      
       
            
            <v-col cols="12" sm="3" md="3">
                
                <v-card max-width="250" elevation="24">
                    <v-card-text>
                        <v-btn color="orange" height="auto" class="outlined">
                            <v-icon size="80">mdi-train-car</v-icon>
                        </v-btn>
                      
                    </v-card-text>
                    <v-divider></v-divider>

                    <v-card-actions>
                        <router-link to="/modulos/transporte/complemento">
                            <v-chip color="orange">Complementación</v-chip>
                        </router-link>
                    </v-card-actions>
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
            rating1: 5,
            rating2: 4.5,

            items: [
                {
                    text: "Guayaquil",
                    icon: "mdi-city",
                    color: "purple darken-3",
                },
                {
                    text: "Duran",
                    icon: "mdi-home-city",
                    color: "indigo darken-1",
                },
                {
                    text: "Daule",
                    icon: "mdi-city-variant-outline",
                    color: "green darken-2",
                },
            ],

            chartData: {
                labels: [],
                series: [
                    [1, 2],
                    [4, 5],
                ],
            },
            chartOptions: {
                lineSmooth: false,
            },
            datos: null,
            chardatos: null,
            datos: [],
            vardatosTotal: [],
            vardatosMes: [],
            value: [],
            datos: {
                total_r: 0,
                total_k_d: 0,
                total_k_t: 0,
            },
            valor: [],
            rutas: {
                guayaquil: "",
                cerecita: "",
                gashouse: "",
                churute: "",
                carchi: "",
                sevilla_oro: "",
            },
        };
    },
    mounted() {
        this.rutas.guayaquil = prefix + "/modulos/bi/dashboardGasquil";
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

        consultasTotales() {
            let that = this;
            let url =
                this.$store.getters.getRuta +
                "/modulos/admision/paciente/ConsultaDatos";

            axios
                .get(url)
                .then(function (response) {
                    //  that.valor = response.data.data;
                    that.datos.total_r = response.data.toal_registro;
                    that.datos.total_k_d = response.data.kilos_dia;
                    that.datos.total_k_t = response.data.kilos_total;
                })
                .catch((error) => {
                    //Errores de validación
                });
        },
        consultasDashboard() {
            let that = this;
            let url =
                this.$store.getters.getRuta +
                "/modulos/admision/paciente/graficosPorDia";

            axios
                .get(url)
                .then(function (response) {
                    that.valor = response.data.data;
                    let objeto = {};
                    for (let index = 0; index < that.valor.length; index++) {
                        //const element = array[index];
                        objeto.fecha = that.valor[index].fech;
                        that.labels.push(objeto.fecha);

                        objeto.peso = that.valor[index].total;
                        that.value.push(objeto.peso);
                    }
                    that.totalesCirugia();
                })
                .catch((error) => {
                    //Errores de validación
                });
        },
        totalesCirugia() {
            var cirSuspendida = {
                label: "DESECHOS POR DIA",
                data: this.value,
                backgroundColor: "rgba(255, 0, 0, 1)",
                borderColor: "rgba(99, 132, 0, 1)",
                lineTension: 0,
                fill: false,
                borderColor: "orange",
                backgroundColor: "transparent",
                borderDash: [5, 5],
                pointBorderColor: "orange",
                pointBackgroundColor: "rgba(255,150,0,0.5)",
                pointRadius: 5,
                pointHoverRadius: 10,
                pointHitRadius: 30,
                pointBorderWidth: 2,
                pointStyle: "rectRounded",
            };

            var totalesData = {
                labels: this.labels,
                datasets: [cirSuspendida],
            };

            var chartOptions = {
                scales: {
                    xAxes: [
                        {
                            barPercentage: 1,
                            categoryPercentage: 0.6,
                        },
                    ],
                    yAxes: [
                        {
                            id: "y-axis-density",
                        },
                        {
                            id: "y-axis-gravity",
                        },
                    ],
                },
            };

            this.vardatos = document
                .getElementById("ingresospacientes")
                .getContext("2d");

            this.chardatos = new Chart(this.vardatos, {
                type: "line",

                data: totalesData,
                options: chartOptions,
                //options: chartOptions
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
</style>

 
</style>


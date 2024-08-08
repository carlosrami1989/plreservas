<template>
    <div>
        <v-row>
            <v-col cols="12">
                <h2>CONTROL DE CALIDAD / INSPECCIÓN TÉCNICA / CHECK LIST</h2>
                <br />
                <v-row align="center">
                    <v-col>
                        <v-btn color="success">
                            <v-icon color="white">mdi-check-circle</v-icon>REVISADO OK</v-btn>
                    </v-col>
                    <v-col>
                        <v-btn color="amber">
                            <v-icon>mdi-alert</v-icon>REQUIERE ATENCIÓN
                            FUTURA</v-btn>
                    </v-col>
                    <v-col>
                        <v-btn color="red">
                            <v-icon>mdi-close-circle</v-icon>REQUIERE ATENCIÓN
                            INMEDIATA</v-btn>
                    </v-col>
                </v-row>
                <br />
                <v-stepper max-width="auto" v-model="e6" vertical>
                    <v-stepper-step :complete="e6 > 1" step="1" editable>
                        Seleccione el cliente
                        <small>Cliente :
                            <h1>{{ searchClientes }}</h1>
                        </small>
                    </v-stepper-step>

                    <v-stepper-content step="1">
                        <v-card class="mb-12">
                            <v-toolbar dark color="primary">
                                <v-toolbar-title>Seleccione Cliente</v-toolbar-title>
                                <v-autocomplete v-model="selectCliente" :loading="loading" :items="itemsCliente"
                                    :search-input.sync="searchClientes" cache-items item-text="FULLNAME" item-value="id"
                                    class="mx-4" flat hide-no-data hide-details @change="SeleccionCliente"
                                    label="Nombres y apellidos" solo-inverted></v-autocomplete>
                            </v-toolbar>
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12" md="4">
                                        <v-text-field v-model="ListCabecera.km" :rules="nameRules" :counter="10"
                                            label="Ingrese Km" required></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12" md="6">
                                        <v-textarea v-model="ListCabecera.motivo" :rules="nameRules" color="teal">
                                            <template v-slot:label>
                                                <div>
                                                    <small>(Motivo)</small>
                                                </div>
                                            </template>
                                        </v-textarea>
                                    </v-col>

                                    <v-col cols="12" md="4">
                                        <v-textarea v-model="ListCabecera.observacion" :rules="nameRules" color="teal">
                                            <template v-slot:label>
                                                <div>
                                                    <small>(Observacion)</small>
                                                </div>
                                            </template>
                                        </v-textarea>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                        <v-btn color="primary" @click="e6 = 2">
                            Continue
                        </v-btn>
                        <v-btn text> Cancel </v-btn>
                    </v-stepper-content>

                    <v-stepper-step :complete="e6 > 2" step="2" editable>
                        INSPECCIÓN PRE-OPERATIVAS (CHECK LIST)
                    </v-stepper-step>

                    <v-stepper-content step="2">
                        <v-card class="mb-12">
                            <template>
                                <v-data-table :headers="ListDescripcion" :items="ListDetalles" :single-expand="singleExpand"
                                    :expanded.sync="expanded" item-key="descripcion" show-expand class="elevation-1"
                                    color="red">
                                    <template v-slot:expanded-item="{ headers, item }">
                                        <td :colspan="headers.length" max-height="auto">
                                            <v-data-table max-width="auto" :headers="ListItems" :items="item.items"
                                                class="elevation-1" :hide-default-footer="true" :items-per-page="-1"
                                                v-model="selectedListItems">
                                                <template v-slot:item.accion="{ item, isSelected, select }">
                                                    <v-radio-group row>
                                                        <v-radio label="Revisado ok" color="success"
                                                            :value="'rbta' + item.id"
                                                            @click="consultaItem(item, 1)"></v-radio>

                                                        <v-radio color="amber" :value="'rbtb' + item.id"
                                                            label="Atencion Futura" @click="consultaItem(item, 2)"></v-radio>


                                                        <v-radio color="red" :value="'rbtc' + item.id"
                                                            label="Atencion Inmediata"
                                                            @click="consultaItem(item, 3)"></v-radio>
                                                    </v-radio-group>

                                                </template></v-data-table>
                                        </td>
                                    </template>
                                </v-data-table>
                            </template>
                        </v-card>
                        <v-btn color="primary" @click="e6 = 3">
                            Continue
                        </v-btn>
                        <v-btn text> Cancel </v-btn>
                    </v-stepper-content>

                    <v-stepper-step :complete="e6 > 3" step="3">
                        Select an ad format and name ad unit
                    </v-stepper-step>

                    <v-stepper-content step="3">
                        <v-card class="mb-12">
                        </v-card>
                        aqui
                        <v-btn color="primary" @click="e6 = 4">
                            Continue
                        </v-btn>
                        <v-btn text> Cancel </v-btn>
                    </v-stepper-content>

                    <v-stepper-step step="4">
                        View setup instructions
                    </v-stepper-step>
                    <v-stepper-content step="4">
                        <v-card color="grey lighten-1" class="mb-12" height="200px"></v-card>
                        <v-btn color="primary" @click="e6 = 1">
                            Continue
                        </v-btn>
                        <v-btn text> Cancel </v-btn>
                    </v-stepper-content>
                </v-stepper>
            </v-col>
        </v-row>
    </div>
</template>
<script>
import { prefix, url } from "../../../../variables";

export default {
    props: {
        user: {
            type: Object,
        },
    },
    data() {
        return {
            e6: 1,
            rating1: 5,
            rating2: 4.5,
            ///ciente
            itemsCliente: [],
            loading: false,
            items: [],
            valorClientes: [],
            searchClientes: null,
            selectCliente: null,
            nameRules: [
                (v) => !!v || "El campo es requerido",
                (v) =>
                    (v && v.length <= 100) ||
                    "Name must be less than 10 characters",
            ],
            //end cliente   :prepend-icon="icon"
            ListaCliente: [],
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

            ListCabecera: {
                id_cliente: 0,
                orden_entrada: 0,
                orden_salida: 0,
                km: 0,
                fecha_revision: "",
                hora_revision: "",
                cedula_entrega: "",
                cedula_recibe: "",
                firma_entrega: "",
                firma_recibe: "",
                motivo: "",
                observacion: "",
                estado: 1,
            },
            ListDetallePost: [],

            //*** check list */
            iconosbutton: "",
            singleSelect: false,
            selectedListItems: [],
            selectItem: [],
            itemsIndicador: [
                { id: "1", descripcion: "REVISADO" },
                { id: "2", descripcion: "REQUIERE ATENCION" },
                { id: "3", descripcion: "ATENCION FUTURA" },
            ],
            DtmodelList: [],
            expanded: [],
            singleExpand: false,
            ListDescripcion: [
                {
                    text: "id",
                    align: "start",
                    sortable: false,
                    value: "id",
                    with: 10,
                },
                { text: "descripcion", value: "descripcion" },

                { text: "", value: "data-table-expand" },
            ],
            ListDetalles: [],

            ListItems: [
                {
                    text: "id",
                    align: "start",

                    value: "id",
                },
                { text: "descripcion", value: "descripcion_items" },

                { text: "", value: "accion" },
            ],

            /** */
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
            ListasCkeck: [],
        };
    },
    watch: {
        // itemsCliente(val) {
        //     // val && val !== this.select && this.querySelections(val);
        //     console.log("val",val);
        // },
    },

    mounted() {
        this.rutas.guayaquil = prefix + "/modulos/bi/dashboardGasquil";
        this.consultaCliente();
        this.consultaDescrpcion();
        // this.consultasDashboard();
        // this.totalesCirugia();
    },
    methods: {
        consultaItem(value, value2) {
            let objeto = {};
            if (this.ListasCkeck.length == 0) {

                objeto.descripcion_items = value.descripcion_items;
                objeto.id = value.id;
                objeto.id_descripcion = value.id_descripcion;
                objeto.inspeccion = value2;
                this.ListasCkeck.push(objeto);

            } else {
                var buscar_objeto = this.ListasCkeck.findIndex((obj => obj.id === value.id))
                if (buscar_objeto != -1) {
                    this.ListasCkeck.splice(buscar_objeto, 1);
                }
              
                objeto.descripcion_items = value.descripcion_items;
                objeto.id = value.id;
                objeto.id_descripcion = value.id_descripcion;
                objeto.inspeccion = value2;
                this.ListasCkeck.push(objeto);
            }


            console.log("buscar_objeto", buscar_objeto);
            console.log("ListasCkeck", this.ListasCkeck);
            //     let $ref =this.$refs['vbtn' + value.id];
            //     $ref.color = "green";
            //    // $ref.style.backgroundColor = '#66bb6a';
            //     //this.$refs['vbtn' + value.id].color="green";
            //     console.log(  "vbtn",$ref.color );
            //     // if (value2 == 1) {
            //   //this.$refs.btnIcono1.color == "success";
            //   console.log(  this.btnIcono1);
            // }
            // if (value2 == 2) {
            //     this.iconosbutton = "mdi-alert"
            // }
            // if (value2 == 3) {
            //     this.iconosbutton = "mdi-close-circle"
            // }
            // let objeto = {};
            // objeto.id_control_calidad = 0;
            // objeto.id_descripcion = value.id_descripcion;
            // objeto.id_items = value.id_items;
            // objeto.inspeccion = value2;
            // objeto.presion = 0;
            // objeto.medida = 0;
            // objeto.anio = 0;
            // objeto.estado = 1;
            // this.ListDetallePost.push(objeto);


        },
        consultaDescrpcion() {
            let url =
                this.$store.getters.getRuta +
                "/modulos/transporte/transporte/GetDescripcion";

            axios
                .get(url)
                .then((response) => {
                    this.ListDetalles = response.data.data;
                })
                .catch((error) => {
                    //Errores de validación
                });
        },
        SeleccionCliente(e) {
            // console.log(value);
            const resultado = this.itemsCliente.find((item) => item.id === e);
            this.ListaCliente = resultado;

            console.log("resultado", this.ListaCliente);
            // window.open(
            //     this.$store.getters.getRuta +
            //         "/modulos/admision/paciente/generacionExcel"
            // );
        },
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
        consultaCliente() {
            let url =
                this.$store.getters.getRuta +
                "/modulos/transporte/transporte/GetCliente";

            axios
                .get(url)
                .then((response) => {
                    this.itemsCliente = response.data.data;
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
.v-btn.outlined {
    position: relative;
    top: -40px;
    left: 0px;
}
</style>

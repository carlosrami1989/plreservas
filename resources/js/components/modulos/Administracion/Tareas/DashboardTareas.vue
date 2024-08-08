<template>
    <div>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-tabs
                        v-model="tab"
                        background-color="deep-purple accent-4"
                        dark
                        icons-and-text
                        max-width="auto"
                        max-height="800"
                    >
                        <v-tabs-slider></v-tabs-slider>

                        <v-tab href="#tab-1">
                            DasBoard
                            <v-icon>mdi-view-dashboard</v-icon>
                        </v-tab>

                        <v-tab href="#tab-2">
                            Detalles
                            <v-icon>mdi-search-web</v-icon>
                        </v-tab>

                        <v-tab href="#tab-3">
                            Calendario
                            <v-icon>mdi-calendar</v-icon>
                        </v-tab>
                    </v-tabs>

                    <v-tabs-items v-model="tab">
                        <v-tab-item value="tab-1">
                            <br />
                            <v-row>
                                <v-col cols="12" md="3">
                                    <!-- la primera card -->
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
                                    <!-- fin -->
                                </v-col>

                                <v-col cols="12" md="3">
                                    <!-- la primera card -->
                                    <v-card
                                        max-height="344"
                                        max-width="200"
                                        elevation="24"
                                    >
                                        <v-card-title primary-title>
                                            <v-icon
                                                class="outlined"
                                                size="70"
                                                color="orange darken-1"
                                            >
                                                mdi-cogs</v-icon
                                            >

                                            <v-btn color="orange lighten-2" text
                                                >Segui.
                                            </v-btn>
                                        </v-card-title>

                                        <v-card-subtitle> </v-card-subtitle>
                                    </v-card>
                                    <!-- fin -->
                                </v-col>
                            </v-row>
                            <br />
                        </v-tab-item>
                        <v-tab-item value="tab-2">
                            <v-card flat>
                                <v-card>
                                    <v-card-title>
                                        <v-text-field
                                            v-model="BusquedaCabecera"
                                            append-icon="mdi-magnify"
                                            label="Busqueda de Tareas"
                                            single-line
                                            hide-details
                                        ></v-text-field>
                                    </v-card-title>
                                    <v-data-table
                                        :headers="Cabeceratareas"
                                        :items="ListaTareas"
                                        :search="BusquedaCabecera"
                                        class="elevation-1"
                                    >
                                        <template
                                            v-slot:item.porcentaje="{ item }"
                                        >
                                            <v-progress-linear
                                                v-model="item.porcentaje"
                                                :color="
                                                    getColor(item.porcentaje)
                                                "
                                                height="25"
                                            >
                                                <template v-slot:default="{}">
                                                    <strong
                                                        >{{
                                                            item.porcentaje
                                                        }}%</strong
                                                    >
                                                </template>
                                            </v-progress-linear>
                                        </template>
                                        <template
                                            v-slot:item.acciones="{ item }"
                                        >
                                            <v-icon color="indigo" class="mr-2">
                                                mdi-pencil
                                            </v-icon>
                                            <v-icon
                                                color="purple"
                                                @click="
                                                    GenerarModalSeguimientoVisulizar(
                                                        item
                                                    )
                                                "
                                                class="mr-2"
                                            >
                                                mdi-eye-circle
                                            </v-icon>
                                            <v-icon
                                                color="blue"
                                                class="mr-2"
                                                @click="
                                                    GenerarModalSeguimiento(
                                                        item
                                                    )
                                                "
                                            >
                                                mdi-file-document
                                            </v-icon>
                                        </template>
                                    </v-data-table>
                                </v-card>
                            </v-card>
                        </v-tab-item>
                        <v-tab-item value="tab-3">
                            <div style="overflow: scroll;">
                                <iframe
                                src="https://calendar.google.com/calendar/embed?src=calendario%40copedesa.com&ctz=America%2FGuayaquil"
                                style="border: 0"
                                width="1200"
                                height="600"
                                frameborder="0"
                                scrolling="no"
                            ></iframe>
                            </div>
                           
                        </v-tab-item>
                    </v-tabs-items>
                </v-card>
            </v-col>
        </v-row>
        <!-- empieza el dialogo -->
        <v-row justify="center">
            <v-dialog v-model="dialog" persistent max-width="600px">
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-card>
                        <v-card-title>
                            <span class="text-h5">Ingreso de Tareas</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            label="Tarea principal"
                                            hint="Descripción de la tarea principal"
                                            v-model="tarea.descripcion"
                                            :rules="nameRules"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field
                                            label="Observación"
                                            hint="Observación de la tarea"
                                            v-model="tarea.observacion"
                                            :rules="nameRules"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6">
                                        <v-combobox
                                            v-model="modelEmpresa"
                                            :items="itemsEmpresa"
                                            :search-input.sync="searchEmpresa"
                                            hide-selected
                                            item-text="razon_social"
                                            item-value="id"
                                            label="Seleccione la empresa"
                                            :rules="nameRulesCmb"
                                            persistent-hint
                                            small-chips
                                        >
                                            <template v-slot:no-data>
                                                <v-list-item>
                                                    <v-list-item-content>
                                                        <v-list-item-title>
                                                            No results matching
                                                            "<strong>{{
                                                                searchEmpresa
                                                            }}</strong
                                                            >". Press
                                                            <kbd>enter</kbd> to
                                                            create a new one
                                                        </v-list-item-title>
                                                    </v-list-item-content>
                                                </v-list-item>
                                            </template>
                                        </v-combobox>
                                    </v-col>
                                    <v-col cols="12" sm="6">
                                        <v-combobox
                                            v-model="modelPrincipal"
                                            :items="itemsPrincipal"
                                            :search-input.sync="searchPrincial"
                                            hide-selected
                                            item-text="FULLNAME"
                                            item-value="id"
                                            label="Seleccione Lider de la Tarea"
                                            :rules="nameRulesCmb"
                                            persistent-hint
                                            small-chips
                                        >
                                            <template v-slot:no-data>
                                                <v-list-item>
                                                    <v-list-item-content>
                                                        <v-list-item-title>
                                                            No results matching
                                                            "<strong>{{
                                                                searchPrincial
                                                            }}</strong
                                                            >". Press
                                                            <kbd>enter</kbd> to
                                                            create a new one
                                                        </v-list-item-title>
                                                    </v-list-item-content>
                                                </v-list-item>
                                            </template>
                                        </v-combobox>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-combobox
                                            v-model="modelAdicional"
                                            :items="itemsAdicional"
                                            :search-input.sync="searchAdicional"
                                            hide-selected
                                            item-text="FULLNAME"
                                            item-value="id"
                                            label="Seleccione Involucrados"
                                            multiple
                                            persistent-hint
                                            small-chips
                                        >
                                            <template v-slot:no-data>
                                                <v-list-item>
                                                    <v-list-item-content>
                                                        <v-list-item-title>
                                                            No results matching
                                                            "<strong>{{
                                                                searchAdicional
                                                            }}</strong
                                                            >". Press
                                                            <kbd>enter</kbd> to
                                                            create a new one
                                                        </v-list-item-title>
                                                    </v-list-item-content>
                                                </v-list-item>
                                            </template>
                                        </v-combobox>
                                    </v-col>

                                    <v-col cols="12" align="center">
                                        <v-date-picker
                                            justify="center"
                                            v-model="dates"
                                            range
                                        ></v-date-picker>
                                    </v-col>
                                    <v-col cols="12" align="center">
                                        <v-text-field
                                            v-model="dateRangeText"
                                            label="Fecha de inicio y final del proyecto"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                        ></v-text-field>
                                        model: {{ dates }}
                                        <br />
                                        <span style="color: red">
                                            {{ MsjAutorizacion }}</span
                                        >
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="dialog = false"
                            >
                                Cerrar
                            </v-btn>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="handleAuthClick()"
                            >
                                Autenticacion
                            </v-btn>
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="grabarTarea()"
                            >
                                Grabar Tarea
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-form>
            </v-dialog>
        </v-row>
        <!-- dialogo de seguimiento -->

        <!-- empieza el dialogo -->
        <v-row justify="center">
            <v-dialog v-model="dialogSeguimiento" persistent max-width="600px">
                <v-form ref="formSeguimiento" v-model="valid" lazy-validation>
                    <v-card>
                        <v-card-title>
                            <span class="text-h5">Ingreso de Seguimiento</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            label="Titulo"
                                            hint="Titulo de seguimiento"
                                            v-model="SeguimientoTarea.titulo"
                                            :rules="nameRules"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-text-field
                                            label="Observación"
                                            hint="Observación del Seguimiento"
                                            v-model="
                                                SeguimientoTarea.observacion
                                            "
                                            :rules="nameRules"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12">
                                        <v-file-input
                                            label="Agregar Documento / fotos "
                                            filled
                                            prepend-icon="mdi-camera"
                                        ></v-file-input>
                                    </v-col>
                                    <v-col cols="12" sm="4" md="4">
                                        <v-checkbox
                                            v-show="showFinalizar"
                                            v-model="
                                                SeguimientoTarea.chk_finalizar
                                            "
                                            label="Finalizar Tarea"
                                            color="success"
                                            hide-details
                                        ></v-checkbox>
                                    </v-col>
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
                            <v-btn
                                color="blue darken-1"
                                text
                                @click="grabarSeguimientoTarea()"
                            >
                                Agregar Seguimiento
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-form>
            </v-dialog>
        </v-row>
        <!-- fin del dialogo -->
        <!-- empieza el dialogo seguimiento -->
        <v-row justify="center">
            <v-dialog
                v-model="dialogSeguimientoVisualizar"
                persistent
                max-width="600px"
            >
                <v-card>
                    <v-card-title>
                        <span class="text-h5">Seguimientos Ingresados</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12">
                                    <v-timeline align-top dense>
                                        <v-timeline-item
                                            v-for="item in ListaTareasSeguimientoV"
                                            :key="item.id"
                                            :color="
                                                GetCadenaColor(item.id_perfil)
                                            "
                                            large
                                        >
                                            <template v-slot:icon>
                                                <span class="white--text">{{
                                                    GetCadena(item.nombres)
                                                }}</span>
                                            </template>
                                            <v-row class="pt-1">
                                                <v-col cols="3">
                                                    <strong>{{
                                                        item.fecha_seguimiento
                                                    }}</strong>
                                                </v-col>
                                                <v-col>
                                                    <strong>{{
                                                        item.titulo
                                                    }}</strong>
                                                    <div
                                                        class="text-caption mb-2"
                                                    >
                                                        {{ item.observacion }}
                                                    </div>
                                                    <v-icon color="orange"
                                                        >mdi-camera</v-icon
                                                    >
                                                </v-col>
                                            </v-row>
                                        </v-timeline-item>
                                    </v-timeline>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="blue darken-1"
                            text
                            @click="CerrarModal()"
                        >
                            Cerrar
                        </v-btn>
                        <v-btn
                            color="blue darken-1"
                            text
                            @click="grabarSeguimientoTarea()"
                        >
                            Agregar Seguimiento
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
        <!-- fin del dialogo -->

        <v-row>
            <v-col cols="12"> </v-col>
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
        <!-- finaliza el dialogo -->
    </div>
    <!-- aqui termina :v -->
</template>

<script>
import moment from "moment";
const CLIENT_ID =
    "857376504585-qbak552vvvegamk3nmvkuceqjtuhbhsl.apps.googleusercontent.com";
const API_KEY = "AIzaSyCvsm3qol8_KS0q20cMFF7Lab6tSC3jl0s";
const DISCOVERY_DOCS = [
    "https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest",
];
const SCOPES = "https://www.googleapis.com/auth/calendar";
export default {
    data() {
        return {
            tab: null,
            //DatosTareas
            Cabeceratareas: [
                {
                    text: "Id Tareas",
                    align: "start",
                    filterable: false,
                    value: "id",
                },
                { text: "Empresa", value: "razon_social" },
                { text: "Apellidos", value: "apellidos" },
                { text: "Nombres", value: "nombres" },
                { text: "Tarea", value: "descripcion" },
                { text: "Total Segui.", value: "totales_count" },
                {
                    text: "Tiempo de finalización ",
                    value: "porcentaje",
                    width: "20%",
                },
                { text: "Acciones", value: "acciones", width: "15%" },
            ],
            ListaTareas: [],
            ListaTareasSeguimientoV: [],
            BusquedaCabecera: "",
            //validacion
            valid: false,
            allowSpaces: false,
            match: "Foobar",
            max: 1,
            model: "Foobar",
            showFinalizar: false,
            // mensajes de alerta
            snackbar: false,
            text: "",
            timeout: 4000,
            color: "purple darken-4",
            icono: "mdi-checkbox-marked",
            ///
            modelEmpresa: null,
            itemsEmpresa: [],
            searchEmpresa: null,

            modelPrincipal: null,
            itemsPrincipal: [],
            searchPrincial: null,
            //model para correos y persona
            modelAdicional: [],
            itemsAdicional: [],
            searchAdicional: null,
            // arreglo de tarea
            tarea: {
                id: 0,
                id_empresa: 0,
                descripcion: "",
                observacion: "",
                id_persona: 0,
                estado_tarea: 1,
                estado: 1,
                fecha_ini: 0,
                fecha_fin: 0,
            },
            SeguimientoTarea: {
                id_tareas: 0,
                titulo: "",
                observacion: "",
                ruta_imagen: "",
                chk_finalizar: false,
            },

            dates: ["2023-01-10", "2023-01-20"],
            dialog: false,
            dialogSeguimiento: false,
            dialogSeguimientoVisualizar: false,
            nameRules: [
                (v) => !!v || "El campo es requerido",
                (v) =>
                    (v && v.length <= 100) ||
                    "Name must be less than 10 characters",
            ],
            nameRulesCmb: [
                (v) => !!v || "El campo es requerido",
                // v => ( v == null) || 'Name must be less than 10 characters',
            ],
            valor: [],
            cont: 0,
            color_avatar: "",
            authorized: false,
            tokenClient: undefined,
            gapiInited: false,
            gisInited: false,
            items: null,
            /*** Arreglo de google */
            event: {
                summary: "",
                location: "",
                description: "",
                start: {
                    dateTime: "",
                    timeZone: "America/Bogota",
                },
                end: {
                    dateTime: "2023-02-23T10:00:00-07:00",
                    timeZone: "America/Bogota",
                },
                recurrence: ["RRULE:FREQ=DAILY;COUNT=2"],
                attendees: [],
                reminders: {
                    useDefault: false,
                    overrides: [
                        { method: "email", minutes: 24 * 60 },
                        { method: "popup", minutes: 10 },
                    ],
                },
            },
            ListaCorreo: [],
            MsjAutorizacion: "",
        };
    },
    created() {
        this.api = gapi;
        this.gapiLoaded();
        this.gisLoaded();
    },
    mounted() {
        //  google.accounts.id.prompt(); // also display the One Tap dialog
        // this.consultasTotales();
        // this.consultasDashboard();
        // this.totalesCirugia();
        this.consultasPersonas();
        this.consultasPersonasInvolucradas();
        this.consultasTareas();
        this.consultasEmpresas();
    },
    methods: {
        consultarExcel(value) {
            // console.log(value);

            window.open(
                this.$store.getters.getRuta +
                    "/modulos/admision/paciente/generacionExcel"
            );
        },
        mensajeAler(value, value2) {
            if (value2) {
                if (value) {
                    this.icono = "mdi-checkbox-marked";
                    (this.color = "green"), (this.snackbar = true);
                    this.text = "Transacción realizada de manera exitosa";
                } else {
                    this.icono = "mdi-close-box";
                    (this.color = "light-blue darken-4"),
                        (this.snackbar = true);
                    this.text = "Transacción actualizada de manera exitosa";
                }
            } else {
                this.icono = "mdi-close-box";
                (this.color = "red darken-4"), (this.snackbar = true);
                this.text = "Error en el sistema " + value;
            }
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
        consultasPersonas() {
            let that = this;
            let url =
                this.$store.getters.getRuta +
                "/modulos/admision/paciente/cargar_persona/1";

            axios
                .get(url)
                .then((response) => {
                    this.itemsPrincipal = response.data.persona;
                })
                .catch((error) => {
                    //Errores de validación
                });
        },
        consultasEmpresas() {
            let that = this;
            let url =
                this.$store.getters.getRuta +
                "/modulos/admision/paciente/GetEmpresa";

            axios
                .get(url)
                .then((response) => {
                    this.itemsEmpresa = response.data.listasEmpresas;
                })
                .catch((error) => {
                    //Errores de validación
                });
        },
        consultasPersonasInvolucradas() {
            let that = this;
            let url =
                this.$store.getters.getRuta +
                "/modulos/admision/paciente/cargar_persona/1";

            axios
                .get(url)
                .then((response) => {
                    this.itemsAdicional = response.data.persona;
                })
                .catch((error) => {
                    //Errores de validación
                });
        },
        grabarTarea() {
            console.log(this.$refs.form.validate());
            this.handleCreateEvent();
            //   return;
            if (this.$refs.form.validate()) {
                if (this.authorized) {
                    this.MsjAutorizacion = "";
                    let url =
                        this.$store.getters.getRuta +
                        "/modulos/admision/paciente/createTarea";

                    this.tarea.fecha_ini = this.dates[0];
                    this.tarea.fecha_fin = this.dates[1];
                    this.tarea.id_persona = this.modelPrincipal.id;
                    this.tarea.id_empresa = this.modelEmpresa.id;

                    let _Lista = {
                        tarea: this.tarea,
                        adicional: this.modelAdicional,
                    };

                    // console.log(this.tarea);
                    // return;

                    axios
                        .post(url, _Lista)
                        .then((response) => {
                            console.log(response.data.data);
                            this.mensajeAler(
                                "Tarea registrada con éxito",
                                true
                            );
                            this.dialog = false;
                            this.consultasTareas();
                            this.handleCreateEvent();
                            // this.itemsAdicional = response.data.data;
                        })
                        .catch((error) => {
                            let objeto = [];
                            objeto = Object.values(error.response.data.errors);
                            for (
                                let index = 0;
                                index < objeto.length;
                                index++
                            ) {
                                this.mensajeAler(objeto[index][0], false);
                            }
                        });
                } else {
                    this.MsjAutorizacion = "Necesita realizar la autorización";
                }
            }
        },

        grabarHorario() {
            // const CLIENT_ID = '145697386104-42tuvofm93tdf19jlggcfl9k32anq5vp.apps.googleusercontent.com';
            //   const API_KEY = 'AIzaSyDLIrLbOmahI1oKFeYk4BaOfo9csPGEFwU';

            //   // Discovery doc URL for APIs used by the quickstart
            //   const DISCOVERY_DOC = 'https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest';

            //   // Authorization scopes required by the API; multiple scopes can be
            //   // included, separated by spaces.
            //   const SCOPES = 'https://www.googleapis.com/auth/calendar';

            let gapiInited = false;
            let gisInited = false;
            this.gisLoaded();
            const event = {
                summary: "Google I/O 2015",
                location: "800 Howard St., San Francisco, CA 94103",
                description:
                    "A chance to hear more about Google's developer products.",
                start: {
                    dateTime: "2023-02-18T09:00:00-07:00",
                    timeZone: "America/Bogota",
                },
                end: {
                    dateTime: "2023-02-18T17:00:00-07:00",
                    timeZone: "America/Bogota",
                },
                recurrence: ["RRULE:FREQ=DAILY;COUNT=2"],
                attendees: [
                    { email: "cramirez@operoil.com" },
                    { email: "carlosrami1989@gmail.com" },
                ],
                reminders: {
                    useDefault: false,
                    overrides: [
                        { method: "email", minutes: 24 * 60 },
                        { method: "popup", minutes: 10 },
                    ],
                },
            };

            const request = gapi.client.calendar.events.insert({
                calendarId: "primary",
                resource: event,
            });
            request.execute(function (event) {
                // appendPre('Event created: ' + event.htmlLink);
            });
        },

        grabarSeguimientoTarea() {
            // console.log(this.$refs.formSeguimiento.validate());
            if (this.$refs.formSeguimiento.validate()) {
                let url =
                    this.$store.getters.getRuta +
                    "/modulos/admision/paciente/createSeguimientoTarea";

                // console.log(this.tarea);
                // return;

                axios
                    .post(url, this.SeguimientoTarea)
                    .then((response) => {
                        console.log(response.data.data);
                        this.mensajeAler(
                            "Seguimiento registrado con éxito",
                            true
                        );
                        this.dialogSeguimiento = false;
                        this.consultasTareas();
                        // this.itemsAdicional = response.data.data;
                    })
                    .catch((error) => {
                        let objeto = [];
                        objeto = Object.values(error.response.data.errors);
                        for (let index = 0; index < objeto.length; index++) {
                            this.mensajeAler(objeto[index][0], false);
                        }
                    });
            }
        },
        consultasTareas() {
            let that = this;
            let url = "/modulos/admision/paciente/GetTareas";

            axios
                .get(url)
                .then((response) => {
                    this.ListaTareas = response.data.listasTareas.sort(
                        (x, y) => y.porcentaje - x.porcentaje
                    );
                })
                .catch((error) => {
                    //Errores de validación
                });
        },
        getColor(porcentaje) {
            // let color = "";
            // switch (porcentaje) {
            //     case porcentaje > 100:
            //        color = "red";
            //         break;
            //     case porcentaje >80 :
            //         color = "orange";
            //         break;
            //     case porcentaje > 40:
            //         color =  "green";
            //         break;
            // }
            // return color;
            if (porcentaje > 100) return "red";
            else if (porcentaje > 60) return "orange";
            else if (porcentaje < 60) return "green";
        },
        GenerarModalSeguimiento(item) {
            console.log(item);
            this.SeguimientoTarea.id_tareas = item.id;

            let that = this;
            let url = "/modulos/admision/paciente/usuarioActual";

            axios
                .get(url)
                .then((response) => {
                    this.SeguimientoTarea.chk_finalizar = false;
                    if (response.data.user.perfil == 1) {
                        this.showFinalizar = true;
                    } else {
                        this.showFinalizar = false;
                    }

                    this.dialogSeguimiento = true;
                })
                .catch((error) => {
                    //Errores de validación
                });
        },
        GenerarModalSeguimientoVisulizar(item) {
            console.log(item);
            let that = this;
            let url = "/modulos/admision/paciente/GetSeguimiento/" + item.id;

            axios
                .get(url)
                .then((response) => {
                    this.ListaTareasSeguimientoV =
                        response.data.listasSeguimiento;
                    this.dialogSeguimientoVisualizar = true;
                })
                .catch((error) => {
                    //Errores de validación
                });
        },
        CerrarModal() {
            this.dialogSeguimientoVisualizar = false;
            this.cont = 0;
            this.color_avatar = "";
        },
        GetCadena(value) {
            let arr = value.split(" ");
            let A = arr[0].charAt(0).toUpperCase();
            let B = arr[1].charAt(0).toUpperCase();

            return A + B;
        },

        GetCadenaColor(value) {
            // return "blue" ;
            var _color1 = "";
            var _color2 = value;
            //    var _color = ""
            if (value == 1) {
                this.cont = 1;
                return "green";
                this.color;
            } else {
                return "blue";
            }
        },
        onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            console.log(profile);
        },
        /**
         *  On load, called to load the auth2 library and API client library.
         */
        /**
         * Callback after api.js is loaded.
         */
        gapiLoaded() {
            this.api.load("client", this.initializeGapiClient);
        },

        /**
         * Callback after the API client is loaded. Loads the
         * discovery doc to initialize the API.
         */
        async initializeGapiClient() {
            await this.api.client.init({
                apiKey: API_KEY,
                discoveryDocs: DISCOVERY_DOCS,
            });
            this.gapiInited = true;
            this.maybeEnableButtons();
        },

        /**
         * Callback after Google Identity Services are loaded.
         */
        gisLoaded() {
            this.tokenClient = google.accounts.oauth2.initTokenClient({
                client_id: CLIENT_ID,
                scope: SCOPES,
                callback: "", // defined later
            });
            this.gisInited = true;
            this.maybeEnableButtons();
        },

        /**
         *  Sign in the user upon button click.
         */
        handleAuthClick() {
            this.tokenClient.callback = async (resp) => {
                if (resp.error !== undefined) {
                    throw resp;
                }
                this.authorized = true;
                await this.listUpcomingEvents();
            };

            if (gapi.client.getToken() === null) {
                // Prompt the user to select a Google Account and ask for consent to share their data
                // when establishing a new session.
                this.tokenClient.requestAccessToken({ prompt: "consent" });
            } else {
                // Skip display of account chooser and consent dialog for an existing session.
                this.tokenClient.requestAccessToken({ prompt: "" });
            }
        },

        /**
         * Print the summary and start datetime/date of the next ten events in
         * the authorized user's calendar. If no events are found an
         * appropriate message is printed.
         */
        async listUpcomingEvents() {
            let response;
            try {
                const request = {
                    calendarId: "primary",
                    timeMin: new Date().toISOString(),
                    showDeleted: false,
                    singleEvents: true,
                    maxResults: 10,
                    orderBy: "startTime",
                };
                response = await this.api.client.calendar.events.list(request);
            } catch (err) {
                document.getElementById("content").innerText = err.message;
                return;
            }

            const events = response.result.items;
            if (!events || events.length == 0) {
                document.getElementById("content").innerText =
                    "No events found.";
                return;
            }
            // Flatten to string to display
            const output = events.reduce(
                (str, event) =>
                    `${str}${event.summary} (${
                        event.start.dateTime || event.start.date
                    })\n`,
                "Events:\n"
            );
            document.getElementById("content").innerText = output;
        },

        /**
         *  Sign out the user upon button click.
         */
        handleSignOutClick() {
            const token = this.api.client.getToken();
            if (token !== null) {
                google.accounts.oauth2.revoke(token.access_token);
                this.api.client.setToken("");
                document.getElementById("content").innerText = "fghgfh";
                document.getElementById("authorize_button").innerText =
                    "Authorize";
                document.getElementById("signout_button").style.visibility =
                    "hidden";
            }
        },

        /**
         *  Create events
         */

        handleCreateEvent() {
            let _lista = [];

            if (this.modelPrincipal != null) {
                let objeto = {};
                if (this.modelPrincipal.email != undefined) {
                     
                    objeto.email = this.modelPrincipal.email.trim();
                 
                    _lista.push(objeto);
                    // = _lista+ "{"+"email"+":"+this.modelPrincipal.email.trim();
                }
            }

            for (let index = 0; index < this.modelAdicional.length; index++) {
                //  const element = this.modelAdicional[index];
                let objeto = {};
                if ( this.modelAdicional[index].email.trim().length > 0) {
                    objeto.email = this.modelAdicional[index].email.trim();
                       _lista.push(objeto);

                }
               
                //  _lista =_lista+  ","+"email:"+this.modelAdicional[index].email.trim();
            }

            const event = {
                summary: this.tarea.descripcion,
                location:
                    "(" +
                    this.tarea.descripcion +
                    ") Sistema Gestion de Proyectos Copedesa App",
                description: this.tarea.observacion,
                start: {
                    dateTime: this.dates[1] + "T23:00:00-00:00",
                    timeZone: "America/Bogota",
                },
                end: {
                    dateTime: this.dates[1] + "T23:00:00-00:00",
                    timeZone: "America/Bogota",
                },
                recurrence: ["RRULE:FREQ=DAILY;COUNT=2"],
                // attendees: [
                // JSON.stringify( _lista)
                // ],
                reminders: {
                    useDefault: false,
                    overrides: [
                        { method: "email", minutes: 24 * 60 },
                        { method: "popup", minutes: 10 },
                    ],
                },
            };

            event["attendees"] = [];
            var lista3 = "";
            console.log("eventos", event);
            var _listArray = [];
            // lista3 = lista3 + "["
            _lista.forEach((element) => {
                event.attendees.push({ email: element.email });
                lista3 = lista3 + JSON.stringify(element) + ",";
                // _listArray = JSON.stringify( element)
            });

            const request = gapi.client.calendar.events.insert({
                calendarId: "primary",
                resource: event,
            });

            request.execute(function (event) {
                // appendPre('Event created: ' + event.htmlLink);
            });
        },

        /**
         * Enables user interaction after all libraries are loaded.
         */
        maybeEnableButtons() {
            console.log({
                gapiInited: this.gapiInited,
                gisInited: this.gisInited,
            });
            if (this.gapiInited && this.gisInited) {
                // this.authorized = true;
            }
        },
    },

    computed: {
        dateRangeText() {
            return this.dates.join(" ~ ");
        },
        rulesCmb() {
            const rules = [];

            if (this.max) {
                const rule = (v) =>
                    (v || "").length > 1 ||
                    `A maximum of ${this.max} characters is allowed`;

                rules.push(rule);
                console.log("rules", rules);
            }

            // if (!this.allowSpaces) {
            //   const rule =
            //     v => (v || '').indexOf(' ') < 0 ||
            //       'No spaces are allowed'

            //   rules.push(rule)
            // }

            // if (this.match) {
            //   const rule =
            //     v => (!!v && v) === this.match ||
            //       'Values do not match'

            //   rules.push(rule)
            // }

            return rules;
        },
    },
    watch: {
        modelAdicional(val) {
            if (val.length > 5) {
                this.$nextTick(() => this.modelAdicional.pop());
            }
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
.v-icon.outlined {
    position: relative;
    top: -40px;
    left: 0px;
}
</style>

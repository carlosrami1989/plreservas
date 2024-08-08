<template>
    <div>
        <v-divider></v-divider>
        <br />

       
        <!-- finaliza el dialogo -->
    </div>
    <!-- aqui termina :v -->
</template>
<script>
export default {
    data() {
        return {
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
            showFinalizar:false,
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
                chk_finalizar:false,
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
            cont:0,
            color_avatar:"",
        };
    },
    mounted() {
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
            if (this.$refs.form.validate()) {
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
                        this.mensajeAler("Tarea registrada con éxito", true);
                        this.dialog = false;
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
                    if (response.data.user.perfil  == 1) {
                        this.showFinalizar = true;
                    }else{
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
        CerrarModal(){
            this.dialogSeguimientoVisualizar = false;
            this.cont = 0;
            this.color_avatar="";
        },
        GetCadena(value){
            let arr = value.split(' ');
           let A =  arr[0].charAt(0).toUpperCase();
           let B =  arr[1].charAt(0).toUpperCase();
           
            return A + B;
        },

        GetCadenaColor(value){
           // return "blue" ;
           var _color1  = "";
           var _color2  = value;
        //    var _color = ""
           if (value == 1) {
            this.cont = 1;
            return "green"
            this.color

             }else{
                return "blue"

             }
                       
        }
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

<style>
.v-icon.outlined {
    position: relative;
    top: -40px;
    left: 0px;
}
</style>

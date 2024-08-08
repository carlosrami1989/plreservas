<template>
    <v-container class="grey lighten-5">
        <v-row>
            <v-col cols="12" sm="2" md="4" class="py-1">
                <v-card class="pa-2" outlined tile>
                    <router-link :to="ruta">
                    <v-img src="/img/undostres.png"></v-img>
                    </router-link>
                        <v-card-text>
                            <v-icon large color="primary">mdi-shopping </v-icon> Cerecita
                        </v-card-text>
                         
                </v-card>
            </v-col>

            <v-col cols="12" sm="2" md="4" class="py-1">
                <v-card class="pa-2" outlined tile>
                    <router-link :to="ruta">
                        <v-img src="/img/undostres2.png"></v-img>
                                </router-link>
                  
                     
                        <v-card-text>
                            <v-icon large color="green">mdi-shopping </v-icon> Gasquil
                        </v-card-text>
                         
                </v-card>
            </v-col>
            <v-col cols="12" sm="2" md="4" class="py-1">
                <v-card class="pa-2" outlined tile>
                    <v-img src="/img/undostres.png"></v-img>
                     
                        <v-card-text>
                            <v-icon large color="orange">mdi-shopping </v-icon> Churute
                        </v-card-text>
                         
                </v-card>
            </v-col>
            <v-col cols="12" sm="2" md="4" class="py-1">
                <v-card class="pa-2" outlined tile>
                    <v-img src="/img/undostres2.png"></v-img>
                     
                        <v-card-text>
                            <v-icon large color="blue">mdi-shopping </v-icon> Arualsa
                        </v-card-text>
                         
                </v-card>
            </v-col>
            <v-col cols="12" sm="2" md="4" class="py-1">
                <v-card class="pa-2" outlined tile>
                    <v-img src="/img/undostres.png"></v-img>
                     
                        <v-card-text>
                            <v-icon large color="black">mdi-shopping </v-icon> Carchi
                        </v-card-text>
                         
                </v-card>
            </v-col>
 
        </v-row>
       
    </v-container>
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
            justify: [
                "start",
                "center",
                "end",
                "space-around",
                "space-between",
            ],
            ruta:"",
           

        };
    },
    mounted() {
       this.ruta = prefix + "/modulos/visor/pantalla";
        // this.consultasTotales();
        // this.consultasDashboard();
        // this.totalesCirugia();
    },
    methods: {
        GenerarModal(value){
            this.dialog = true;

        }
    },
};
</script>

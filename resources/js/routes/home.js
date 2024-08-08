import { prefix } from "../variables";
//import paciente from "../components/modulos/Administracion/paciente";
import dashboard from ".././components/modulos/dashboard";
import viewpdf from ".././components/modulos/ViewFilePDF";
import dashboardMenu from ".././components/modulos/dashboardMenu";
import dashboardCope from ".././components/modulos/Administracion/DashboardCopemarket";
import DashAdministrador from ".././components/modulos/administrador";

import Reservas from ".././components/modulos/Administracion/Pantallas";
import Reservas_admin from ".././components/modulos/reservas/visualizar.vue";
import administracion from ".././components/modulos/reservas/administracion.vue";


import dashboardCerecita from ".././components/modulos/dashboardCerecita";
import dashboardGasquil from ".././components/modulos/dashboardGasquil";

import administrador from ".././components/modulos/Administracion/administrador.vue";
import control_clinico from ".././components/modulos/Medico/index.vue";

import tipodesechos from ".././components/modulos/Parametrizacion/TiposDesechos/index.vue";
import Tareas from ".././components/modulos/Administracion/Tareas/Dashboardtareas.vue";
import TareasNormales from ".././components/modulos/Administracion/Tareas/DashboardtareasNormales.vue";
import DesechosDescripcion from ".././components/modulos/Parametrizacion/DesechosDescripcion/index.vue";
import ingresodesechos from ".././components/modulos/Administracion/Mantenimiento/index.vue";
import departamento from ".././components/modulos/Parametrizacion/TiposDesechos/index.vue";

import Reportes from ".././components/modulos/Reporte/index.vue";
// calidad 
import index_calidad from "../components/modulos/calidad/index.vue";
import index_flota from "../components/modulos/calidad/calidad_flota/index.vue";
//transporte
import index_transporte from "../components/modulos/transporte/index.vue";
import upload from "../components/modulos/transporte/uploadfile.vue";
import complemento from "../components/modulos/transporte/complemento.vue";
///modulos/administracion/ingreso
//seguridad
import registrar from ".././components/modulos/Seguridad/Registro_usuario.vue";

let prefijo = prefix;
console.log(prefijo);

const home = [
    {
        path: prefix + "/",
        name: "Inicio",
        component: dashboard,
    },
    {
        path: prefix + "/modulos/parametrizacion/tipodesechos",
        name: "Tipos de Desechos",
        component: tipodesechos,
    },
    {
        path: prefijo + "/modulos/parametrizacion/tareas",
        name: "Tareas",
        component: Tareas,
    },
    {
        path: prefijo + "/modulos/parametrizacion/desechosdescripcion",
        name: "Desechos por Descripcion",
        component: DesechosDescripcion,
    },
    {
        path: prefix + "/modulos/medico/005",
        name: "Control Clinico",
        component: control_clinico,
    },
    //ingresodesechos
    {
        path: prefix + "/modulos/administracion/ingreso",
        name: "Ingreso de Desechos",
        component: ingresodesechos,
    },
    //registrar
    {
        path: prefix + "/modulos/seguridad/registrar",
        name: "Creación de Usuario",
        component: registrar,
    },
    //Reportes
    {
        path: prefix + "/modulos/reporte/mostrar",
        name: "Reportes General",
        component: Reportes,
    },
    //copemarket
    {
        path: prefix + "/modulos/visor/copemarket",
        name: "Copemarket",
        component: dashboardCope,
    },

    //pantallas
    {
        path: prefix + "/agenda",
        // name: "Copemarket",
        component: Reservas,
    },
    {
        path: prefix + "/vistapdf/:id",
        // name: "Copemarket",
        component: viewpdf,
    },
    {
        path: prefix + "/administrador",
        // name: "Copemarket",
        component: administrador,
    },
    //pantallas
    {
        path: prefix + "/modulos/bi/dashboardCerecita",
        // name: "Copemarket",
        component: dashboardCerecita,
    },
    //dashboardGasquil
    {
        path: prefix + "/modulos/bi/dashboardGasquil/:id",
        name: "Item",
        component: dashboardGasquil,
    },
    {
        path: prefix + "/modulos/bi/administracion",
        // name: "Copemarket",
        component: DashAdministrador,
    },
    //TareasNormales
    {
        path: prefix +"/modulos/parametrizacion/tareasNormales",
        // name: "Copemarket",
        component: TareasNormales,
    },
    //index_calidad
    {
        path: prefix +"/modulos/calidad",
        // name: "Copemarket",
        component: index_calidad,
    },
    //index_calidad
    {
        path: prefix +"/modulos/transporte",
        // name: "Copemarket",
        component: index_transporte,
    },
    {
        path: prefix +"/modulos/flota/transporte",
        // name: "Copemarket",
        component: index_flota,
    },
    {
        path: prefix + "/modulos/transporte/upload",
        // name: "Copemarket",
        component: upload,
    },
    {
        path: prefix + "/modulos/transporte/complemento",
        // name: "Copemarket",
        component: complemento,
    },
    //reservas
    {
        path: prefix + "/visualizar",
        // name: "Copemarket",
        component: Reservas_admin,
    },

    {
        path: prefix + "/admin",
        // name: "Copemarket",
        component: administracion,
    },
];

export default home;

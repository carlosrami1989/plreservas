<template>
  <div>
    <v-row
    

      style="background-color: rgb(13, 110, 49);font-family: 'Mogent';color: black"
      align="center"
      justify="center"
    >
      <v-col cols="6" background-color="red">
        <v-img src="/img/IMG_6151.PNG" contain></v-img>
      </v-col>
      <v-col cols="6">
        <v-list-item  v-for="(item, i) in icons"
          :key="i"
          class="white--text">
          <v-list-item-content>
            <v-list-item-title>
                <span style="font-size: xx-large;">
                    - {{ item.descripcion  }}
      </span>
     </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-col>
    </v-row>
  </div>
</template>
   
   <script>
export default {
  name: "PageIndex",
  data() {
    return {
      vtext: "",
      valuecarlos: "",
      valuejonu: "",
      icons: [],
      form: {
        id: "",
      },
    };
  },
  components: {},
  mounted() {
    //this.GenerarHoras();
    this.GetSucursal();
    // this.GetHoraFecha();
  },
  methods: {
    GetSucursal() {
      let url =
        this.$store.getters.getRuta + "/modulos/admision/reservas/GetSucursal";

      axios
        .get(url)
        .then((response) => {
          response.data.data.forEach((item) => {
            let objeto = {};

            objeto.red_social_id = item.Sucursal_Id;
            objeto.descripcion = item.Sucursal_Nombre;
            objeto.icono = item.campo1;
            objeto.color = item.Sucursal_Parroquia;
            objeto.url = "";
            this.icons.push(objeto);
          });
        })
        .catch((error) => {
          console.log("aqui", error);
        });
    },
  },
};
</script>
    
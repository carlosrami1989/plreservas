<template>
  <div>
    <div v-if="FormaBody()">
      <v-app-bar
        id="home-app-bar"
        app
        xs
        :color="bg"
        elevation="1"
        color="transparent"
        inverted-scroll
        height="90"
        style="font-family: 'Mogent'; color: black"
      >
        <v-img
          src="/img/logo_web_verde.png"
          class="mr-3 hidden-xs-only"
          contain
          max-width="145"
        />

        <v-spacer />

        <div>
          <v-tabs background-color="transparent" color="#006C30" grow>
            <!-- <v-tab v-for="name in items" :key="name.name"   >
            <router-link :to="name.ruta"   >
              <font color="black">   {{ name.name }} </font>
              
            
            </router-link>
           
          
          </v-tab> -->
            <v-tab>
              <router-link to="/agenda" target="_blank">
                <font color="black"> Reserva </font>
              </router-link>
            </v-tab>
            <v-menu>
              <template v-slot:activator="{ on }">
                <v-btn text v-on="on">Menú</v-btn>
              </template>
              <v-list>
                <v-list-item >Foo</v-list-item>
                <v-list-item >Bar</v-list-item>
              </v-list>
            </v-menu>
            <v-tab>
              <!-- to="/vistapdf/1"xº -->  
              <router-link   to="/vistapdf/1"  target="_blank">
                <font color="black"> Carta de Vino </font>
              </router-link>
            </v-tab>
          </v-tabs>
        </div>
        <div v-if="!isMobile()">
          <v-app-bar-nav-icon
            style="display: none"
            @click.stop="drawer = !drawer"
          ></v-app-bar-nav-icon>
        </div>
        <div v-else>
          <v-app-bar-nav-icon
            color="red"
            style="display: block"
            @click.stop="drawer = !drawer"
          ></v-app-bar-nav-icon>
        </div>

        <!-- aqui empieza -->

        <!-- aqui trmina -->
      </v-app-bar>
    </div>
    <div v-else>
      <v-app-bar
        id="home-app-bar"
        app
        xs
        :color="bg"
        elevation="1"
        color="transparent"
        height="90"
        style="font-family: 'Mogent'; color: black"
      >
        <v-img
          src="/img/logo_web_verde.png"
          class="mr-3 hidden-xs-only"
          contain
          max-width="145"
        />

        <v-spacer />

        <div>
          <v-tabs background-color="transparent" color="#006C30" grow>
            <!-- <v-tab v-for="name in items" :key="name.name"   >
            <router-link :to="name.ruta"   >
              <font color="black">   {{ name.name }} </font>
              
            
            </router-link>
           
          
          </v-tab> -->
            <v-tab >
              <router-link to="/agenda" target="_blank">
                <font color="black"> Reserva </font>
              </router-link>
            </v-tab>
            <v-menu bottom
            left
            >
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                text
                class="align-self-center mr-4"
                v-bind="attrs"
                v-on="on"
              >
                Menú
                <v-icon right>
                  mdi-menu-down
                </v-icon>
              </v-btn>
            </template>

            <v-list class="grey lighten-3">
              <v-list-item
               
              >
              <router-link  to="/vistapdf/3" target="_blank">
                <font color="black">   CIUDAD CELESTE </font>
              </router-link>
              
              </v-list-item>
               <v-list-item
               
              >
              <router-link  to="/vistapdf/4" target="_blank">
                <font color="black"> ARCOS PLAZA</font>
              </router-link>
               
              </v-list-item>
              <v-list-item
               
               >
               <router-link  to="/vistapdf/2" target="_blank">
                <font color="black"> URDESA </font>
              </router-link>
                
               </v-list-item>
            </v-list>
            </v-menu>
            <v-tab>
              <router-link  to="/vistapdf/1" target="_blank">
                <font color="black"> Carta de Vino </font>
              </router-link>
            </v-tab>
          </v-tabs>
        </div>
        <div v-if="!isMobile()">
          <v-app-bar-nav-icon
            style="display: none"
            @click.stop="drawer = !drawer"
          ></v-app-bar-nav-icon>
        </div>
        <div v-else>
          <v-app-bar-nav-icon
            color="red"
            style="display: block"
            @click.stop="drawer = !drawer"
          ></v-app-bar-nav-icon>
        </div>

        <!-- aqui empieza -->

        <!-- aqui trmina -->
      </v-app-bar>
    </div>
    <v-navigation-drawer app v-model="drawer" temporary>
      <v-list nav dense>
        <v-list-item-group v-model="group">
          <v-list-item
            v-for="name in items"
            :key="name.name"
            min-width="96"
            text
          >
            <v-list-item-content>
              <v-list-item-title>
                <router-link :to="name.ruta">
                  {{ name.name }}
                </router-link></v-list-item-title
              >
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

    <!-- fin  -->
  </div>
</template>

<script>
import { prefix, url } from "../../../variables";
export default {
  props: {
    user: {
      type: Object,
    },
    invert: {
      type: Boolean,
    },
  },
  name: "HomeAppBar",
  url_: "",
  // mixins: [auth],

  data: () => ({
    visibleAppBar: true,
    visiblebutton: false,
    usuario: [],
    UserId: 0,
    drawer: false,
    none: "display:none",
    group: null,
    //drawer: null,
    text: "white--text lighten-1--text",
    bg: "transparent",
    base: "video",
    items: [],
    icons: [
      {
        red_social_id: 1,
        descripcion: "Facebook",
        icono: "mdi-facebook",
        color: "light-blue darken-4",
        url: "https://www.facebook.com/nixon.rivasdelgado.71",
      },
      {
        red_social_id: 2,
        descripcion: "Youtube",
        icono: "mdi-youtube",
        color: "red",
        url: " ",
      },
      {
        red_social_id: 3,
        descripcion: "Instagram",
        icono: "mdi-instagram",
        color: "accent",
        url: " ",
      },
      {
        red_social_id: 4,
        descripcion: "Twitter",
        icono: "mdi-twitter",
        color: "blue lighten-3",
        url: " ",
      },
      {
        red_social_id: 5,
        descripcion: "Login",
        icono: "mdi-account-key",
        color: "blue",
        url: "/login",
      },
    ],
    bandUsuarui: false,
  }),
  mounted() {
    this.FormaBody();
    this.url_ = this.$store.state.link;
    this.consultasUsuario();
    this.$store.state.usuario = this.$props.user;
    // this.CargarRedes();
    //  this.pantalla();
    window.onscroll = () => {
      this.changeColor();
    };
  },
  methods: {
    FormaBody() {
      if (this.$props.invert == 1) {
        return true;
      } else {
        return false;
      }
    },
    changeColor() {
      if (
        document.body.scrollTop > 0 ||
        document.documentElement.scrollTop > 100
      ) {
        this.bg = "transparent";
      } else {
        this.bg = "transparent";
      }
    },
    logout() {
      window.location.replace("/logout");
    },
    consultasUsuario() {
      let that = this;
      if (this.$props.user != null) {
        this.visiblebutton = true;
        this.$store.state.usuario = this.$props.user;
        let url =
          this.$store.getters.getRuta +
          "/modulos/admision/paciente/cargarUsuario/" +
          this.$props.user.id;

        axios
          .get(url)
          .then((response) => {
            this.usuario = response.data.data;
          })

          .catch((error) => {
            //Errores de validación
          });

        this.items = [
          {
            name: "Inicio",
            icon: "mdi-view-dashboard",
            ruta: "/",
            color: "red",
          },
          {
            name: "Reservas",
            icon: "mdi-chart-bar",
            ruta: "/agenda",
            color: "cyan darken-4",
          },
          {
            name: "Administrador",
            icon: "mdi-chart-bar",
            ruta: "/administrador",
            color: "cyan darken-4",
          },
          {
            name: "Gestión",
            icon: "mdi-chart-bar",
            ruta: "/administrador",
            color: "cyan darken-4",
          },
        ];
      } else {
        this.visiblebutton = false;

        this.items = [
          // {
          //     name: "Inicio",
          //     icon: "mdi-view-dashboard",
          //     ruta: "/",
          //     color: "cyan darken-4",
          //   },
          // {
          //     name: "Reservas",
          //     icon: "mdi-chart-bar",
          //     ruta: "/",
          //     color: "cyan darken-4",
          //   },
          // {
          //   name: "Menú",
          //   icon: "mdi-view-dashboard",
          //   ruta: "/",
          //   color: "cyan darken-4",
          // },
          // {
          //   name: "Carta de Vino",
          //   icon: "mdi-view-dashboard",
          //   ruta: "/vistapdf",
          //   color: "cyan darken-4",
          // },
          // {
          //   name: "Ubicación",
          //   icon: "mdi-chart-bar",
          //   ruta: "/agenda",
          //   color: "cyan darken-4",
          // },
          // {
          //   name: "Contacto",
          //   icon: "mdi-chart-bar",
          //   ruta: "/agenda",
          //   color: "cyan darken-4",
          // },
        ];
      }
    },
    cargarInformacion() {
      let that = this;
      var url = this.url_ + "api/empresa";

      axios
        .get(url)
        .then(function (response) {
          // handle success
          that.informacion = response.data.empresa;
          //  console.log(that.informacion);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    },
    CargarRedes() {
      let that = this;
      var url = this.url_ + "api/red_social";

      axios
        .get(url)
        .then(function (response) {
          // handle success
          that.icons = response.data.redes_sociales;
          //  console.log(that.icons);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        });
    },
    isMobile() {
      if (
        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
          navigator.userAgent
        )
      ) {
        return true;
      } else {
        return false;
      }
    },
    //     pantalla(){
    // if (screen.width < 1024)
    //      {
    //       this.none = 'display:none';
    //      }
    //       else
    //       {
    //        this.none = 'display:block';
    //       }

    //             //this.drawer = false
    //     },
  },
  watch: {
    group() {},
  },
  computed: {},
};
</script>
<style>
/* Helper classes */
.basil {
  background-color: #fffbe6 !important;
}
.basil--text {
  color: #356859 !important;
}
</style>
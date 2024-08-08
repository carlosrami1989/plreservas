<template>
  <v-footer padless>
    <v-card class="flex" flat tile>
      <v-row style="background-color: rgb(251, 176, 59)">
        <v-col cols="12">
          &nbsp;&nbsp;&nbsp;
          <br />
          <br />
          &nbsp; &nbsp;
        </v-col>
      </v-row>
      <v-card-title>
        <v-row>
          <v-col cols="4">
            <v-img src="/img/perrito.png" height="400" contain />
          </v-col>

          <v-col cols="4">
            <br>
            <br>
            <v-card-title primary-title> CONTACTO </v-card-title>

            <v-card-text>
              <v-row>
              <v-col cols="2">
                <v-img src="/img/instagram.png" height="100" contain />
              </v-col>
              <v-col cols="2">
                <v-img src="/img/Whatsaap.png" height="100" contain />
              </v-col>
            </v-row>
            </v-card-text>

           
          </v-col>
        </v-row>
      </v-card-title>

      <v-divider color="white"> </v-divider>

      <v-card-text class="py-2 text-center">
        {{ new Date().getFullYear() }} —
        <strong> Pizza Libre </strong>
      </v-card-text>
    </v-card>
  </v-footer>
</template>
 
 <script>
export default {
  name: "HomeFooter",

  data: () => ({
    icons: ["mdi-facebook", "mdi-twitter", "mdi-youtube", "mdi-instagram"],
  }),
};
</script>
 
 
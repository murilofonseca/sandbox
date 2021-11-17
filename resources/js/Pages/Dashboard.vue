<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="h4 font-weight-bold">Dashboard</h2>
    </template>
    <card-page>
      <h2>Dashboard</h2>
      
    </card-page>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
//import Welcome from "@/Jetstream/Welcome.vue";
import CardPage from "@/components/CardPage.vue";

export default defineComponent({
  components: {
    AppLayout,
    CardPage,
  },
  methods: {
    /*loginApi() {
      let url = "https://sandbox.cscdf.com.br/api/v1/auth/me";
      let access_token = document.cookie.split(";").find((indice) => {
        return indice.includes("access_token");
      });
      access_token = access_token.split("=")[1];
      let config = {
        headers: { Authorization: "Bearer " + access_token },
      };
      let params = "";
      axios.post(url, params, config).then((response) => {
        console.log(response);
      });
    },*/
  },
});
</script>

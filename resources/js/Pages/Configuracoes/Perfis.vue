<template>
  <app-layout title="Perfis">
    <template #header>
      <h2 class="h4 font-weight-bold">Perfis</h2>
    </template>
    <card-page>
      <h2>Perfis</h2>
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
});
</script>

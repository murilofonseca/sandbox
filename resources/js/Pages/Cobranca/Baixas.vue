<template>
  <app-layout title="Baixas">
    <template #header>
      <h2 class="h4 font-weight-bold">Baixas</h2>
    </template>
    <card-page>
      <h2>Baixas</h2>
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

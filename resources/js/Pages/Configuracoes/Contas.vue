<template>
  <app-layout title="Contas">
    <template #header>
      <h2 class="h4 font-weight-bold">Contas</h2>
    </template>
    <card-page>
      <h2>Contas</h2>
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

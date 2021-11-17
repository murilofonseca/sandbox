<template>
  <app-layout title="AO3">
    <template #header>
      <h2 class="h4 font-weight-bold">AO3</h2>
    </template>
    <card-page>
      <h2>AO3</h2>
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

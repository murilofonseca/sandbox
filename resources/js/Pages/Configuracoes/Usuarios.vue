<template>
  <app-layout title="Usuários">
    <template #header>
      <h2 class="h4 font-weight-bold">Usuários</h2>
    </template>
    <card-page
      :headerTitulo="headerTitulo"
      :headerTituloValor="headerTituloValor"
      :headerbotao="headerbotao"
    >
      <Table
        :titulos="{
          0: { titulo: 'ID', tipo: 'text', var: 'id' },
          1: { titulo: 'Nome', tipo: 'text', var: 'name' },
          2: { titulo: 'Email', tipo: 'text', var: 'email' },
          3: { titulo: 'Perfil', tipo: 'text', var: 'p_users.p_perfils.nome' },
          4: {
            titulo: 'Data Criação Usuario',
            tipo: 'date',
            var: 'created_at',
          },
        }"
      />
    </card-page>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
//import Welcome from "@/Jetstream/Welcome.vue";
import CardPage from "@/components/CardPage.vue";
import Table from "@/components/Table.vue";

export default defineComponent({
  components: {
    AppLayout,
    CardPage,
    Table,
  },
  data() {
    return {
      headerTitulo: true,
      headerTituloValor: "Usuários",
      headerbotao: true,
    };
  },
  methods: {
  },
  async created() {
    this.$store.state.routeIndex = route("indexUsersApi")
  }
});
</script>

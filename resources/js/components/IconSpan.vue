<template>
  <div>
    <!--Icone--><span class="material-icons pe-1">{{ iconeTipo }}</span>
    <!--Texto do icone--><span>{{ iconeTexto }}</span>
  </div>
</template>

<script>
export default {
  props: ["iconeTipo", "iconeTexto"],
};
</script>

<style scoped>
div {
  display: flex;
}
.material-icons {
  font-size: 20px;
}
</style>
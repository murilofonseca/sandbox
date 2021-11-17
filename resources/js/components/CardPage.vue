<template>
  <div class="row justify-content-center my-3">
    <div class="col-md-12">
      <div class="card shadow bg-light">
        <div class="card-header">
          <div class="row">
            <div class="col-10" v-if="headerTitulo">
              <span class="h3">
                {{ headerTituloValor }}
              </span>
            </div>
            <div class="col-2" v-if="headerbotao">
              <jet-button
                type="button"
                classButton="btn btn-sm btn-primary text-white"
              >
                Adicionar
              </jet-button>
            </div>
          </div>
        </div>
        <div class="card-body bg-white px-5 py-3 border-bottom rounded-top">
          <div class="mx-3 my-3">
            <slot></slot>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import JetButton from "@/components/Button.vue";
export default {
  components: {
    JetButton,
  },
  props: [
    "conteudo",
    "headerTitulo",
    "headerTitulo",
    "headerTituloValor",
    "headerbotao",
  ],
};
</script>

<style>
</style>
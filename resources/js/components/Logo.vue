<template>
  <div class="text-center">
    <img src="/img/logocsc.jpg" class="img-fluid" :width="tamanho" alt="" />
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props:{
    tamanho:{
      type: String,
      required: true
    }
  },
});
</script>

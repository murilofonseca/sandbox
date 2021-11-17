<template>
  <div class="d-grid gap-2">
    <button :type="type" :class="classButton" :disabled="disabled">
      <slot></slot>
    </button>
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    type: {
      type: String,
      default: "submit",
    },
    classButton: {
      type: String,
      default: "btn btn-primary btn-lg text-white",
    },
    disabled: false,
  },
});
</script>

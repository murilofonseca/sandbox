<template>
  <div v-if="hasErrors" class="vcenter-item">
    <template v-for="(error, key) in errors" :key="key">
      <span class="material-icons pe-1" style="font-size: 20px"
        >error_outline</span
      >
      <span>{{ error }}</span>
    </template>
  </div>
  <!--<div class="alert alert-danger text-sm p-2" role="alert" v-if="hasErrors">
    <ul>
      <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
    </ul>
  </div>-->
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  computed: {
    errors() {
      return this.$page.props.errors;
    },

    hasErrors() {
      return Object.keys(this.errors).length > 0;
    },
  },
});
</script>
<style scoped>
div {
  color: red;
}
span {
  text-align: justify;
}
.vcenter-item {
  display: flex;
}
</style>
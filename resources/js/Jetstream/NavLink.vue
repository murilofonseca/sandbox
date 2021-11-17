<template>
  <li class="nav-item" :class="classes">
    <Link :href="href" :class="classesLink">
      <slot></slot>
    </Link>
  </li>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Link,
  },

  props: ["href", "active"],

  computed: {
    /*classes() {
        return this.active
            ? 'nav-link active font-weight-bolder'
            : 'nav-link'
      }*/
    classes() {
      return this.active ? "ativa " : "";
    },
    classesLink() {
      return this.active ? "nav-link active font-weight-bolder" : "nav-link";
    },
  },
});
</script>

<style scoped>
.ativa {
  border-bottom: 2px solid #6875f5;
}
</style>
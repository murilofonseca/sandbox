<template>
    <label class="labelclass">
      <span v-if="value">{{ value }}</span>
      <span v-else><slot></slot></span>
    </label>
 
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: ["value"],
});
</script>

<style scoped>
.labelclass {
  pointer-events: none;
  position: absolute;
  top: calc(50% - 8px);
  left: 15px;
  transition: all 0.1s linear;
  -webkit-transition: all 0.1s linear;
  -moz-transition: all 0.1s linear;
  background-color: white;
  padding: 5px;
  box-sizing: border-box;
}

.labelclass{
  color: red;
}

.labelclass:before {
  content: "*";
}
</style>
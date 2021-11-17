<template>
  <div class="label-float">
    <input
      :id="id"
      :type="type"
      :required="required"
      :autocomplete="autocomplete"
      :autofocus="autofocus"
      placeholder=" "
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      ref="input"
    />
    <label>{{ label }}</label>
  </div>
  <!--<input
    class="form-control"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
    ref="input"
  />-->
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: [
    "modelValue",
    "label",
    "id",
    "type",
    "required",
    "autocomplete",
    "autofocus",
  ],

  emits: ["update:modelValue"],

  methods: {
    focus() {
      this.$refs.input.focus();
    },
  },
});
</script>

<style scoped>
.label-float {
  position: relative;
  padding-top: 13px;
}

.label-float input {
  border: 1px solid lightgrey;
  border-radius: 5px;
  outline: none;
  min-width: 100%;
  padding: 10px 10px;
  font-size: 16px;
  transition: all 0.1s linear;
  -webkit-transition: all 0.1s linear;
  -moz-transition: all 0.1s linear;
  -webkit-appearance: none;
}

.label-float input:focus {
  border: 2px solid #3951b2;
}

.label-float input::placeholder {
  color: transparent;
}

.label-float label {
  pointer-events: none;
  position: absolute;
  top: calc(50% - 6px);
  left: 15px;
  transition: all 0.1s linear;
  -webkit-transition: all 0.1s linear;
  -moz-transition: all 0.1s linear;
  background-color: white;
  padding: 2px;
  box-sizing: border-box;
}

.label-float input:focus + label,
.label-float input:not(:placeholder-shown) + label {
  font-size: 13px;
  top: 0;
  color: #3951b2;
}


</style>
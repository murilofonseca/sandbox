<template>
  <div class="row">
    <div class="col-md-6">
      <jet-section-title>
        <template #title><slot name="title"></slot></template>
        <template #description>
          <span class="small">
            <slot name="description"></slot>
          </span>
        </template>
      </jet-section-title>
    </div>

    <div class="col-md-6">
      <form @submit.prevent="$emit('submitted')">
        <div class="card shadow-sm">
          <div class="card-body">
            <slot name="form"></slot>
          </div>

          <div class="card-footer justify-content-end" v-if="hasActions">
            <slot name="actions"></slot>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  import { defineComponent } from 'vue'
  import JetSectionTitle from './SectionTitle.vue'

  export default defineComponent({
    components: {
      JetSectionTitle,
    },

    emits: ['submitted'],

    computed: {
      hasActions() {
        return !! this.$slots.actions
      }
    }
  })
</script>

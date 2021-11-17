<template>
  <jet-form-section @submitted="updatePassword">
    <template #title> Atualizar Senha </template>

    <template #description>
      Certifique-se de que sua conta está usando uma senha longa e aleatória
      para permanecer segura.
    </template>

    <template #form>
      <jet-action-message :on="form.recentlySuccessful">
        Senha atualizada com sucesso.
      </jet-action-message>

      <div class="w-75">
        <div class="mb-3">
          
          <jet-input
            id="current_password"
            type="password"
            texto="Senha Atual"
            label="Senha Atual"
            :class="{ 'is-invalid': form.errors.current_password }"
            v-model="form.current_password"
            ref="current_password"
            autocomplete="current-password"
          />
          <jet-input-error
            :message="form.errors.current_password"
            class="mt-2"
          />
        </div>

        <div class="mb-3">
          
          <jet-input
            id="password"
            type="password"
            texto="Nova Senha"
            label="Nova Senha"
            :class="{ 'is-invalid': form.errors.password }"
            v-model="form.password"
            autocomplete="new-password"
          />
          <jet-input-error :message="form.errors.password" class="mt-2" />
        </div>

        <div class="mb-3">
          
          <jet-input
            id="password_confirmation"
            type="password"
            texto="Repetir Senha"
            label="Repetir Senha"
            :class="{ 'is-invalid': form.errors.password_confirmation }"
            v-model="form.password_confirmation"
            autocomplete="new-password"
          />
          <jet-input-error
            :message="form.errors.password_confirmation"
            class="mt-2"
          />
        </div>
      </div>
    </template>

    <template #actions>
      <jet-button
        :classButton="classButton"
        :disabled="form.processing"
      >
        <div
          v-show="form.processing"
          class="spinner-border spinner-border-sm"
          role="status"
        >
          <span class="visually-hidden">Loading...</span>
        </div>

        Salvar
      </jet-button>
    </template>
  </jet-form-section>
</template>

<script>
import { defineComponent } from "vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
//import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
//import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";

import JetInput from "@/components/Input.vue";
import JetButton from "@/components/Button.vue";

export default defineComponent({
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
  },

  data() {
    return {
      form: this.$inertia.form({
        current_password: "",
        password: "",
        password_confirmation: "",
      }),
      classButton:"btn btn-primary btn text-white"
    };
  },

  methods: {
    updatePassword() {
      this.form.put(route("user-password.update"), {
        errorBag: "updatePassword",
        preserveScroll: true,
        onSuccess: () => this.form.reset(),
        onError: () => {
          if (this.form.errors.password) {
            this.form.reset("password", "password_confirmation");
            this.$refs.password.focus();
          }

          if (this.form.errors.current_password) {
            this.form.reset("current_password");
            this.$refs.current_password.focus();
          }
        },
      });
    },
  },
});
</script>

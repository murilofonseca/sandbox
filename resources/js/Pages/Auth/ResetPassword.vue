<template>
  <Head title="Reset Password" />

  <jet-authentication-card>
    <template #logo> </template>

    <div class="card-body">
      <jet-validation-errors class="mb-3" />
      <jet-authentication-card-logo tamanho="150" class="mb-3" />
      <form @submit.prevent="submit">
        <div class="mb-3">
          <jet-input
            id="email"
            texto="Email"
            label="Email"
            type="email"
            v-model="form.email"
            required
            autofocus
          />
        </div>

        <div class="mb-3">
          <jet-input
            id="password"
            texto="Senha"
            label="Senha"
            type="password"
            v-model="form.password"
            required
            autocomplete="new-password"
          />
        </div>

        <div class="mb-3">
          <jet-input
            id="password_confirmation"
            texto="Confirmar Senha"
            label="Confirmar Senha"
            type="password"
            v-model="form.password_confirmation"
            required
            autocomplete="new-password"
          />
        </div>

        <div class="mb-0">
          <div class="justify-content-end">
            <jet-button
              :class="{ 'text-white-50': form.processing }"
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

              Redefinir Senha
            </jet-button>
          </div>
        </div>
      </form>
    </div>
  </jet-authentication-card>
</template>

<script>
import { defineComponent } from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
//import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
//import JetButton from "@/Jetstream/Button.vue";
//import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
//import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";

//Custom
import JetInput from "@/components/Input.vue";
import JetAuthenticationCardLogo from "@/components/Logo.vue";
import JetButton from "@/components/Button.vue";
import JetValidationErrors from "@/components/ValidationErrors.vue";

export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetLabel,
    JetValidationErrors,
  },

  props: {
    email: String,
    token: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        token: this.token,
        email: this.email,
        password: "",
        password_confirmation: "",
      }),
      classButton: "btn btn-primary btn text-white",
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("password.update"), {
        onFinish: () => this.form.reset("password", "password_confirmation"),
      });
    },
  },
});
</script>

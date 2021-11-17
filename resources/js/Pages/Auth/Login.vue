<template>
  <Head title="Log in" />

  <jet-authentication-card>
    <template #logo> </template>

    <div class="card-body">
      <jet-authentication-card-logo tamanho="150" class="mb-3" />

      <div
        v-if="status"
        class="alert alert-success mb-3 rounded-0"
        role="alert"
      >
        {{ status }}
      </div>

      <form @submit.prevent="loginApi">
        <div class="mb-3">
          <jet-input
            id="email"
            texto="Email"
            type="email"
            label="Email"
            v-model="form.email"
            required="true"
            autofocus="true"
          >
          </jet-input>
        </div>

        <div class="mb-3">
          <jet-input
            id="password"
            type="password"
            label="Senha"
            v-model="form.password"
            required="true"
            autocomplete="current-password"
          >
          </jet-input>
        </div>

        <jet-validation-errors />
        <div class="mt-4">
          <jet-button :classButton="classButton" :disabled="processing">
            <div
              v-show="processing"
              class="spinner-border spinner-border-sm"
              role="status"
            >
              <span class="visually-hidden">Loading...</span>
            </div>

            Entrar
          </jet-button>
        </div>
        <div class="row mt-3">
          <div class="col-md-6 col-sm-12">
            <div class="custom-control custom-checkbox">
              <jet-checkbox
                id="remember_me"
                name="remember"
                v-model:checked="form.remember"
              />

              <label class="custom-control-label ps-2" for="remember_me">
                Lembrar-me
              </label>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 text-end">
            <Link
              v-if="canResetPassword"
              :href="route('password.request')"
              class="text-muted"
            >
              Esqueceu a senha?
            </Link>
          </div>
        </div>
      </form>
    </div>
  </jet-authentication-card>
</template>

<script>
import { defineComponent } from "vue";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
/*import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";*/
/*import JetButton from "@/Jetstream/Button.vue";*/
/*import JetInput from '@/Jetstream/Input.vue'*/
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
/*import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";*/
import { Head, Link } from "@inertiajs/inertia-vue3";

/**Componentes personalizado */
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
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link,
  },

  props: {
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
      }),
      classButton: "btn btn-primary btn-lg text-white",
      processing: false,
    };
  },

  methods: {
    submit() {
      this.form
        .transform((data) => ({
          ...data,
          remember: this.form.remember ? "on" : "",
        }))
        .post(this.route("login"), {
          onFinish: () => {
            this.form.reset("password"), (this.processing = false);
          },
        });
    },
    loginApi() {
      this.processing = true;
      //let url = "https://sandbox.cscdf.com.br/api/v1/auth/login";
      let url = route("loginApi");
      let params = new URLSearchParams();
      params.append("email", this.form.email);
      params.append("password", this.form.password);
      axios.post(url, params).then((response) => {
        if (response.data.access_token) {
          document.cookie = "access_token=" + response.data.access_token;
        }
      });

      this.submit();
    },
  },
});
</script>

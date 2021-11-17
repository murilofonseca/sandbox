<template>
  <Head title="Esqueceu Senha" />

  <jet-authentication-card>
    <template #logo> </template>

    <div class="card-body">
      <jet-authentication-card-logo tamanho="150" class="mb-3" />
      <div class="mb-2">
       <small>Digite seu e-mail abaixo e receba um link para redefinir a sua senha.</small> 
      </div>

      <form @submit.prevent="submit">
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

        <div class="row mt-3">
          <div class="col-12">
            <div v-if="status" class="alert alert-success" role="alert">
              {{ status }}
            </div>

            <jet-validation-errors class="mb-2" />
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <jet-button
              :class="{ 'text-white-50': form.processing }"
              classButton="btn btn-primary btn text-white"
              :disabled="form.processing"
            >
              <div
                v-show="form.processing"
                class="spinner-border spinner-border-sm"
                role="status"
              >
                <span class="visually-hidden">Carregando...</span>
              </div>

              Redefinir Senha
            </jet-button>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-12">
            <jet-button
              :type="type"
              :classButton="classButton"
              @click="voltarPagina"
            >
              Voltar
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
/*import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'*/
/*import JetButton from '@/Jetstream/Button.vue'*/
/*import JetInput from '@/Jetstream/Input.vue'*/ Head;
import JetLabel from "@/Jetstream/Label.vue";
/*import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'*/

/**Componentes personalizado */
import JetInput from "@/components/Input.vue";
import JetAuthenticationCardLogo from "@/components/Logo.vue";
import JetButton from "@/components/Button.vue";
import JetValidationErrors from "@/components/ValidationErrors.vue";

//Bibs para utilizar os requests do inertia
import { Inertia } from "@inertiajs/inertia";

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
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
      }),
      type: "button",
      classButton: "btn btn-secondary btn ",
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("password.email"));
    },
    voltarPagina() {
      //window.location.href = '/login';
      Inertia.get("login");
    },
  },
});
</script>

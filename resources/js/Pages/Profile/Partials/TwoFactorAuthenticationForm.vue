<template>
  <jet-action-section>
    <template #title> Autenticação de dois fatores </template>

    <template #description>
      Adicione segurança adicional à sua conta usando autenticação de dois
      fatores.
    </template>

    <template #content>
      <h3 class="h5 font-weight-bold" v-if="twoFactorEnabled">
        Você habilitou a autenticação de dois fatores.
      </h3>

      <h3 class="h5 font-weight-bold" v-else>
        Habilitar a autenticação de dois fatores
      </h3>

      <div class="mt-3">
        <p>
          Quando a autenticação de dois fatores estiver habilitada, você será
          solicitado a fornecer um token seguro e aleatório durante a
          autenticação. Você pode recuperar este token do aplicativo
          <b>Google Authenticator</b> do seu telefone.
        </p>
      </div>

      <div v-if="twoFactorEnabled">
        <div v-if="qrCode">
          <div class="mt-3">
            <p>
              A autenticação de dois fatores agora está habilitada. Leia o
              seguinte <b>QR código</b> usando o aplicativo
              <b>Google Authenticator</b> do seu telefone.
            </p>
          </div>

          <div class="mt-3" v-html="qrCode"></div>
        </div>

        <div v-if="recoveryCodes.length > 0">
          <div class="mt-3">
            <p>
              Armazene esses códigos de recuperação em um gerenciador de senhas
              seguro. Eles podem ser usado para recuperar o acesso à sua conta
              se seus dois fatores dispositivo de autenticação foi perdido.
            </p>
          </div>

          <div class="w-75 bg-light rounded p-3">
            <div v-for="code in recoveryCodes">
              {{ code }}
            </div>
          </div>
        </div>
      </div>

      <div class="mt-3">
        <div v-if="!twoFactorEnabled">
          <jet-confirms-password @confirmed="enableTwoFactorAuthentication">
            <jet-button
              type="button"
              :classButton="classButton"
              :disabled="enabling"
            >
              <div
                v-show="enabling"
                class="spinner-border spinner-border-sm"
                role="status"
              >
                <span class="visually-hidden">Loading...</span>
              </div>

              Habilitar
            </jet-button>
          </jet-confirms-password>
        </div>

        <div v-else>
          <jet-confirms-password @confirmed="regenerateRecoveryCodes">
            <jet-secondary-button class="me-3" v-if="recoveryCodes.length > 0">
              Gerar novamente os Códigos de Recuperação
            </jet-secondary-button>
          </jet-confirms-password>

          <jet-confirms-password @confirmed="showRecoveryCodes">
            <jet-secondary-button class="me-3" v-if="recoveryCodes.length == 0">
              Visualizar Códigos de Recuperação
            </jet-secondary-button>
          </jet-confirms-password>

          <jet-confirms-password @confirmed="disableTwoFactorAuthentication">
            <jet-danger-button :classButton="classButton" :disabled="disabling">
              <div
                v-show="processing"
                class="spinner-border spinner-border-sm"
                role="status"
              >
                <span class="visually-hidden">Loading...</span>
              </div>

              Desabilitar
            </jet-danger-button>
          </jet-confirms-password>
        </div>
      </div>
    </template>
  </jet-action-section>
</template>

<script>
import { defineComponent } from "vue";
import JetActionSection from "@/Jetstream/ActionSection.vue";
//import JetButton from "@/Jetstream/Button.vue";
import JetConfirmsPassword from "@/Jetstream/ConfirmsPassword.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

import JetButton from "@/components/Button.vue";

export default defineComponent({
  components: {
    JetActionSection,
    JetButton,
    JetConfirmsPassword,
    JetDangerButton,
    JetSecondaryButton,
  },

  data() {
    return {
      enabling: false,
      disabling: false,
      processing: false,

      qrCode: null,
      recoveryCodes: [],
      classButton: "btn btn-primary btn text-white",
    };
  },

  methods: {
    enableTwoFactorAuthentication() {
      this.enabling = true;

      this.$inertia.post(
        "/user/two-factor-authentication",
        {},
        {
          preserveScroll: true,
          onSuccess: () =>
            Promise.all([this.showQrCode(), this.showRecoveryCodes()]),
          onFinish: () => (this.enabling = false),
        }
      );
    },

    showQrCode() {
      return axios.get("/user/two-factor-qr-code").then((response) => {
        this.qrCode = response.data.svg;
      });
    },

    showRecoveryCodes() {
      return axios.get("/user/two-factor-recovery-codes").then((response) => {
        this.recoveryCodes = response.data;
      });
    },

    regenerateRecoveryCodes() {
      axios.post("/user/two-factor-recovery-codes").then((response) => {
        this.showRecoveryCodes();
      });
    },

    disableTwoFactorAuthentication() {
      this.disabling = true;
      this.processing = true;
      this.$inertia.delete("/user/two-factor-authentication", {
        preserveScroll: true,
        onSuccess: () => {
          this.disabling = false;
          this.processing = false;
        },
      });
    },
  },

  computed: {
    twoFactorEnabled() {
      return !this.enabling && this.$page.props.user.two_factor_enabled;
    },
  },
});
</script>

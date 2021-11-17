<template>
  <div>
    <Head :title="title" />

    <jet-banner />

    <nav
      class="
        navbar navbar-expand-md navbar-light
        bg-white
        border-bottom
        sticky-top
        shadow
      "
    >
      <div class="container-fluid ms-3 me-3">
        <!-- Logo -->
        <Link class="navbar-brand me-4" :href="route('dashboard')">
          <jet-application-mark />
        </Link>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav me-auto">
            <jet-nav-link
              :href="route('dashboard')"
              :active="
                route().current('dashboard') || route().current('undefined')
              "
            >
              <icon-span iconeTipo="dashboard" iconeTexto="Dashboard">
              </icon-span>
            </jet-nav-link>
            <li
              :class="
                LinkActive(
                  route().current('faturas') || route().current('baixas')
                )
              "
            >
              <a
                class="nav-link dropdown-toggle d-flex align-items-center"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <icon-span iconeTipo="payments" iconeTexto="Cobranças" />
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <jet-nav-link :href="route('faturas')" class="dropdown-item">
                    <icon-span iconeTipo="request_quote" iconeTexto="Faturas" />
                  </jet-nav-link>
                </li>
                <li>
                  <jet-nav-link :href="route('baixas')" class="dropdown-item">
                    <icon-span iconeTipo="price_check" iconeTexto="Baixas" />
                  </jet-nav-link>
                </li>
              </ul>
            </li>
            <li
              :class="
                LinkActive(
                  route().current('transferencias') || route().current('lotes')
                )
              "
            >
              <a
                class="nav-link dropdown-toggle d-flex align-items-center"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <icon-span iconeTipo="sync_alt" iconeTexto="Transferências" />
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <jet-nav-link
                    class="dropdown-item"
                    :href="route('transferencias')"
                  >
                    <icon-span
                      iconeTipo="compare_arrows"
                      iconeTexto="Transferências"
                    />
                  </jet-nav-link>
                </li>
                <li>
                  <jet-nav-link class="dropdown-item" :href="route('lotes')">
                    <icon-span iconeTipo="cases" iconeTexto="Lotes" />
                  </jet-nav-link>
                </li>
              </ul>
            </li>

            <li
              :class="
                LinkActive(
                  route().current('baixacobexpress') ||
                    route().current('chargeback') ||
                    route().current('consultarpagamento') ||
                    route().current('pontomais') ||
                    route().current('ao3')
                )
              "
            >
              <a
                class="nav-link dropdown-toggle d-flex align-items-center"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <icon-span iconeTipo="construction" iconeTexto="Ferramentas" />
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <jet-nav-link
                    class="dropdown-item"
                    :href="route('baixacobexpress')"
                  >
                    <icon-span
                      iconeTipo="arrow_downward"
                      iconeTexto="Baixa Cobexpress"
                    />
                  </jet-nav-link>
                </li>
                <li>
                  <jet-nav-link
                    class="dropdown-item"
                    :href="route('chargeback')"
                  >
                    <icon-span
                      iconeTipo="credit_card_off"
                      iconeTexto="ChargeBack"
                    />
                  </jet-nav-link>
                </li>
                <li>
                  <jet-nav-link
                    class="dropdown-item"
                    :href="route('consultarpagamento')"
                  >
                    <icon-span
                      iconeTipo="paid"
                      iconeTexto="Consultar Pagamento"
                    />
                  </jet-nav-link>
                </li>
                <li>
                  <jet-nav-link
                    class="dropdown-item"
                    :href="route('pontomais')"
                  >
                    <icon-span iconeTipo="language" iconeTexto="Ponto Mais" />
                  </jet-nav-link>
                </li>
                <li>
                  <jet-nav-link class="dropdown-item" :href="route('ao3')">
                    <icon-span iconeTipo="language" iconeTexto="AO3" />
                  </jet-nav-link>
                </li>
              </ul>
            </li>
            <li
              :class="
                LinkActive(
                  route().current('contas') ||
                    route().current('filiais') ||
                    route().current('empresas') ||
                    route().current('webhooks') ||
                    route().current('usuarios') ||
                    route().current('perfis') ||
                    route().current('logs')
                )
              "
            >
              <a
                class="nav-link dropdown-toggle d-flex align-items-center"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <icon-span iconeTipo="settings" iconeTexto="Configurações" />
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <jet-nav-link class="dropdown-item" :href="route('contas')">
                    <icon-span
                      iconeTipo="account_balance"
                      iconeTexto="Contas"
                    />
                  </jet-nav-link>
                </li>
                <li>
                  <jet-nav-link class="dropdown-item" :href="route('filiais')">
                    <icon-span
                      iconeTipo="corporate_fare"
                      iconeTexto="Filiais"
                    />
                  </jet-nav-link>
                </li>
                <li>
                  <jet-nav-link class="dropdown-item" :href="route('empresas')">
                    <icon-span iconeTipo="apartment" iconeTexto="Empresas" />
                  </jet-nav-link>
                </li>
                <li>
                  <jet-nav-link class="dropdown-item" :href="route('webhooks')">
                    <icon-span iconeTipo="get_app" iconeTexto="Webhooks" />
                  </jet-nav-link>
                </li>

                <li>
                  <jet-nav-link class="dropdown-item" :href="route('usuarios')">
                    <icon-span iconeTipo="group" iconeTexto="Usuários" />
                  </jet-nav-link>
                </li>
                <li>
                  <jet-nav-link class="dropdown-item" :href="route('perfis')">
                    <icon-span iconeTipo="account_box" iconeTexto="Perfis" />
                  </jet-nav-link>
                </li>
                <li>
                  <jet-nav-link class="dropdown-item" :href="route('logs')">
                    <icon-span iconeTipo="view_list" iconeTexto="Logs" />
                  </jet-nav-link>
                </li>
              </ul>
            </li>
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav align-items-baseline">
            <!-- Team Management -->
            <jet-dropdown
              id="teamManagementDropdown"
              v-if="$page.props.jetstream.hasTeamFeatures"
            >
              <template #trigger>
                {{ $page.props.user.current_team.name }}

                <svg
                  class="me-2"
                  width="18"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  />
                </svg>
              </template>

              <template #content>
                <!-- Team Management -->
                <template v-if="$page.props.jetstream.hasTeamFeatures">
                  <h6 class="dropdown-header">Manage Team</h6>

                  <!-- Team Settings -->
                  <jet-dropdown-link
                    :href="route('teams.show', $page.props.user.current_team)"
                  >
                    Team Settings
                  </jet-dropdown-link>

                  <jet-dropdown-link
                    :href="route('teams.create')"
                    v-if="$page.props.jetstream.canCreateTeams"
                  >
                    Create New Team
                  </jet-dropdown-link>

                  <hr class="dropdown-divider" />

                  <!-- Team Switcher -->
                  <h6 class="dropdown-header">Switch Teams</h6>

                  <template
                    v-for="team in $page.props.user.all_teams"
                    :key="team.id"
                  >
                    <form @submit.prevent="switchToTeam(team)">
                      <jet-dropdown-link as="button">
                        <div class="d-flex">
                          <svg
                            v-if="team.id == $page.props.user.current_team_id"
                            class="me-1 text-success"
                            width="20"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                          >
                            <path
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                            ></path>
                          </svg>
                          <span class="text-truncate" style="width: 12rem">{{
                            team.name
                          }}</span>
                        </div>
                      </jet-dropdown-link>
                    </form>
                  </template>
                </template>
              </template>
            </jet-dropdown>

            <!-- Authentication Links -->
            <jet-dropdown id="settingsDropdown">
              <template #trigger>
                <img
                  v-if="$page.props.jetstream.managesProfilePhotos"
                  class="rounded-circle"
                  width="32"
                  height="32"
                  :src="$page.props.user.profile_photo_url"
                  :alt="$page.props.user.name"
                />

                <span v-else>
                  {{ $page.props.user.name }}
                </span>
              </template>

              <template #content>
                <!-- Account Management -->
                <h6 class="dropdown-header small text-muted">
                  Gerenciar Contas
                </h6>

                <jet-dropdown-link :href="route('profile.show')">
                  <icon-span iconeTipo="person" iconeTexto="Perfil" />
                </jet-dropdown-link>

                <jet-dropdown-link
                  :href="route('api-tokens.index')"
                  v-if="$page.props.jetstream.hasApiFeatures"
                >
                  <icon-span iconeTipo="token" iconeTexto="API Tokens" />
                </jet-dropdown-link>

                <hr class="dropdown-divider" />

                <!-- Authentication -->
                <form @submit.prevent="logout">
                  <jet-dropdown-link as="button">
                    <icon-span iconeTipo="logout" iconeTexto="Sair" />
                  </jet-dropdown-link>
                </form>
              </template>
            </jet-dropdown>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Heading 
    <header class="d-flex py-3 bg-white shadow-sm border-bottom">
      <div class="container">
        <slot name="header"></slot>
      </div>
    </header>-->

    <!-- Page Content -->

    <main class="container-fluid my-3">
      <slot></slot>
    </main>
  </div>
</template>

<script>
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import JetBanner from "@/Jetstream/Banner.vue";
//import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

import JetApplicationMark from "@/components/AppLogo.vue";
import IconSpan from "@/components/IconSpan.vue";

export default {
  props: {
    title: String,
  },

  components: {
    Head,
    JetApplicationLogo,
    JetBanner,
    JetApplicationMark,
    JetDropdown,
    JetDropdownLink,
    JetNavLink,
    Link,
    IconSpan,
  },

  data() {
    return {
      showingNavigationDropdown: false,
      ClassAtiva: "nav-item",
    };
  },

  methods: {
    switchToTeam(team) {
      this.$inertia.put(
        route("current-team.update"),
        {
          team_id: team.id,
        },
        {
          preserveState: false,
        }
      );
    },

    logout() {
      axios.post(route("logoutApi"));
      this.$inertia.post(route("logout"));
    },

    LinkActive(rota) {
      if (rota) {
        return "nav-item dropdown ativa";
      } else {
        return "nav-item dropdown";
      }
    },
  },

  computed: {
    path() {
      return window.location.pathname;
    },
  },
};
</script>
<style scoped>
.ativa {
  border-bottom: 2px solid #6875f5;
}
</style>
<template>
  <div>
    <Loader v-if="this.$store.state.loading" />
    <Alert
      v-if="this.$store.state.showAlert"
      :typeAlert="this.$store.state.typeAlert"
      :msgAlert="this.$store.state.msgAlert"
    />
    <div v-if="!this.$store.state.loading && this.$store.state.loadingTable">
      <div class="row">
        <div class="col-sm-12 col-md-5">
          <ul class="list-inline">
            <ul class="list-inline">
              <li class="list-inline-item">Mostrar</li>
              <li class="list-inline-item">
                <select
                  v-model="perPage"
                  class="form-select form-select-sm"
                  aria-label=".form-select-sm example"
                >
                  <option selected value="5">5</option>
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                </select>
              </li>
              <li class="list-inline-item">de {{ this.dadosTotal }}</li>
            </ul>
          </ul>
        </div>

        <div class="col-sm-12 col-md-4 offset-md-3">
          <div class="input-group input-group-sm mb-3">
            <input
              type="text"
              class="form-control"
              aria-describedby="button-addon2"
              v-model="search"
              @keyup.enter="btnSearch()"
            />
            <button
              class="btn btn-outline-secondary"
              type="button"
              id="button-addon2"
              @click="btnSearch()"
            >
              Pesquisar
            </button>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th
                v-for="(h, keyHeader) in titulos"
                :key="keyHeader"
                @click="ordenaCollum(h.var)"
              >
                {{ h.titulo }}
                <span
                 
                  class="material-icons icons-thead"
                >
                  swap_vert
                </span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(obj, chave) in dadosFiltrados" :key="chave">
              <td v-for="(valor, chaveValor) in obj" :key="chaveValor">
                <template v-for="(t, chaveT) in titulos" :key="chaveT">
                  <template v-if="t['var'] === chaveValor">
                    <span v-if="t['tipo'] === 'text'">
                      {{ tratarText(valor) }}
                    </span>
                    <span v-if="t['tipo'] === 'date'">
                      {{ tratarDate(valor) }}
                    </span>
                    <span v-if="t['tipo'] === 'image'">
                      {{ tratarImage(valor) }}
                    </span>
                    <span v-if="t['tipo'] === 'float'">
                      {{ tratarFloat(valor) }}
                    </span>
                    <span v-if="t['tipo'] === 'monetario'">
                      {{ tratarMonetario(valor) }}
                    </span>
                  </template>
                </template>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="row justify-content-center">
        <div class="col-auto">
          <paginate>
            <li
              v-for="(paginate, key) in this.paginateLinks"
              :key="key"
              :class="paginate.active ? 'page-item active' : 'page-item'"
              @click="paginacao(paginate)"
            >
              <a class="page-link" href="#" v-html="paginate.label"></a>
            </li>
          </paginate>
        </div>
      </div>
    </div>
  </div>
</template>
    
<script>
import Loader from "@/components/Loader.vue";
import Alert from "@/components/Alerts.vue";
import Paginate from "@/components/Paginate.vue";
export default {
  props: ["titulos"],
  components: {
    Loader,
    Alert,
    Paginate,
  },
  data() {
    return {
      perPage: 5,
      dados: "",
      search: "",
      data: "",
      dadosTotal: 0,
      paginateLinks: "",
      paginate: false,
      ordenaVal: "asc",
    };
  },
  computed: {
    dadosFiltrados() {
      let dadosFiltrados = [];
      if (this.dados != "") {
        let campos = [];

        //Tratamento dos Array dos campos
        for (let [key, value] of Object.entries(this.titulos)) {
          let vars = value.var.split(".");
          if (vars.length > 1) {
            let arrayVars = [];
            for (let i = 1; i < vars.length; i++) {
              arrayVars.push(vars[i]);
            }
            let variable = new Array();
            variable[vars[0]] = arrayVars;
            campos.push(variable);
          } else {
            campos.push(vars[0]);
          }
        }

        for (let [key, value] of Object.entries(this.dados.success)) {
          //console.log(key, value);
          this.dadosTotal = value.total !== null ? value.total : 0;
          this.paginateLinks = value.links !== null ? value.links : null;
          if (value.data) {
            value.data.map((item, chave) => {
              let itemFiltrado = {};

              campos.forEach((campo) => {
                if (Array.isArray(campo)) {
                  let campoTratado = "";
                  let campoTratado2 = [];
                  let cont = 0;
                  for (var k in campo) {
                    /**Pegar o 1° array */
                    if (cont === 0) {
                      campoTratado = k;
                    }
                    campoTratado2.push(campo[k][0]);
                    /**TRATAMENTO DE NÍVEIS */
                    if (typeof campo[k][1] !== "undefined") {
                      campoTratado2.push(campo[k][1]);
                    }
                    if (typeof campo[k][2] !== "undefined") {
                      campoTratado2.push(campo[k][2]);
                    }
                    if (typeof campo[k][3] !== "undefined") {
                      campoTratado2.push(campo[k][3]);
                    }
                    cont++;
                  }
                  let varCamp = "";
                  campoTratado2.forEach((varc) => {
                    varCamp += "." + varc;
                  });
                  k = k + varCamp;
                  if (item[campoTratado] !== null) {
                    /**Verificar a quantidade  do array dimensional - IMPORTANTE */
                    if (campoTratado2.length === 1) {
                      itemFiltrado[k] = item[campoTratado][campoTratado2];
                    } else if (campoTratado2.length === 2) {
                      let c0 = campoTratado2[0];
                      let c1 = campoTratado2[1];
                      itemFiltrado[k] = item[campoTratado][c0][c1];
                    } else if (campoTratado2.length === 3) {
                      let c0 = campoTratado2[0];
                      let c1 = campoTratado2[1];
                      let c2 = campoTratado2[2];
                      itemFiltrado[k] = item[campoTratado][c0][c1][c2];
                    } else if (campoTratado2.length === 4) {
                      let c0 = campoTratado2[0];
                      let c1 = campoTratado2[1];
                      let c2 = campoTratado2[2];
                      let c3 = campoTratado2[3];
                      itemFiltrado[k] = item[campoTratado][c0][c1][c2][c3];
                    }
                  } else {
                    itemFiltrado[k] = "";
                  }
                } else {
                  itemFiltrado[campo] = item[campo];
                }
              });
              dadosFiltrados.push(itemFiltrado);
            });
            console.log(dadosFiltrados);
            return dadosFiltrados;
          }
        }
      }
    },
  },
  methods: {
    tratarText(valor) {
      return valor;
    },
    tratarDate(valor) {
      if (valor) {
        return moment(valor).format("DD/MM/yyyy H:mm");
      }
    },
    tratarImage(valor) {
      return valor;
    },
    tratarFloat(valor) {
      return valor;
    },
    tratarMonetario(valor) {
      return valor;
    },
    async btnSearch() {
      this.paginate = false;
      this.dados = await this.$indexApi(
        this.$store.state.routeIndex,
        this.perPage,
        this.data,
        this.search,
        this.paginate
      );
    },
    async paginacao(p) {
      if (p.url) {
        this.paginate = true;
        this.dados = await this.$indexApi(
          p.url,
          this.perPage,
          this.data,
          this.search,
          this.paginate
        );
      }
    },
    async ordenaCollum(e) {
      this.paginate = false;
      let ordenaVal = this.ordenaVal === "asc" ? "desc" : "asc";
      this.dados = await this.$indexApi(
        this.$store.state.routeIndex,
        this.perPage,
        this.data,
        this.search,
        this.paginate,
        e,
        ordenaVal
      );
      this.ordenaVal = ordenaVal;
    },
  },
  async mounted() {
    //this.indexApi();
    this.paginate = false;
    this.dados = await this.$indexApi(
      this.$store.state.routeIndex,
      this.perPage,
      this.data,
      this.search,
      this.paginate
    );
  },
  watch: {
    async perPage() {
      this.paginate = false;
      this.dados = await this.$indexApi(
        this.$store.state.routeIndex,
        this.perPage,
        this.data,
        this.search,
        this.paginate
      );
    },
  },
};
</script>
<style scoped>
table {
  font-size: 11px;
}
table thead th {
  cursor: pointer;
}
.icons-thead {
  font-size: 13px;
  color: #777;
}
</style>

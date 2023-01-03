<template>
  <div class="q-pa-md">
    <q-table
      :dense="$q.screen.lt.md"
      :rows="linhas"
      :columns="colunas"
      row-key="name"
      :filter="filter"
    >
      <template v-slot:top-right>
        <RegionalCriarComponent />
      </template>
      <template v-slot:top-left>
        <q-input dense debounce="300" v-model="filter" placeholder="Pesquisar">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
      </template>
    </q-table>
  </div>
</template>

<script>
import { ref } from "vue";
import RegionalCriarComponent from "@/components/regional/CriarComponent.vue";

const colunas = [
  { name: "nome", label: "Nome", field: "nome", sortable: true },
  { name: "sigla", label: "Sigla", field: "sigla", sortable: true },
  {
    name: "data_cadastro",
    label: "Cadastro",
    field: "data_cadastro",
    sortable: true,
  },
  {
    name: "data_inativacao",
    label: "Inativação",
    field: "data_inativacao",
    sortable: true,
  },
];

export default {
  name: "RegionalListarComponent",
  components: {
    RegionalCriarComponent,
  },
  setup() {
    return {
      filter: ref(""),
      colunas,
    };
  },
  data() {
    return {
      linhas: [],
    };
  },
};
</script>

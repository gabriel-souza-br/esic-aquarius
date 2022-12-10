<!-- /src/layouts/PainelLayout.vue -->
<template>
  <q-layout view="hHh LpR fFf">
    <q-header elevated class="bg-primary text-white">
      <q-toolbar>
        <q-btn dense flat round icon="menu" @click="toggleLeftDrawer" />
        <q-separator dark vertical inset />
        <q-toolbar-title>
          e-SIC Aquarius - {{ user ? user.nome : "" }}
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-drawer
      show-if-above
      elevated
      v-model="leftDrawerOpen"
      side="left"
      class="bg-grey-3"
    >
      <MenuLayoutItem />
    </q-drawer>

    <q-page-container class="q-pa-md">
      <router-view></router-view>
    </q-page-container>
  </q-layout>
</template>

<script>
import { ref } from "vue";
import MenuLayoutItem from "@/layouts/itens/MenuLayout.vue";

export default {
  components: {
    MenuLayoutItem,
  },
  setup() {
    const leftDrawerOpen = ref(false);

    return {
      leftDrawerOpen,
      toggleLeftDrawer() {
        leftDrawerOpen.value = !leftDrawerOpen.value;
      },
    };
  },
  computed: {
    user() {
      return this.$store.getters["auth/estadoAtual"].user;
    },
  },
};
</script>
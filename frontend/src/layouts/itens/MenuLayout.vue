<!-- /src/layouts/itens/MenuLayout.vue -->
<template>
  <q-list separator>
    <q-item clickable v-ripple to="/auth/logout">
      <q-item-section avatar>
        <q-icon name="logout" />
      </q-item-section>
      <q-item-section>Logout</q-item-section>
    </q-item>

    <q-item clickable v-ripple to="/painel/regional">
      <q-item-section avatar>
        <q-icon name="travel_explore" />
      </q-item-section>
      <q-item-section>Regionais</q-item-section>
    </q-item>

    <q-item clickable v-ripple to="/auth/register">
      <q-item-section avatar>
        <q-icon name="receipt_long" />
      </q-item-section>
      <q-item-section>Solicitações</q-item-section>
    </q-item>
  </q-list>
</template>

<style>
</style>

<script>
export default {
  name: "MenuLayout",
};
</script>
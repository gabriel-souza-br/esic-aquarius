<!-- /src/layouts/itens/MenuLayout.vue -->
<template>
  <q-list separator>
    <q-item clickable v-ripple to="/auth/login">
      <q-item-section avatar>
        <q-icon name="inbox" />
      </q-item-section>

      <q-item-section>Inbox</q-item-section>
    </q-item>

    <q-item clickable v-ripple to="/">
      <q-item-section avatar>
        <q-icon name="delete" />
      </q-item-section>

      <q-item-section>Trash</q-item-section>
    </q-item>

    <q-item clickable v-ripple to="/auth/register">
      <q-item-section avatar>
        <q-icon name="send" />
      </q-item-section>

      <q-item-section>Outbox</q-item-section>
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
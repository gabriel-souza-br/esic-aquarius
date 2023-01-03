<template>
  <q-page style="background: linear-gradient(#555, #333)">
    <AuthLoginRegisterComponent />
  </q-page>
</template>

<script>
import AuthLoginRegisterComponent from "@/components/auth/LoginRegisterComponent";

export default {
  components: {
    AuthLoginRegisterComponent,
  },
};
</script>
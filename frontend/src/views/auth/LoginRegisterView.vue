<template>
  <q-page style="background: linear-gradient(#555, #333)">
    <LoginRegisterComponent />
  </q-page>
</template>

<script>
import LoginRegisterComponent from "@/components/auth/LoginRegisterComponent";

export default {
  components: {
    LoginRegisterComponent,
  },
};
</script>
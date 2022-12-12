import { createApp } from 'vue'
import { Quasar } from 'quasar'
import quasarUserOptions from '@/quasar-user-options'
import { boot } from 'quasar/wrappers'

import App from '@/App.vue'
import router from '@/router'
import store from "@/store";
import { axios, api } from "@/axios";

createApp(App)
    .use(store)
    .use(router)
    .use(
        Quasar,
        quasarUserOptions,
    )
    .mount('#app');


//Quasar framework config axios/api:
export default boot(({ app }) => {
    app.config.globalProperties.$axios = axios
    app.config.globalProperties.$api = api
})
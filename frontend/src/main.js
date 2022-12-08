import { createApp } from 'vue'
import App from './App.vue'
import { Quasar, Notify } from 'quasar'
import quasarUserOptions from './quasar-user-options'
import router from './router'

createApp(App)
    .use(router)
    .use(
        Quasar,
        {
            plugins: {
                Notify
            },
        },
        quasarUserOptions,
        router,
    ).mount('#app')

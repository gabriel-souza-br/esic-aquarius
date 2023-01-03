import { createRouter, createWebHistory } from 'vue-router'
import store from '@/store'

/*
 | Layouts:
 |------------------
 */
import PainelLayout from '@/layouts/PainelLayout'
import PublicoLayout from '@/layouts/PublicoLayout'
/*
 | Páginas:
 |------------------
 */
import RegisterPage from '@/pages/RegisterPage'
/*
 | Views:
 |------------------
 */
import AuthLoginRegisterView from '@/views/auth/LoginRegisterView'

const routes = [
    {
        path: '/',
        component: PublicoLayout,
        children: [
            {
                path: '/',
                component: AuthLoginRegisterView
            },
        ]
    },
    {
        path: '/auth',
        component: PublicoLayout,
        children: [
            {
                path: 'login',
                component: AuthLoginRegisterView
            },
            {
                path: 'logout',
                component: () => store.dispatch("auth/logout")
            },
            {
                path: 'register',
                component: RegisterPage
            }
        ]
    },
    {
        path: '/painel',
        component: PainelLayout,
        children: [
            {
                path: '',
                component: () => import('@/views/AboutView.vue')
            },            
            {
                path: 'regional',
                component: () => import('@/views/regional/ListarView.vue')
            },
            {
                path: 'solicitacoes',
                component: () => import('@/views/AboutView.vue')
            }
        ]
    },
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
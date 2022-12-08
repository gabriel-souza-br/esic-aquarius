import { createRouter, createWebHistory } from 'vue-router'
/*
 |------------------
 | Layouts:
 |------------------
 */
import PainelLayout from '@/layouts/PainelLayout'
import PublicoLayout from '@/layouts/PublicoLayout'
/*
 |------------------
 | Páginas:
 |------------------
 */
import RegisterPage from '@/pages/RegisterPage'
/*
 |------------------
 | Views:
 |------------------
 */
import LoginRegisterView from '@/views/auth/LoginRegisterView'

const routes = [
    {
        path: '/',
        component: PublicoLayout,
        children: [
            {
                path: '/',
                component: LoginRegisterView
            },
        ]
    },
    {
        path: '/auth',
        component: PublicoLayout,
        children: [
            {
                path: 'login',
                component: LoginRegisterView
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
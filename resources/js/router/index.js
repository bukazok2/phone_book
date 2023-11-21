import {createRouter, createWebHistory } from 'vue-router'

import phoneBook from '../components/phoneBooks/index.vue'
import newPhoneBook from '../components/newPhoneBook/index.vue'
import notFound from '../components/notFound.vue'

const routes = [
    {
        path: '/',
        component: phoneBook
    },
    {
        path: '/new',
        component: newPhoneBook
    },
    {
        path: '/:pathMatch(.*)*',
        component: notFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
import {createRouter, createWebHistory } from 'vue-router'

import phoneBook from '../components/phone_book/index.vue'
import notFound from '../components/notFound.vue'

const routes = [
    {
        path: '/',
        component: phoneBook
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
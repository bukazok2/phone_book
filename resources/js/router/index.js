import {createRouter, createWebHistory } from 'vue-router'

import phoneBook from '../components/phoneBooks/index.vue'
import newPhoneBook from '../components/newPhoneBook/index.vue'
import profile from '../components/profile/index.vue'
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
        path: '/new/:id',
        name: 'new',
        component: newPhoneBook,
        props: true
    },
    {
        path: '/profile/:id',
        name: 'profile',
        component: profile,
        props: true
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
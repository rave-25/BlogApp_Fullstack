import { createRouter, createWebHistory } from "vue-router";

import Tags from '../components/pages/Tags.vue'
import Home from '../components/pages/Home.vue'

const routes =[
    {
        path: '/',
        component: Home
    },
    {
        path: '/tags',
        component: Tags
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
import { createRouter, createWebHistory } from "vue-router";

import Tags from '../admin/pages/Tags.vue'
import Home from '../admin/pages/Home.vue'


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
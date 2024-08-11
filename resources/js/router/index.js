import { createWebHistory,createRouter } from "vue-router";
// FRONTEND
import home from '../pages/frontend/index.vue'

// BACKEND
import login from '../pages/backend/login.vue'
import register from '../pages/backend/register.vue'
import admin from '../pages/backend/index.vue'
import post from '../pages/backend/post.vue'
import store from '../pages/backend/store.vue'
import transection from '../pages/backend/transection.vue'
import report from '../pages/backend/report.vue'
import notfound from '../pages/backend/notfound.vue'

export const routes = [
    {
        name:'home',
        path:'/home',
        component: home
    },
    {
        name:'login2',
        path:'/login',
        component:login
    },
    {
        name:'login',
        path:'/',
        component:login
    },
    {
        name:'admin',
        path:'/admin',
        component:admin
    },
    {
        name:'post',
        path:'/post',
        component:post
    },
    {
        name:'store',
        path:'/store',
        component:store
    },
    {
        name:'transection',
        path:'/transection',
        component:transection
    },
    {
        name:'report',
        path:'/report',
        component:report
    },
    {
        name:'register',
        path:'/register',
        component:register
    },
    {
        path:'/:catchAll(.*)',
        component:notfound
    }
];

const router = createRouter({
    history:createWebHistory(),
    routes:routes,

    scrollBehavior(){
        window.scrollTo(10,10);
    }
});

export default router;
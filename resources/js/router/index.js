import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'dashboard',
        meta: {
                title: 'Dashboard',
                authRequired: true,
            },
        component: () => import('../views/home.vue'),
    },
    {
        path: '/login',
        name: 'login',
        meta: { title: 'Login' },
        component: () => import('../views/account/login.vue')
    },

    {
        path: '/pages/starter',
        meta: { authRequired: true, title: 'Starter Page' },
        component: () => import('../views/utility/starter.vue')
    },
    {
        path: '/pages/maintenance',
        meta: { authRequired: true, title: 'Maintenance' },
        component: () => import('../views/utility/maintenance.vue')
    },
    {
        path: '/pages/coming-soon',
        meta: { authRequired: true, title: 'Comming Soon' },
        component: () => import('../views/utility/coming-soon.vue')
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

// Before each route evaluates...
router.beforeEach(async (routeTo, routeFrom, next) => {
    // set title name
    if (routeTo.meta.title != undefined) {
        document.title = routeTo.meta.title + " | v3";
    }

    const authRequired = routeTo.matched.some((route) => route.meta.authRequired);
    if (!authRequired) return next();

    if (localStorage.getItem('user')) {
        next();
    } else {
        next({ name: 'login', query: { redirectFrom: routeTo.fullPath } });
    }

});

export default router;

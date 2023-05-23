import * as VueRouter from 'vue-router'

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(import.meta.env.BASE_URL),
    routes: [

        {
            path: '/',
            component: () => import('@/views/main/IndexComponent.vue'),
            name: 'main.index.index'
        },
        {
            path: '/about',
            component: () => import('@/views/main/AboutComponent.vue'),
            name: 'main.about.index'
        },
        {
            path: '/posts',
            component: () => import('@/views/main/post/IndexComponent.vue'),
            name: 'main.posts.index'
        },
        {
            path: '/posts/:id',
            component: () => import('@/views/main/post/ShowComponent.vue'),
            name: 'main.posts.show'
        },
        {
            path: '/contacts',
            component: () => import('@/views/main/ContactsComponent.vue'),
            name: 'main.contacts.index'
        },
        {
            path: '/users/user',
            component: () => import('@/views/main/user/UserComponent.vue'),
            name: 'main.user'
        },
        {
            path: '/users/signup',
            component: () => import('@/views/main/user/RegistrationComponent.vue'),
            name: 'main.signup'
        },
        {
            path: '/users/signin',
            component: () => import('@/views/main/user/LoginComponent.vue'),
            name: 'main.signin'
        },
        {
            path: '/users/user/likes',
            component: () => import('@/views/main/user/like/IndexComponent.vue'),
            name: 'main.user.likes.index'
        },
        {
            path: '/users/user/comments',
            component: () => import('@/views/main/user/comment/IndexComponent.vue'),
            name: 'main.user.comments.index'
        },
        {
            path: '/:catchAll(.*)',
            component: () => import('@/views/main/404.vue'),
            name: 'error.404'
        }

    ]
})

router.beforeEach((to, from, next) => {

    const accessToken = localStorage.getItem('access_token')

    if (to.name === 'main.user' ||
        to.name === 'main.user.likes.index' ||
        to.name === 'main.user.comments.index') {
        if (!accessToken) {
            return next({name: 'main.signin'})
        }
        if (accessToken) {
            return next()
        }
    } else if (to.name === 'main.signin' || to.name === 'main.signup') {
        if (!accessToken) {
            return next()
        }
        if (accessToken) {
            return next({name: 'main.index.index'})
        }
    } else {
        return next()
    }

})

export default router

import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path: '/pages',
        name: 'Pages',
        component: () => import('@/modules/Cms/views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-finance:invoice.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/pages/:id/content',
        name: 'Page Content',
        component: () => import('@/modules/Cms/views/PageContent.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-finance:invoice.edit', to.params)) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/common_contents/:key',
        name: 'Common Page Content',
        component: () => import('@/modules/Cms/views/EditCommonContent.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-finance:invoice.edit', to.params)) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },


    {
        path: '/news',
        name: 'News',
        component: () => import('@/modules/Cms/views/news/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-finance:invoice.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },

    {
        path: '/news/create',
        name: 'Create News',
        component: () => import('@/modules/Cms/views/news/Create.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-finance:invoice.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/news/:id/edit',
        name: 'Edit News',
        component: () => import('@/modules/Cms/views/news/Edit.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-finance:invoice.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },

]

export default routes

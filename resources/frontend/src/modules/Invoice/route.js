import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path: '/invoices',
        name: 'Invoices',
        component: () => import('@/modules/Invoice/views/Index.vue'),
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
        path: '/invoices/create',
        name: 'Create Invoice',
        component: () => import('@/modules/Invoice/views/Create.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-finance:invoice.create', to.params)) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/invoices/:id',
        name: 'Invoice',
        component: () => import('@/modules/Invoice/views/Show.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-finance:invoice.show', to.params)) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/invoices/:id/edit',
        name: 'Edit Invoice',
        component: () => import('@/modules/Invoice/views/Edit.vue'),
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
        path: '/invoices/:id/trail',
        name: 'Invoice Trail',
        component: () => import('@/modules/Invoice/views/Trail.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-finance:invoice.show', to.params)) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
]

export default routes

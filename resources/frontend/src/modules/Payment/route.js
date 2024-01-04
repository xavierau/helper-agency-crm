import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path       : '/payments',
        name       : 'Payments',
        component  : () => import('@/modules/Payment/views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-finance:payment.list')) {next()} else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path       : '/payments/:id',
        name       : 'Payment',
        component  : () => import('@/modules/Payment/views/Show.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-finance:payment.show', to.params)) {next()} else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path       : '/payments/create',
        name       : 'Create Payment',
        component  : () => import('@/modules/Payment/views/Create.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-finance:payment.create', to.params)) {next()} else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path       : '/payments/:id/edit',
        name       : 'Edit Payment',
        component  : () => import('@/modules/Payment/views/Edit.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-finance:payment.edit', to.params)) {next()} else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
]

export default routes

import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path: '/contracts',
        name: 'Contracts',
        component: () => import('@/modules/Contract/views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:contract.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/contracts/:id',
        name: 'Contract',
        component: () => import('@/modules/Contract/views/Show.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:contract.show')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/contracts/:id/supersede',
        name: 'Supersede Contract',
        component: () => import('@/modules/Contract/views/Supersede.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:contract.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    }
]

export default routes

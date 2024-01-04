import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path: '/jobs',
        name: 'Jobs',
        component: () => import('@/modules/Job/views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:job.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/jobs/create',
        name: 'Create Job',
        component: () => import('@/modules/Job/views/Create.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:job.create')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/jobs/:id(\\d+)',
        name: 'Job',
        component: () => import('@/modules/Job/views/Show.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:job.show', to.params)) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
]

export default routes

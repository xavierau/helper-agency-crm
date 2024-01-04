import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path       : '/workflows',
        name       : 'Workflows',
        component  : () => import('@/modules/Workflow/views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:workflow.list')) {next()} else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path       : '/workflows/:id',
        name       : 'Workflow',
        component  : () => import('@/modules/Workflow/views/Show.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:workflow.show', [to.params])) {next()} else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
]

export default routes


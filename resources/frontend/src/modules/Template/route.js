import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path: '/templates',
        name: 'Templates',
        component: () => import('@/modules/Template/views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-template:template.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/templates/:id',
        name: 'Template',
        component: () => import('@/modules/Template/views/Show.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-template:template.edit', [to.params])) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/templates/create',
        name: 'Create Template',
        component: () => import('@/modules/Template/views/Create.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-template:template.create', [to.params])) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
]

export default routes

import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path: '/suppliers',
        name: 'Suppliers',
        component: () => import('./views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:supplier.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/suppliers/:id',
        name: 'Supplier',
        component: () => import('./views/Show.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:supplier.show', [to.params])) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
]

export default routes


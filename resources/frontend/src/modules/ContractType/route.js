import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path: '/contract_types',
        name: 'Contract Types',
        component: () => import('./views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-contract:contract_type.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
]

export default routes

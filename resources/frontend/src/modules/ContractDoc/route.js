import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path: '/contract_docs',
        name: 'Contract Documents',
        component: () => import('./views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-contract-doc:contract_doc.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    }
]

export default routes

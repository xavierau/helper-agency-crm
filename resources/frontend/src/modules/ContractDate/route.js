import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path: '/contract_dates',
        name: 'Contract Dates',
        component: () => import('./views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-contract-date:contract_date.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    }
]

export default routes

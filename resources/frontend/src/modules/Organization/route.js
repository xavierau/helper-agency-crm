import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path: '/organizations',
        name: 'Organizations',
        component: () => import('@/modules/Organization/views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:organization.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    }
]

export default routes

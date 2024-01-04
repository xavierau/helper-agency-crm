import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path       : '/duties/index',
        name       : 'Duties',
        component  : () => import('@/modules/Duty/views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:duty.list')) {next()} else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
]

export default routes

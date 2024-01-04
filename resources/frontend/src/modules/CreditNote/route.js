import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path: '/credit_notes',
        name: 'Credit Notes',
        component: () => import('./views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-finance:credit_note.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    }
]

export default routes

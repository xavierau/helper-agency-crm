import store from "@/store";
import Vue from 'vue'

const routes = [
    {
        path: '/sellables/index',
        name: 'Products',
        component: () => import('@/modules/Sellable/views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:sellable.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/sellables/:id',
        name: 'Product',
        component: () => import('@/modules/Sellable/views/Show.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:sellable.show', to.params)) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/variants',
        name: 'Variants',
        component: () => import('@/modules/Sellable/views/Variants.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:variants.index', to.params)) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/sellables/:product_id/variants/:variant_id/template',
        name: 'Product Variant Template',
        component: () => import('@/modules/Sellable/views/VariantTemplate.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:variants.template', to.params)) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/sellables/:product_id/template',
        name: 'Product Template',
        component: () => import('@/modules/Sellable/views/SellableTemplate.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:variants.template', to.params)) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
]

export default routes

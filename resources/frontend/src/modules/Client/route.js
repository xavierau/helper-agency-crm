import {hasPermission} from "@/router/middelware";

const routes = [
    {
        path: '/clients/index',
        name: 'Clients',
        component: () => import(/* webpackChunkName: "client" */ '@/modules/Client/views/Index.vue'),
        beforeEnter: hasPermission('agency-core:client.list',
            'You are not authorized to access this page',
            'Dashboard')
    },
    {
        path: '/clients/:id/edit',
        name: 'Edit Client',
        component: () => import(/* webpackChunkName: "client" */ '@/modules/Client/views/Edit.vue'),
        beforeEnter: hasPermission('agency-core:client.edit',
            'You are not authorized to access this page',
            'Dashboard')
    },
    {
        path: '/clients/:id/addresses',
        name: 'Client Addresses',
        component: () => import(/* webpackChunkName: "client" */ '@/modules/Client/views/EditAddresses.vue'),
        beforeEnter: hasPermission('agency-core:client.show',
            'You are not authorized to access this page',
            'Dashboard')
    },
    {
        path: '/clients/:id',
        name: 'Client',
        component: () => import(/* webpackChunkName: "client" */ '@/modules/Client/views/Show.vue'),
        beforeEnter: hasPermission('agency-core:client.show',
            'You are not authorized to access this page',
            'Dashboard')
    },
]

export default routes

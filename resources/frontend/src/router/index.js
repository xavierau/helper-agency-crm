import Vue from 'vue'
import Router from 'vue-router'
import api from "@/api"

import ApplicantRoutes from "@/modules/Applicant/route"
import ClientRoutes from "@/modules/Client/route"
import JobRoutes from "@/modules/Job/route"
import DutyRoutes from "@/modules/Duty/route"
import SellableRoutes from "@/modules/Sellable/route"
import InvoiceRoutes from "@/modules/Invoice/route"
import ContractRoutes from "@/modules/Contract/route"
import PaymentRoutes from "@/modules/Payment/route"
import TemplateRoutes from "@/modules/Template/route"
import WorkflowRoutes from "@/modules/Workflow/route"
import OrganizationRoutes from "@/modules/Organization/route"
import ContractDateRoutes from "@/modules/ContractDate/route"
import ContractDocRoutes from "@/modules/ContractDoc/route"
import ContractTypeRoutes from "@/modules/ContractType/route"
import SupplierRoutes from "@/modules/Supplier/route"
import CreditNoteRoutes from "@/modules/CreditNote/route"
import CmsRoutes from "@/modules/Cms/route"

// Containers
const TheContainer = () => import('@/containers/TheContainer')

// Views
const Dashboard = () => import('@/views/Dashboard')

// Views - Pages
const Page404 = () => import('@/views/pages/Page404')
const Login = () => import('@/views/pages/Login')
const Register = () => import('@/modules/Applicant/views/Register')
const Search = () => import('@/modules/Applicant/views/Search')

Vue.use(Router)

const router = new Router({
    mode: 'hash', // https://router.vuejs.org/api/#mode
    linkActiveClass: 'active',
    scrollBehavior: () => ({y: 0}),
    routes: configRoutes()
})

export default router

function configRoutes() {
    return [
        {
            path: '/',
            redirect: '/dashboard',
            name: 'Home',
            component: TheContainer,
            beforeEnter: (to, from, next) => {
                api.isLogin()
                    .then(() => {
                        console.log('global guard: authenticated')
                        next()
                    })
                    .catch(() => {
                        console.log('global guard: unauthenticated')
                        next({name: 'Login'})
                    })
            },
            children: [
                {
                    path: 'dashboard',
                    name: 'Dashboard',
                    component: Dashboard
                },
                ...ApplicantRoutes,
                ...ClientRoutes,
                ...JobRoutes,
                ...DutyRoutes,
                ...SellableRoutes,
                ...InvoiceRoutes,
                ...ContractRoutes,
                ...PaymentRoutes,
                ...TemplateRoutes,
                ...WorkflowRoutes,
                ...OrganizationRoutes,
                ...ContractDateRoutes,
                ...ContractTypeRoutes,
                ...ContractDocRoutes,
                ...SupplierRoutes,
                ...CreditNoteRoutes,
                ...CmsRoutes
            ]
        },
        {
            path: '/pages',
            redirect: '/pages/404',
            name: 'Pages',
            component: {
                render(c) {
                    return c('router-view')
                }
            },
            children: [
                {
                    path: 'login',
                    name: 'Login',
                    component: Login
                },

            ]
        },
        {
            path: '/register',
            name: 'Register',
            component: Register
        },
        {
            path: '/search',
            name: 'Search',
            component: Search
        },
        {
            path: '*',
            name: 'Not Found',
            component: Page404
        }
    ]
}


import store from "@/store";
import Vue from 'vue'

export const RouteName = {
    Applicants: "Applicants",
    Applicant: "Applicant",
    EditApplicantPersonalInfo: "Edit Applicant Personal Info",
    EditApplicantExperience: "Edit Applicant Experience",
    AddApplicantExperience: "Add Applicant Experience",
    EditApplicantBasicInfo: "Edit Applicant Basic Info",
    ImportApplicant: "Import Applicant",
    ImportExperience: "Import Experience"
}

const routes = [
    {
        path: '/applicants/index',
        name: RouteName.Applicants,
        component: () => import('@/modules/Applicant/views/Index.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:applicant.list')) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/applicants/show/:id',
        name: RouteName.Applicant,
        component: () => import('@/modules/Applicant/views/Show.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:applicant.show', [to.params])) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/applicants/:id/edit/personal_info',
        name: RouteName.EditApplicantPersonalInfo,
        component: () => import('@/modules/Applicant/views/EditPersonalInfo.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:applicant.edit', [to.params])) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/applicants/:id/edit/basic_info',
        name: RouteName.EditApplicantBasicInfo,
        component: () => import('@/modules/Applicant/views/EditBasicInfo.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:applicant.edit', [to.params])) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/experiences/:id/edit',
        name: RouteName.EditApplicantExperience,
        component: () => import('@/modules/Applicant/views/Show.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:applicant.edit', [to.params])) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/applicants/:id/experiences/create',
        name: RouteName.AddApplicantExperience,
        component: () => import('@/modules/Applicant/views/Show.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:applicant.edit', [to.params])) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/applicants/import',
        name: RouteName.ImportApplicant,
        component: () => import('@/modules/Applicant/views/ImportApplicant.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:applicant.edit', [to.params])) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
    {
        path: '/applicants/experiences/import',
        name: RouteName.ImportExperience,
        component: () => import('@/modules/Applicant/views/ImportApplicantExperience.vue'),
        beforeEnter: (to, from, next) => {
            if (store.getters.can('agency-core:applicant.edit', [to.params])) {
                next()
            } else {
                Vue.toasted.error('You are not authorized to access this page')
                next({name: 'Dashboard'})
            }
        }
    },
]

export default routes

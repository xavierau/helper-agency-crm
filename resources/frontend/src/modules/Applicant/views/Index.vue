<template>
    <div class="ApplicantIndex">
        <CCard>
            <CCardHeader
                class="d-flex justify-content-between align-content-center"
            >
                <h5 class="m-0">All applicants</h5>
                <div>
                    <router-link
                        :to="{name:RouteName.ImportApplicant}"
                        class="btn btn-sm btn-primary mx-2"
                    >
                        <i class="fa fa-plus"></i> Import
                    </router-link>
                    <router-link
                        :to="{name:RouteName.ImportExperience}"
                        class="btn btn-sm btn-primary mx-2"
                    >
                        <i class="fa fa-plus"></i> Import Experience
                    </router-link>
                    <button
                        @click="showCreateModal = !showCreateModal"
                        class="btn btn-sm btn-success mx-2"
                    >
                        <i class="fa fa-plus"></i> Applicant
                    </button>
                </div>

            </CCardHeader>
            <CCardBody v-if="paginator">
                <section class="row">
                    <div class="col-12">
                        <h3>Experience filters</h3>
                    </div>
                    <div
                        class="col-sm-4 col-md-3"
                        v-for="duty in duties"
                        :key="duty.id"
                    >
                        <label>
                            <input
                                type="checkbox"
                                :value="duty.id"
                                @change="searchSelectedDuties"
                                v-model="selectedDuties"
                            />
                            {{ duty.label }}
                        </label>
                    </div>
                </section>
                <CDataTable
                    :items="items"
                    :fields="fields"
                    :loading="isLoading"
                    hover
                    :items-per-page="pageSize"
                    :items-per-page-select="{ external: true }"
                    :column-filter="{ external: true, lazy: true }"
                    :table-filter="{ external: true, lazy: true }"
                    :sorter="{ external: true, resetable: true }"
                    @pagination-change="updatePerPageItems"
                    @update:table-filter-value="updateTableFilter"
                    @update:column-filter-value="updateColumnFilter"
                    @update:sorter-value="updateSorter"
                >
                    <template #name="{item}">
                        <td>
                            <img width="20%" :src="item.thumbnail" alt=""/>
                            <router-link
                                :to="{
                                    name: 'Applicant',
                                    params: { id: item.id }
                                }"
                            >
                                {{ item.name }}
                            </router-link>
                        </td>
                    </template>

                    <template #status-filter="{item}">
                        <select
                            class="form-control"
                            style="height:28.36px; padding:0; font-size:0.76562rem"
                            v-model="columnFilters['status']"
                            @change="updateColumnFilter"
                        >
                            <option :value="null"></option>
                            <option
                                v-for="(value, index) in status"
                                :key="index"
                                :value="value"
                            >
                                {{ value }}
                            </option>
                        </select>
                    </template>
                    <template #is_approved-filter="{item}">
                        <select
                            class="form-control"
                            style="height:28.36px; padding:0; font-size:0.76562rem"
                            v-model="columnFilters['is_approved']"
                            @change="updateColumnFilter"
                        >
                            <option :value="null"></option>
                            <option :value="1" selected>Approved</option>
                            <option
                                :value="0"
                                :selected="
                                    $route.query['filter[is_approved]'] == 0
                                "
                            >Pending
                            </option
                            >
                        </select>
                    </template>
                    <template #gender-filter="{item}">
                        <select
                            class="form-control"
                            style="height:28.36px; padding:0; font-size:0.76562rem"
                            v-model="columnFilters['gender']"
                            @change="updateColumnFilter"
                        >
                            <option :value="null"></option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </template>
                    <template #current_country-filter="{item}">
                        <select
                            class="form-control"
                            style="height:28.36px; padding:0; font-size:0.76562rem"
                            v-model="columnFilters['current_location']"
                            @change="updateColumnFilter"
                        >
                            <option value="local">Local</option>
                            <option value="overseas">overseas</option>
                        </select>
                    </template>
                    <template #is_approved="{item}">
                        <td>
                            <span
                                class="badge"
                                :class="{
                                    'badge-success': item.is_approved,
                                    'badge-warning': !item.is_approved
                                }"
                                v-text="
                                    item.is_approved ? 'Approved' : 'Pending'
                                "
                            ></span>
                        </td>
                    </template>
                    <template #status="{item}">
                        <td>
                            <span
                                class="badge"
                                :class="{
                                    'badge-success': item.status==='active',
                                    'badge-warning': item.status !== 'active'
                                }"
                                v-text="
                                    item.status === 'active'
                                        ? 'Active'
                                        : 'Inactive'
                                "
                            ></span>
                        </td>
                    </template>
                    <template #gender="{item}">
                        <td>
                            {{ item.gender | capitalize }}
                        </td>
                    </template>
                    <template #actions="{item}">
                        <td>
                            <div class="btn-group btn-group-sm mr-3">
                                <router-link
                                    class="btn btn-primary"
                                    :to="{
                                        name: 'Applicant',
                                        params: { id: item.id }
                                    }"
                                >
                                    <i class="far fa-eye"></i>
                                </router-link>
                            </div>
                            <router-link :to="{name:'Edit Applicant', params:{id:item.id}}"
                                         class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </router-link>
                            <button class="btn btn-sm btn-danger"
                                    type="button"
                                    @click="deleteApplicant(item)">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </template>
                </CDataTable>
                <CPagination
                    :activePage="paginationObject.activePage"
                    :pages="paginationObject.pages"
                    @update:activePage="updateActivePage"
                />
            </CCardBody>
            <CCardBody v-else>
                <h4>Loading...</h4>
            </CCardBody>
        </CCard>
        <CModal
            :show.sync="showCreateModal"
            title="Create New Applicant"
            color="success"
            static
            size="xl"
        >
            <create-new-applicant-form :form-data.sync="formData"/>
            <template #footer>
                <button @click="submit" class="btn btn-success">Create</button>
            </template>
        </CModal>
    </div>
</template>

<script>
import endpoints from "@/modules/Applicant/endpoints";
import CreateNewApplicantForm from "@/modules/Applicant/views/partials/CreateNewApplicantForm";
import client from "@/client";
import _ from "lodash";

import duty_endpoints from "@/modules/Duty/endpoints";

import "vue-form-wizard/dist/vue-form-wizard.min.css";
import {capitalize} from "@/filters/common";

import datatable from "@/mixins/datatable";
import {RouteName} from "@/modules/Applicant/route";

const defaultFormData = {
    age_of_daughters: "",
    age_of_sons: "",
    date_of_release: null,
    cantonese: "",
    current_country: null,
    date_of_birth: null,
    duties: [],
    email: null,
    english: "",
    experience: null,
    facebook: null,
    father_age: null,
    father_name: null,
    father_occupation: null,
    gender: "female",
    height: null,
    highest_education: null,
    mandarin: "",
    marital_status: 'single',
    mother_age: null,
    mother_name: null,
    mother_occupation: null,
    name: null,
    nationality: null,
    number_in_family: 1,
    number_of_brothers: 0,
    number_of_daughters: 0,
    number_of_sisters: 0,
    number_of_sons: 0,
    other_language: "",
    phone: null,
    spouse_age: null,
    spouse_name: null,
    spouse_occupation: null,
    weight: null,
    sunday: false,
    weekday: false,
    alternative: false,
    no_holidays: false,
    once_a_month: false,
    questions: {
        change_name: true,
        change_name_info: null,
        has_been_deport: true,
        has_been_deport_info: null,
        reject_visa: true,
        reject_visa_info: null,
        afraid_of_dog: false,
        eat_pork: true,
        smoke_and_drink: false,
    },
};

export default {
    name: "ApplicantIndex",
    components: {
        CreateNewApplicantForm
    },
    mixins: [datatable],
    filters: {
        capitalize
    },
    data() {
        return {
            showCreateModal: false,
            selectedDuties: [],
            isLoading: true,
            fields: [
                {key: "name"},
                {key: "nationality"},
                {key: "gender"},
                {key: "age"},
                {key: "current_location"},
                {key: "status"},
                {key: "is_approved"},
                {
                    key: "actions",
                    sorter: false,
                    filter: false
                }
            ],
            status: ["active", "inactive"],
            formData: Object.assign({}, defaultFormData),
            external_url: endpoints.list,
            duties: []
        };
    },
    beforeRouteUpdate(to, from, next) {
        this.columnFilters = to.query;

        this.$nextTick(() => {
            this.fetchItems();
        });

        next();
    },
    created() {
        client.get(duty_endpoints.all).then(({data}) => (this.duties = data));
    },
    computed: {
        RouteName() {
            return RouteName
        },
        canListUsers() {
            let permission = "user.hello";
            return this.$store.getters.can(permission);
        },
        permissions() {
            return this.$store.getters.permissions;
        }
    },
    methods: {
        submit() {

            console.log('before form submit', this.formData)
            client
                .post(endpoints.store, this.formData)
                .then(() => this.$toasted.success("New applicant created"))
                .then(() => this.showCreateModal = false)
                .then(() => this.formData = _.cloneDeep(defaultFormData))
                .then(() => this.updateColumnFilter({type: null}))
                .catch(error => this.$toasted.error("Cannot create applicant. " + error.message));
        },
        deleteApplicant(applicant) {
            if (confirm('Are you sure you want to delete this applicant?')) {
                client.delete(endpoints.delete(applicant.id))
                    .then(() => this.$toasted.success("Applicant deleted"))
                    .then(() => this.updateColumnFilter({type: null}))
                    .catch(error => this.$toasted.error("Cannot delete applicant. " + error.message));
            }
        },
        searchSelectedDuties() {
            this.columnFilters["duties"] = this.selectedDuties;
            this.updateColumnFilter({type: null});
        }
    }
};
</script>

<style>
.table td {
    vertical-align: middle;
}
</style>

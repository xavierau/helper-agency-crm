<template>
    <div class="ClientIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">All clients</h5>
                <button @click="newClientModal=true"
                        class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Client
                </button>
            </CCardHeader>
            <CCardBody>
                <CDataTable
                    :items="items"
                    :fields="fields"
                    :loading="isLoading"
                    hover
                    :items-per-page="pageSize"
                    :items-per-page-select="{external:true}"
                    :column-filter="{ external: true, lazy: true }"
                    :table-filter="{ external: true, lazy: true }"
                    :sorter="{ external: true, resetable: true }"
                    @pagination-change="updatePerPageItems"
                    @update:table-filter-value="updateTableFilter"
                    @update:column-filter-value="updateColumnFilter"
                    @update:sorter-value="updateSorter">
                    <template #status-filter="{item}">
                        <select class="form-control"
                                style="height:28.36px; padding:0; font-size:0.76562rem"
                                @change="updateColumnFilter">
                            <option :value="null"></option>
                            <option v-for="(value, index) in status" :key="index"
                                    :value="value"> {{ value }}
                            </option>
                        </select>
                    </template>
                    <template #actions="{item}">
                        <td>
                            <div class="btn-group btn-group-sm mr-3">
                                <router-link :to="{name:'Client',params:{id:item.id}}"
                                             class="btn btn-info">
                                    <i class="fa fa-eye"></i>
                                </router-link>
                            </div>
                            <button class="btn btn-sm btn-danger">X</button>
                        </td>
                    </template>
                </CDataTable>
                <CPagination
                    :activePage="paginationObjet.activePage"
                    :pages="paginationObjet.pages"
                    @update:activePage="updateActivePage"
                />
            </CCardBody>
        </CCard>
        <CModal
            title="New Client"
            color="success"
            size="xl"
            :close-on-backdrop="false"
            :show.sync="newClientModal">
            <client-form :form-data.sync="formData"/>
            <template #footer>
                <button @click="closeModal"
                        class="btn btn-secondary">Close
                </button>
                <button @click="submit"
                        class="btn btn-success">Save
                </button>
            </template>
        </CModal>
    </div>
</template>

<script>
import endpoints from "@/modules/Client/endpoints"
import client from "@/client.js"
import ClientForm from "@/modules/Client/partials/CreateNewForm.vue"
import datatable from "@/mixins/datatable"

export default {
    name: "ClientIndex",
    mixins: [datatable],
    components: {
        ClientForm
    },
    data() {
        return {
            newClientModal: false,
            isLoading: true,
            fields: [
                {key: 'first_name'},
                {key: 'last_name'},
                {key: 'mobile'},
                {
                    key: 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            external_url: endpoints.list,
            status: [
                'active',
                'inactive'
            ],
            formData: {
                prefix: 'ms',
                first_name: null,
                last_name: null,
                mobile: null,
                service_type: 'people',
                country: 'Hong Kong',
                address_1: null,
                address_2: null,
                address_3: null,
                people: {
                    type: 'no_preference',
                    note: '',
                    nationality: null,
                    garden_size: null,
                    disabled_personnel: null,
                    number_of_cars: null,
                    number_of_kids: null,
                    age_of_kids: null,
                    pets: null,
                },
                other: {
                    services: [],
                    note: ''
                },
            },
        }
    },
    computed: {
        canListUsers() {
            let permission = 'user.hello'
            return this.$store.getters.can(permission)
        },
        permissions() {
            return this.$store.getters.permissions
        },
        items() {
            return this.paginator ? this.paginator.data : null;
        },
        paginationObjet() {
            return {
                pages: this.paginator ? this.paginator.last_page : 0,
                activePage: this.paginator ? this.paginator.current_page : 0,
            }
        }
    },
    created() {
        this.fetchItems()
    },
    methods: {
        resetForm() {
        },
        closeModal() {
            this.resetForm()
            this.newClientModal = false
        },
        submit() {
            let job = null,
                data = this.formData

            data['is_male'] = (this.formData.prefix === 'mr')
            client.post(endpoints.new_client_and_job, data)
                .then(({data}) => job = data)
                .then(() => this.newClientModal = false)
                .then(() => this.$router.push({name: 'Job', params: {id: job.id}}))
                .then(() => this.$toasted.success('New client and job created'))
                .catch(error => console.log(error))
        }
    }
}
</script>

<style scoped>

</style>

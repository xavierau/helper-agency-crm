<template>
    <div class="ContractIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">All Contracts</h5>
                <button @click="showCreateModal = !showCreateModal"
                        class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i>
                </button>
            </CCardHeader>
            <CCardBody v-if="paginator">
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
                    <template #contractTypeLabel="{item}">
                        <td>
                            {{ item.contract_type.label }}
                        </td>
                    </template>
                    <template #contract_number="{item}">
                        <td>
                            <router-link class=""
                                         :to="{name:'Contract',params:{id:item.id}}">
                                {{ item.contract_number }}
                            </router-link>
                        </td>
                    </template>
                    <template #clientName="{item}">
                        <td>
                            <router-link :to="{name:'Client',params:{id:item.client.id}}">
                                {{ item.client.full_name }}
                            </router-link>
                        </td>
                    </template>
                    <template #applicantName="{item}">
                        <td>
                            <router-link :to="{name:'Applicant',params:{id:item.applicant.id}}">{{
                                    item.applicant.name
                                }}
                            </router-link>
                        </td>
                    </template>
                    <template #actions="{item}">
                        <td>
                            <button class="btn btn-sm btn-danger"><i
                                class="fas fa-trash-alt"></i></button>
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
    </div>
</template>

<script>
import endpoints from "@/modules/Contract/endpoints"
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import {capitalize} from "@/filters/common"

import datatable from '@/mixins/datatable'

export default {
    name: "ContractIndex",
    mixins: [datatable],
    filters: {
        capitalize
    },
    data() {
        return {
            showCreateModal: false,
            isLoading: true,
            fields: [
                {key: 'contract_number'},
                {key: 'clientName', label: 'Client Name'},
                {key: 'applicantName'},
                {key: 'start_date'},
                {key: 'end_date'},
                {key: 'status'},
                {key: 'contractTypeLabel', label: 'Contract Type'},
                {
                    key: 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            external_url: endpoints.list
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
    },
    methods: {}
}
</script>

<style scoped>

</style>

<template>
    <div class="ContractIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">All Credit Notes</h5>
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
                    <template #from_contract.client_name="{item}">
                        <td>
                            <router-link class=""
                                         :to="{name:'Contract',params:{id:item.id}}">
                                {{ item.from_contract.client_name }}
                            </router-link>
                        </td>
                    </template>
                    <template #amount="{item}">
                        <td>
                            {{ item.amount | formatCurrency }}
                        </td>
                    </template>
                    <template #expired_date="{item}">
                        <td>
                            {{ item.expired_date | formatDate }}
                        </td>
                    </template>
                    <template #status="{item}">
                        <td>
                            {{ item.status | capitalize }}
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
import endpoints from "../endpoints"
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import {capitalize, formatDate, formatCurrency} from "@/filters/common"

import datatable from '@/mixins/datatable'

export default {
    name: "CreditNoteIndex",
    mixins: [datatable],
    filters: {
        capitalize,
        formatDate,
        formatCurrency
    },
    data() {
        return {
            showCreateModal: false,
            isLoading: true,
            fields: [
                {key: 'from_contract.client_name'},
                {key: 'amount'},
                {key: 'expired_date'},
                {key: 'status'},
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

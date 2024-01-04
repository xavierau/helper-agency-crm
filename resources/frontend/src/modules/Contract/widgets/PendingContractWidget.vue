<template>
    <CCard>
        <CCardHeader>Pending Contracts</CCardHeader>
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
            </CDataTable>
            <CPagination
                :activePage="paginationObject.activePage"
                :pages="paginationObject.pages"
                @update:activePage="updateActivePage"
            />
        </CCardBody>
    </CCard>
</template>

<script>
import datatable from "@/mixins/datatable";
import endpoints from "@/modules/Contract/endpoints";

export default {
    name: "PendingContractWidget",
    mixins: [datatable],
    data() {
        return {
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
    }

}
</script>

<style scoped>

</style>

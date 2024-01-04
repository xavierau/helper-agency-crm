<template>
    <div class="JobIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">All Jobs</h5>
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
                    @update:sorter-value="updateSorter"
                >
                    <template #status-filter="{item}">
                        <select class="form-control"
                                style="height:28.36px; padding:0; font-size:0.76562rem"
                                v-model="columnFilters.status"
                                @change="updateColumnFilter">
                            <option value="active" selected>Active</option>
                            <option value="lost">Lost</option>
                            <option value="win">Win</option>
                        </select>
                    </template>
                    <template #client_name="{item}">
                        <td>
                            <router-link :to="{name:'Client', params:{id:item.client_id}}">
                                {{ item.client_name | capitalize }}
                            </router-link>
                        </td>
                    </template>
                    <template #service_type="{item}">
                        <td>
                            {{ item.service_type | capitalize }}
                        </td>
                    </template>
                    <template #created_at="{item}">
                        <td>
                            {{ item.created_at | formatDate('d/M/Y HH:mm') }}
                        </td>
                    </template>
                    <template #actions="{item}">
                        <td>
                            <div class="btn-group btn-group-sm mr-3">
                                <router-link :to="{name:'Job',params:{id:item.id}}"
                                             class="btn btn-info">
                                    <i class="fa fa-eye"></i>
                                </router-link>
                                <button class="btn btn-warning">-</button>
                            </div>
                            <button class="btn btn-sm btn-danger">X</button>
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
    </div>
</template>

<script>
import endpoints from "@/modules/Job/endpoints"
import datatable from "@/mixins/datatable"
import {capitalize, formatDate} from "@/filters/common"

export default {
    name: "JobIndex",
    mixins: [datatable],
    filters: {capitalize, formatDate},
    data() {
        return {
            isLoading: true,
            search: null,
            fields: [
                {key: 'client_name'},
                {key: 'service_type'},
                {key: 'created_at'},
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
        permissions() {
            return this.$store.getters.permissions
        }
    },
    created() {
        this.fetchItems()
        this.columnFilters.status = 'active'
    },
    methods: {}
}
</script>

<style scoped>

</style>

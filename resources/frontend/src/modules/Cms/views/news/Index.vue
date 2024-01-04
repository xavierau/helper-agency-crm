<template>
    <div class="NewsIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">News</h5>
                <router-link :to="{name:'Create News'}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>
                </router-link>
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
                    <template #is_active="{item}">
                        <td>
                            <span class="badge" :class="{
                                'badge-success':item.is_active===true,
                                'badge-warning':item.is_active===false,
                            }">{{ item.is_active }}</span>
                        </td>
                    </template>

                    <template #actions="{item}">
                        <td>
                            <div class="btn-group btn-group-sm mr-3">
                                <router-link v-if="canEdit"
                                             :to="{name:'Edit News',params:{id:item.id}}"
                                             class="btn btn-info">
                                    <i class="fa fa-edit"></i>
                                </router-link>
                            </div>
                            <button class="btn btn-sm btn-danger"><i
                                class="fa fa-trash"></i></button>
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
import datatable from "@/mixins/datatable";
import {capitalize, formatCurrency} from "@/filters/common";
import endpoints from "@/modules/Cms/endpoints";

export default {
    name: "NewsIndex",
    mixins: [datatable],
    filters: {capitalize, formatCurrency},
    data() {
        return {
            showCreateInvoiceModal: false,
            isLoading: true,
            search: null,
            fields: [
                {key: 'title'},
                {key: 'summary'},
                {key: 'is_active'},
                {
                    key: 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            external_url: endpoints.list_news,
            newsPaginator: null,
            formData: {
                client_id: null,
                sellables: []
            },


        }
    },
    computed: {
        clients() {
            return this.newsPaginator ? this.newsPaginator.items : []
        },
        permissions() {
            return this.$store.getters.permissions
        },
        canEdit() {
            return this.$store.getters.can('agency-finance:invoice.edit')
        }
    },
    created() {
        this.fetchItems()
    },
    methods: {}
}
</script>

<style scoped>

</style>

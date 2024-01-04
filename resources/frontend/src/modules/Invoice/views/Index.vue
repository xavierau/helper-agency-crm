<template>
    <div class="InvoiceIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Invoices</h5>
               <router-link :to="{name:'Create Invoice'}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Invoice</router-link>
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
                    <template #editable-filter>
                        <select class="form-control"
                                style="height:28.36px; padding:0; font-size:0.76562rem"
                                v-model="columnFilters.editable"
                                @change="updateColumnFilter">
                            <option :value="true">Yes</option>
                            <option :value="false">No</option>
                        </select>
                    </template>
                    <template #client.name="{item}">
                        <td>
                            <router-link :to="{name:'Client', params:{id:item.client.id}}">
                                {{ item.client.full_name }}
                            </router-link>
                        </td>
                    </template>
                    <template #contract.contract_number="{item}">
                        <td>
                            <router-link
                                :to="{name:'Contract',params:{id:item.contract.id}}">
                                {{ item.contract.contract_number }}
                            </router-link>

                        </td>
                    </template>
                    <template #invoice_number="{item}">
                        <td>
                               <router-link
                                   :to="{name:'Invoice',params:{id:item.id}}">{{
                                       item.invoice_number
                                                                              }}</router-link>
                        </td>
                    </template>
                    <template #status="{item}">
                        <td>
                            <span class="badge" :class="{
                                'badge-info':item.status==='active',
                                'badge-success':item.status==='win',
                                'badge-warning':item.status==='lost',
                            }">{{ item.status }}</span>
                        </td>
                    </template>
                    <template #total="{item}">
                        <td>
                            {{ item.total | formatCurrency }}
                        </td>
                    </template>
                    <template #actions="{item}">
                        <td>
                            <div class="btn-group btn-group-sm mr-3">
                                <router-link v-if="canEdit"
                                             :to="{name:'Edit Invoice',params:{id:item.id}}"
                                             class="btn btn-info">
                                    <i class="fa fa-edit"></i>
                                </router-link>
                                <router-link :to="{name:'Payments',query:{invoice_id:item.id}}"
                                             class="btn btn-success">
                                    <i class="fas fa-cash-register"></i>
                                </router-link>
                                <router-link :to="{name:'Sellable',params:{id:item.id}}"
                                             class="btn btn-primary">
                                    <i class="far fa-file-pdf"></i>
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
import endpoints from "@/modules/Invoice/endpoints"
import datatable from "@/mixins/datatable"
import {capitalize, formatCurrency} from "@/filters/common"

export default {
    name    : "InvoiceIndex",
    mixins  : [datatable],
    filters : {capitalize, formatCurrency},
    data() {
        return {
            showCreateInvoiceModal: false,
            isLoading             : true,
            search                : null,
            fields                : [
                {key: 'invoice_number'},
                {key: 'client.name'},
                {key: 'contract.contract_number', label: 'Contract Number'},
                {key: 'total', label: 'Amount'},
                {key: 'due_date'},
                {
                    key   : 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            external_url          : endpoints.list,
            clientPaginator       : null,
            formData              : {
                client_id: null,
                sellables: []
            }
        }
    },
    computed: {
        clients() {
            return this.clientPaginator ? this.clentPaginator.items : []
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
    methods : {}
}
</script>

<style scoped>

</style>

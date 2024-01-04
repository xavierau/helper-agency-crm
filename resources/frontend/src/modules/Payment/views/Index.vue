<template>
    <div class="PaymentIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Payments</h5>
                <button @click.prevent="showCreatePaymentModal=true"
                        class="btn btn-sm btn-success"><i
                    class="fa fa-plus"></i> Payment
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
                    @update:sorter-value="updateSorter"
                >

                    <template #invoice.invoice_number="{item}">
                        <td>
                            <router-link :to="{name:'Invoice',params:{id:item.invoice.id}}">
                                {{ item.invoice.invoice_number }}
                            </router-link>

                        </td>
                    </template>
                    <template #invoice.client.name="{item}">
                        <td>
                            <router-link :to="{name:'Client',params:{id:item.invoice.client.id}}">
                                {{ item.invoice.client.full_name }}
                            </router-link>
                        </td>
                    </template>
                    <template #amount="{item}">
                        <td>
                            {{ item.amount | formatCurrency }}
                        </td>
                    </template>
                    <template #attachment="{item}">
                        <td>
                            <a v-if="item.attachment" :href="item.attachment" target="_blank">Show attachment</a>
                            <span class="badge badge-info" v-else>No Attachment</span>
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
                            </div>
                            <button class="btn btn-sm btn-danger"><i
                                class="fa fa-trash-alt"></i></button>
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
        <CModal title="New Payment"
                size="lg"
                :show.sync="showCreatePaymentModal">
            <create-new-payment-form :form-data.sync="formData"
                                     :form.sync="form"/>
            <template #footer>
                <div class="row">
                    <button @click="showCreatePaymentModal = false"
                            class=" mr-3 btn btn-secondary btn-sm float-left">Close
                    </button>
                    <button @click="submit"
                            class=" mr-3 btn btn-success btn-sm">Create
                    </button>
                </div>
            </template>
        </CModal>
    </div>
</template>

<script>
import endpoints from "@/modules/Payment/endpoints"
import client from "@/client"
import CreateNewPaymentForm from "@/modules/Payment/partials/CreateNewPaymentForm"
import datatable from "@/mixins/datatable"
import {capitalize, formatCurrency} from "@/filters/common"

export default {
    name: "PaymentIndex",
    mixins: [datatable],
    filters: {capitalize, formatCurrency},
    components: {CreateNewPaymentForm},
    data() {
        return {
            showCreatePaymentModal: false,
            isLoading: true,
            search: null,
            fields: [
                {key: 'invoice.invoice_number', label: 'Invoice Number'},
                {key: 'invoice.client.name', label: 'Client'},
                {key: 'amount'},
                {key: 'type'},
                {key: 'attachment'},
                {key: 'created_at'},
                {
                    key: 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            external_url: endpoints.list,
            formData: {
                amount: 0,
                type: null,
                invoice_id: null,
                note: null
            },
            form: new FormData
        }
    },
    computed: {
        permissions() {
            return this.$store.getters.permissions
        },
        canEdit() {
            return this.$store.getters.can('agency-finance:payment.edit')
        },
    },
    created() {
        this.fetchItems()
        this.openModalIfNeeded()
    },
    methods: {
        openModalIfNeeded() {
            if (this.$route.query.invoice_id) {
                this.formData.invoice_id = this.$route.query.invoice_id
                this.showCreatePaymentModal = true
            }
        },
        submit() {

            Object.keys(this.formData).forEach(key => this.form.append(key, this.formData[key]))

            client.post(endpoints.store, this.form)
                .then(() => this.$toasted.success('Payment added!'))
                .then(() => this.fetchItems())
                .then(() => this.showCreatePaymentModal = false)
                .then(() => this.formData = {
                    amount: 0,
                    type: null,
                    invoice_id: null,
                    note: null
                })
                .catch(error => this.$toasted.error('cannot create payment:' + error.message))
        }
    }
}
</script>

<style scoped>

</style>

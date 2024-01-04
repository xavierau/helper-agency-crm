<template>
    <form class="form">
        <NewInvoiceBasicInfo :form-data.sync="formData"
                             :can-edit="canEdit"
                             :disabled-fields="disabledFields"/>
        <fieldset>
            <h5>Invoice Items
                <button v-if="canEdit"
                        @click.prevent="addSellableItem"
                        class="btn btn-success btn-sm"><i
                    class="fa fa-plus"></i></button>
            </h5>
            <NewInvoiceItemsTable :form-data.sync="formData"
                                  :previous-invoice="previousInvoice"
                                  :can-edit="canEdit"
                                  :sellables="sellables"/>
        </fieldset>
    </form>
</template>

<script>
import {v4 as uuid} from 'uuid'
import client from "@/client"
import {formatCurrency} from "@/filters/common"
import sellableEndpoints from "@/modules/Sellable/endpoints"
import NewInvoiceItemsTable from "./NewInvoiceItemsTable"
import NewInvoiceBasicInfo from "./NewInvoiceBasicInfo"
import clientEndpoints from "@/modules/Client/endpoints"

require('vue-select/dist/vue-select.css')

export default {
    name: "CreateNewInvoiceForm",
    components: {
        NewInvoiceBasicInfo,
        NewInvoiceItemsTable,
    },
    props: {
        canEdit: {
            type: Boolean,
            default: true
        },
        disabledFields: {
            type: Array,
            default() {
                return []
            }
        },
        formData: {
            type: Object,
            required: true
        },
        previousInvoice: {
            type: Object
        }
    },
    data() {
        return {
            clientPaginator: null,
            applicantPaginator: null,
            sellables: []
        }
    },
    filters: {
        formatCurrency
    },
    computed: {
        clients() {
            return this.clientPaginator ? this.clientPaginator.data : []
        },
        applicants() {
            return this.applicantPaginator ? this.applicantPaginator.data : []
        },
        client() {
            return this.clients.find(c => c.id === this.formData.client_id)
        },
        contracts() {
            if (this.client) {
                return this.client.contracts.concat([{
                    id: 'new',
                    contract_number: 'Create New Contract',
                    status: 'new'
                }])
            } else {
                return [
                    {
                        id: 'new',
                        contract_number: 'Create New Contract',
                        status: 'new'
                    }
                ]
            }
        },
    },
    created() {
        if (this.formData.items.length === 0) {
            this.addSellableItem()
        }
        this.fetchSellables()
    },
    methods: {
        addSellableItem() {
            if (this.canEdit) {
                this.formData.items.push({
                    id: null,
                    uuid: uuid(),
                    sellable_id: null,
                    variant_id: null,
                    note: "",
                    qty: 0,
                    price: 0,
                    discount: 0
                })
            }

        },
        fetchSellables() {
            return client.get(sellableEndpoints.all)
                .then(({data}) => this.sellables = data)
                .catch(error => console.log('cannot load sellables'))
        },
        fetchClients(keyword = null) {
            return client.get(clientEndpoints.list, {params: {"filter[search]": keyword}})
                .then(({data}) => this.clientPaginator = data)
                .catch(error => console.log(error))
        },
    }
}
</script>

<style scoped></style>

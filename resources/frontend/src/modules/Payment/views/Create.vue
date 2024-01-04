<template>
    <div class="SellableIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Create New Invoice</h5>

            </CCardHeader>
            <CCardBody>
                <create-new-invoice-form :formData.sync="formData"></create-new-invoice-form>

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-secondary">back</button>
                        <button @click.prevent="submit"
                                class="btn btn-success ml-auto">Create</button>
                    </div>
                </div>
             </CCardBody>
        </CCard>
    </div>
</template>

<script>
import endpoints from "@/modules/Invoice/endpoints"
import client from "@/client"
import CreateNewInvoiceForm from "@/modules/Invoice/partials/CreateNewInvoiceForm"
import datatable from "@/mixins/datatable"
import {capitalize} from "@/filters/common"

export default {
    name      : "InvoiceCreate",
    mixins    : [datatable],
    filters   : {capitalize},
    components: {
        CreateNewInvoiceForm
    },
    data() {
        return {
            showCreateInvoiceModal: false,
            isLoading             : true,
            search                : null,
            fields                : [
                {key: 'invoice_number'},
                {key: 'client.name'},
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
                items    : [],
                contract : {
                    id             : null,
                    applicant      : null,
                    contract_number: null,
                }
            }
        }
    },
    computed  : {
        clients() {
            return this.clientPaginator ? this.clentPaginator.items : []
        },
        permissions() {
            return this.$store.getters.permissions
        },
    },
    created() {
        this.fetchItems()
    },
    methods   : {
        submit() {
            client.post(endpoints.store, this.formData)
                  .then(({data}) => this.$toasted.success('New Invoice Created'))
                  .then(() => this.$router.push({name: 'Invoices'}))
                  .catch(error => this.$toasted.error('Something wrong'))
        }
    }
}
</script>

<style scoped>

</style>

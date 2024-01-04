<template>
    <div class="SellableIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Create New Invoice</h5>
            </CCardHeader>
            <CCardBody>
                <CreateNewInvoiceForm :formData.sync="formData"/>
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-secondary">back</button>
                        <button @click.prevent="submit"
                                class="btn btn-success ml-auto">Create
                        </button>
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
    name: "InvoiceCreate",
    mixins: [datatable],
    filters: {capitalize},
    components: {
        CreateNewInvoiceForm
    },
    data() {
        return {
            showCreateInvoiceModal: false,
            isLoading: true,
            search: null,
            fields: [
                {key: 'invoice_number'},
                {key: 'client.name'},
                {
                    key: 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            external_url: endpoints.list,
            clientPaginator: null,
            formData: {
                client_id: null,
                client: null,
                items: [],
                contract: {
                    id: null,
                    applicant: null,
                    contract_number: null,
                    job_id: null,
                    internal_code: null,
                },
                requirement: {
                    expected_arrival_date: null
                }
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
    },
    methods: {
        submit() {
            client.post(endpoints.store, this.formData)
                .then(({data}) => this.$router.push({name: 'Contract', params: {id: data.contract_id}}))
                .then(() => this.$toasted.success('New Invoice Created'))
                .catch(error => this.$toasted.error('Something wrong, ' + error.message))
        }
    }
}
</script>

<style scoped>

</style>

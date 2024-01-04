<template>
    <div class="EditInvoice">
        <CCard v-if="invoice">
            <CCardHeader>
                <h4 class="d-block">
                    Invoice
                    <button @click.prevent="showSupersedeModal"
                            class="btn btn-warning btn-sm float-right">
                        <i class="far fa-clone"></i> Supersede
                    </button>
                </h4>

            </CCardHeader>
            <CCardBody>
                <CreateNewInvoiceForm :disabled-fields="['client_id','contract.id']"
                                      :previous-invoice="invoice.previousInvoice"
                                      :form-data="invoice"/>
                <div class="row p-3">
                    <router-link :to="{name:'Invoices'}"
                                 class="btn btn-secondary">
                        <i class="far fa-arrow-alt-circle-left"></i> Back
                    </router-link>
                    <button @click.prevent="update"
                            class="btn btn-success ml-auto">
                        <i class="fas fa-check"></i> Update
                    </button>
                </div>

            </CCardBody>
        </CCard>
        <CCard v-else>
            <CCardHeader>
                <h4>Loading...</h4>
            </CCardHeader>
        </CCard>

        <CModal :show.sync="showSupersede"
                color="warning"
                size="lg"
                :close-on-backdrop="false"
                title="Supersede Invoice">
            <CCard>
                <CCardBody>
                    <h5>New Contract</h5>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Applicant</label>
                                <my-v-select :options="applicants"
                                             v-model="new_applicant"
                                             label="name"
                                             :search-func="fetchApplicants">
                                </my-v-select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Contract Number</label>
                                <input class="form-control" v-model="new_contract_number"/>
                            </div>
                        </div>
                    </div>


                </CCardBody>
            </CCard>
            <template #footer>
                <button @click="showSupersede=false" class="btn btn-secondary btn-sm">Close</button>
                <button @click="supersedeInvoice" class="btn btn-warning btn-sm">Supersede with new contract</button>
            </template>
        </CModal>
    </div>


</template>

<script>
import endpoints from "@/modules/Invoice/endpoints"
import client from "@/client"
import CreateNewInvoiceForm from '@/modules/Invoice/partials/CreateNewInvoiceForm'
import MyVSelect from '@/components/MyVSelect'
import {v4 as uuid} from 'uuid'
import applicantEndpoints from "@/modules/Applicant/endpoints"

export default {
    name: "EditInvoice",
    components: {CreateNewInvoiceForm, MyVSelect},

    data() {
        return {
            showSupersede: false,
            invoice: null,
            new_applicant: null,
            new_contract_number: null,
            applicantPaginator: null
        }
    },
    computed: {
        applicants() {
            return this.applicantPaginator ? this.applicantPaginator.data : []
        },
        canEdit() {
            return this.$store.getters.can('agency-finance:invoice.edit')
        },
    },
    created() {
        this.fetchInvoice()
    },
    methods: {
        showSupersedeModal() {
            this.showSupersede = true
        },
        fetchInvoice() {
            client.get(endpoints.show(this.$route.params.id))
                .then(({data}) => {
                    data.items.forEach(i => i.uuid = uuid())
                    this.invoice = data
                })
                .catch(error => console.log(error))
        },
        update() {
            client.put(endpoints.update(this.$route.params.id), this.invoice)
                .then(() => this.$toasted.success('Invoice is update'))
                .then(() => this.$router.push({name: 'Invoices'}))
                .catch(error => this.$toasted.error('Something wrong.', error.message))
        },
        fetchApplicants(keyword = null) {
            return client.get(applicantEndpoints.list, {params: {"filter[search]": keyword}})
                .then(({data}) => this.applicantPaginator = data)
                .catch(error => console.log(error))
        },
        supersedeInvoice() {
            let data = Object.assign({}, this.invoice)
            data.items = null
            data.invoice_id = this.invoice.id
            data.contract.id = 'new'
            data.contract.contract_number = this.new_contract_number
            data.contract.applicant.id = this.new_applicant.id

            client.post(endpoints.supersede(this.invoice.id), data)
                .then(({data}) => this.$router.push({
                    name: 'Edit Invoice',
                    params: {id: data.id}
                }))
                .then(() => this.$toasted.success('new invoice created'))
                .catch(error => this.$toasted.error('something wrong!' + error.message))
        }

    }

}

</script>

<style scoped>

</style>

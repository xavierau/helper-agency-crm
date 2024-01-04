<template>
    <div class="EditInvoice">
        <CCard v-if="invoice">
            <CCardHeader>
                <h4 class="d-block">
                    Invoice
                    <button @click.prevent="showSupersedeModal"
                            class="btn btn-warning btn-sm float-right">Supersede Invoice</button>
                </h4>

            </CCardHeader>
            <CCardBody>
                <create-new-invoice-form :disabled-fields="['client_id','contract.id']"
                                         :previous-invoice="invoice.previous_invoice"
                                         :form-data="invoice"></create-new-invoice-form>
                <div class="row p-3">
                        <router-link :to="{name:'Invoices'}"
                                     class="btn btn-secondary">Back</router-link>
                        <button @click.prevent="update"
                                class="btn btn-success ml-auto">Update</button>
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
                title="Supersede Invoice">
            <CCard>
                <CCardBody>
                    <h5>New Contract</h5>
                    <my-v-select :options="applicants"
                                 v-model="new_applicant"
                                 label="name"
                                 :search-func="fetchApplicants">

                    </my-v-select>
                </CCardBody>
            </CCard>
            <template #footer>
                <button @click="showSupersede=false" class="btn btn-secondary btn-sm">Close</button>
                <button @click="supersedeInvoice" class="btn btn-secondary btn-sm">Close</button>
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
    name      : "EditInvoice",
    components: {CreateNewInvoiceForm, MyVSelect},

    data() {
        return {
            showSupersede     : false,
            invoice           : null,
            new_applicant     : null,
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
    methods : {
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
                  .then(({data}) => this.$toasted.success('Invoice is update'))
                  .then(() => this.$router.push({name: 'Invoices'}))
                  .catch(error => this.$toasted.erro('Something wrong.', error.message))
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
            data.contract.applicant.id = this.new_applicant.id

            client.post(endpoints.supersede(this.invoice.id), data)
                  .then(({data}) => this.$toasted.success('new invoice created'))
                  .then(() => this.$router.push({name: 'Invoices'}))
                  .catch(error => this.$toasted.success('something wrong!' + error.message))
        }

    }

}

</script>

<style scoped>

</style>

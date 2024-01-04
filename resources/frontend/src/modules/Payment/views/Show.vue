<template>
    <div class="ShowInvoice">
        <CCard v-if="invoice">
            <CCardHeader>
                <h4>
                    Invoice

                    <router-link v-if="canEdit"
                                 :to="{name:'Edit Invoice',params:{id:$route.params.id}}"
                                 class="btn btn-info btn-sm float-right">Edit</router-link>

                     <router-link :to="{name:'Invoice Trail',params:{id:$route.params.id}}"
                                  class="mr-3 btn btn-primary btn-sm float-right">Trail</router-link>
                </h4>
            </CCardHeader>
            <CCardBody>
                <create-new-invoice-form :can-edit="false"
                                         :previous-invoice="invoice.previous_invoice"
                                         :form-data="invoice"></create-new-invoice-form>
            </CCardBody>
        </CCard>
        <CCard v-else>
            <CCardHeader>
                <h4>Loading...</h4>
            </CCardHeader>
        </CCard>

    </div>

</template>

<script>
import endpoints from "@/modules/Invoice/endpoints"
import client from "@/client"
import CreateNewInvoiceForm from '@/modules/Invoice/partials/CreateNewInvoiceForm'

export default {
    name      : "ShowInvoice",
    components: {CreateNewInvoiceForm},

    data() {
        return {
            invoice: null,
        }
    },
    computed: {
        canEdit() {
            return this.$store.getters.can('agency-finance:invoice.edit')
        },
    },
    created() {
        this.fetchInvoice()
    },
    methods : {
        fetchInvoice() {
            client.get(endpoints.show(this.$route.params.id))
                  .then(({data}) => {
                      this.invoice = data
                  })
                  .catch(error => console.log(error))
        }

    }
}
</script>

<style scoped>

</style>

<template>
    <div class="ShowInvoice">
        <CCard v-if="invoice">
            <CCardHeader>
                <h4>
                    Invoice
                    <router-link :to="`/invoices/${invoice.id}/print`"
                                 class="btn btn-info btn-sm mr-3"><i class="fa fa-print"></i> Print Invoice
                    </router-link>
                    <router-link v-if="canEdit && invoice.status !== 'superseded'"
                                 :to="{name:'Edit Invoice',params:{id:$route.params.id}}"
                                 class="btn btn-info btn-sm"><i class="far fa-edit"></i> Edit
                    </router-link>


                    <router-link v-if="invoice.status !== 'superseded'"
                                 :to="{name:'Payments',query:{invoice_id:$route.params.id}}"
                                 class="btn btn-success btn-sm float-right ml-3">
                        <i class="fa fa-plus"></i> Payment
                    </router-link>

                    <router-link v-if="invoice.status !== 'superseded'"
                                 :to="{name:'Invoice Trail',params:{id:$route.params.id}}"
                                 class="mr-3 btn btn-primary btn-sm float-right"><i class="fas fa-history"></i> Trail
                    </router-link>
                </h4>
            </CCardHeader>
            <CCardBody>
                <ShowInvoiceForm :invoice="invoice"/>
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
import ShowInvoiceForm from '@/modules/Invoice/partials/ShowInvoiceForm'

export default {
    name: "ShowInvoice",
    components: {ShowInvoiceForm},

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
    methods: {
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

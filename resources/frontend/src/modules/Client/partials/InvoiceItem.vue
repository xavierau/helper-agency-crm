<template>
     <CCard class="InvoiceItem">
        <CCardHeader>
            Invoice: <router-link :to="{name:'Invoice',params:{id:invoice.id}}">
                {{ invoice.invoice_number }} <small>({{ invoice.status }})</small>
            </router-link>
        </CCardHeader>
        <CCardBody>
            <p>Amount: <strong>{{ invoice.total | formatCurrency }}</strong></p>
            <p>Due Date: <strong>{{ invoice.due_date }}</strong></p>
        </CCardBody>
    </CCard>
</template>

<script>
import {formatCurrency} from "@/filters/common"

export default {
    name    : "InvoiceItem",
    props   : {
        invoice: {
            type    : Object,
            required: true
        }
    },
    filters : {
        formatCurrency
    },
    computed: {}
}
</script>

<style scoped>

</style>

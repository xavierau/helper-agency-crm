<template>
    <CDataTable
        :items="payments"
        :fields="[
                                           {key: 'payment_id'},
                                           {key: 'amount'},
                                           {key: 'payment_type'},
                                           {key: 'invoice_number'},
                                           {key: 'date_time'},
                                           ]"
        hover
        column-filter
        table-filter
        items-per-page-select
        :items-per-page="15"
        sorter
        pagination>
        <template #payment_id="{item}">
            <td>
                <router-link :to="{name:'Payment', params:{id:item.id}}">
                    {{ `payment_${item.id}` }}
                </router-link>
            </td>
        </template>
        <template #amount="{item}">
            <td>
                {{ item.amount | formatCurrency }}
            </td>
        </template>
        <template #payment_type="{item}">
            <td>
                {{ item.type.replace('-', ' ') }}
            </td>
        </template>
        <template #invoice_number="{item}">
            <td>
                <router-link :to="{name:'Invoice', params:{id:item.invoice.id}}">
                    {{ item.invoice.invoice_number }}
                </router-link>

            </td>
        </template>
        <template #date_time="{item}">
            <td>
                {{ item.created_at |formatDatetime }}
            </td>
        </template>

    </CDataTable>
</template>

<script>
import endpoints from '@/modules/Payment/endpoints'
import client from "@/client";
import {formatCurrency, formatDatetime} from '@/filters/common'

export default {
    name: "ClientPaymentsTable",
    props: {
        clientId: {
            type: Number,
            required: true
        }
    },
    filters: {formatCurrency, formatDatetime},
    data() {
        return {
            paymentPaginator: null
        }
    },
    computed: {
        payments() {
            return this.paymentPaginator?.data || []
        }
    },
    created() {
        client.get(endpoints.list + `?client_id=${this.clientId}`)
            .then(({data}) => this.paymentPaginator = data)
            .catch(error => this.$toasted.error('Something wrong! Cannot fetch credit notes'))
    }
}
</script>

<style scoped>

</style>

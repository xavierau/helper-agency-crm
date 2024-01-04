<template>
    <div class="CreateNewPaymentForm">
        <div class="form-group">
            <label>Invoice</label>
            <my-v-select :options="invoices"
                         v-model="formData.invoice_id"
                         :reduce="i=>i.id"
                         :search-func="fetchInvoice"
                         label="label">
                <template #option="option">
                    {{
                        option.client.full_name
                    }} - {{ option.invoice_number }} <small>({{
                        option.net | formatCurrency
                    }})</small>
                </template>
            </my-v-select>
        </div>
        <div class="form-group">
            <label>Amount</label>
            <input class="form-control"
                   type="number"
                   min="0"
                   required
                   :disabled="formData.type ==='credit-note'"
                   v-model="formData.amount"/>
        </div>
        <div class="form-group">
            <label>Type</label>
            <select class="form-control" v-model="formData.type">
                <option value="cash">Cash</option>
                <option value="cheque">Cheque</option>
                <option value="credit-card">Credit Card</option>
                <option value="credit-note">Credit Note</option>
            </select>
        </div>

        <div class="form-group" v-if="formData.type==='credit-note'">
            <label>Credit Note</label>
            <my-v-select :options="credit_notes"
                         v-model="formData.credit_note_id"
                         :reduce="i=>i.id"
                         :search-func="fetchCreditNote"
                         @input="updateAmount"
                         label="label">
                <template #option="option">
                    {{ option.credit_note_number }} ( {{ option.from_contract.client_name }}
                    {{ option.amount | formatCurrency }})
                </template>
            </my-v-select>
        </div>


        <div class="form-group">
            <label>Note</label>
            <textarea class="form-control" v-model="formData.note"></textarea>
        </div>

        <div class="form-group">
            <label>Attachment</label>
            <CInputFile class="form-control" @change="updateFile"/>
        </div>
    </div>
</template>

<script>
import MyVSelect from "@/components/MyVSelect"
import {formatCurrency} from "@/filters/common"
import client from "@/client"
import endpoints from '@/modules/Invoice/endpoints'
import credit_note_endpoints from '@/modules/CreditNote/endpoints'

export default {
    name: "CreateNewPaymentForm",
    components: {
        MyVSelect
    },
    props: {
        formData: {
            type: Object,
            required: true
        },
        form: {
            required: true
        }
    },
    filters: {formatCurrency},
    data() {
        return {
            invoicePaginator: null,
            creditNotePaginator: null,
        }
    },
    computed: {
        credit_notes() {
            return this.creditNotePaginator ? this.creditNotePaginator.data.reduce((carry, i) => {

                i.label = `${i.credit_note_number} (${i.from_contract?.client_name}  ${this.$options.filters.formatCurrency(i.amount)})`
                console.log(i)
                carry.push(i)
                return carry
            }, []) : []
        },
        invoices() {
            return this.invoicePaginator ? this.invoicePaginator.data.reduce((carry, i) => {
                i.label = `${i.invoice_number} (${this.$options.filters.formatCurrency(i.total)})`
                carry.push(i)
                return carry
            }, []) : []
        }
    },
    created() {
        this.fetchInvoice()
        this.fetchCreditNote()
    },
    methods: {
        fetchInvoice(keyword = null) {
            return client.get(endpoints.list, {params: {'filter[search]': keyword}})
                .then(({data}) => this.invoicePaginator = data)
                .catch(error => this.$toasted.error('Cannot fetch invoices'))
        },
        fetchCreditNote(keyword = null) {
            return client.get(credit_note_endpoints.list, {params: {'filter[search]': keyword}})
                .then(({data}) => this.creditNotePaginator = data)
                .catch(error => this.$toasted.error('Cannot fetch credit note'))

        },
        updateFile(files) {
            this.form.append('attachment', files[0])
        },
        updateAmount(value) {
            this.formData.amount = this.credit_notes.find(i => i.id === value)?.amount || 0
        }
    }
}
</script>

<style scoped>

</style>

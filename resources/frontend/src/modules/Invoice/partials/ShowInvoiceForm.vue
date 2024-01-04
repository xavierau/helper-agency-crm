<template>
    <div class="ShowInvoice">
        <fieldset>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Client:</label>
                        <span>
                            <router-link
                                :to="{name:'Client', params:{id:invoice.client_id}}">
                                {{ invoice.client.prefix }} {{ invoice.client.full_name }}
                            </router-link>
                        </span>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Contract:</label>
                        <span>
                            <router-link
                                :to="{name:'Contract', params:{id:invoice.contract.id}}">
                                {{ invoice.contract.contract_number }}
                            </router-link>
                        </span>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <h5>Invoice Items </h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Variant</th>
                        <th>Qty</th>
                        <th>Note</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="s in invoice.items" :key="s.uuid">
                        <td>
                            <router-link
                                :to="{name:'Product', params:{id:s.sellable_id}}">
                                {{ s.sellable.name }}
                            </router-link>
                        </td>
                        <td>
                            {{ s.variant ? s.variant.name : '' }}
                        </td>
                        <td style="width:70px">
                            {{ s.qty }}
                        </td>
                        <td>
                            {{ s.note }}
                        </td>
                        <td style="width:120px">
                            {{ s.price | formatCurrency }}
                        </td>
                        <td style="width:120px">
                            {{ s.discount | formatCurrency }}
                        </td>
                        <td style="width:150px">
                            {{ s.price * s.qty - s.discount | formatCurrency }}
                        </td>
                    </tr>
                    <tr v-if="previousInvoice">
                        <td>
                            Supersede Invoice
                        </td>
                        <td>
                        </td>
                        <td style="width:70px">
                            1
                        </td>
                        <td>
                            This line is to supersede the previous invoice: {{
                                previousPaymentsSummary
                            }}
                        </td>
                        <td style="width:120px">
                            {{
                                -previousPaymentsTotal | formatCurrency
                            }}
                        </td>
                        <td style="width:120px">
                            0
                        </td>
                        <td style="width:150px">
                            {{
                                -previousPaymentsTotal | formatCurrency
                            }}
                        </td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label>Note:</label>
                    <p>{{ invoice.note }}</p>
                </div>
                <div class="col-sm-6">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Subtotal</td>
                            <td>{{ subtotal | formatCurrency }}</td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td>
                                {{ invoice.discount | formatCurrency }}
                            </td>
                        </tr>
                        <tr>
                            <td>Net Total</td>
                            <td>{{ nettotal | formatCurrency }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </fieldset>
    </div>
</template>

<script>
import {formatCurrency} from "@/filters/common"
import PreviousInvoice from "../mixins/PreviousInvoice";

export default {
    name: "ShowInvoice",
    props: {
        invoice: {
            type: Object,
            required: true
        }
    },
    filters: {
        formatCurrency
    },
    mixins: [PreviousInvoice],
    computed: {
        previousInvoice() {
            return this.invoice.previousInvoice
        },
        subtotal() {
            let subtotal = this.invoice.items.reduce((carry, s) => carry + this.calculateSubTotal(s), 0)
            if (this.previousInvoice) {
                subtotal = subtotal - this.previousPaymentsTotal
            }
            return subtotal
        },
        nettotal() {
            return this.invoice.discount ? this.subtotal - this.invoice.discount : this.subtotal
        }
    },
    methods: {
        calculateSubTotal(s) {
            return (s.qty * s.price) - s.discount
        },
    }
}
</script>

<style scoped>

</style>

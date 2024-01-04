<template>
    <div class="NewInvoiceItemsTable">
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
                <th v-if="canEdit">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="s in formData.items" :key="s.uuid">
                <td>
                <span v-if="!canEdit" class="form-control bg-secondary">
                    <router-link
                        :to="{name:'Product', params:{id:s.sellable_id}}">

                        {{ getSellableById(s.sellable_id).name }}
                    </router-link>
                </span>
                    <my-v-select v-else
                                 :options="sellables"
                                 v-model="s.sellable_id"
                                 :reduce="i=>i.id"
                                 @input="updatePrice(s)"
                                 label="name">
                    </my-v-select>
                </td>
                <td>
                    <select v-model="s.variant_id"
                            @change="updatePrice(s)"
                            :disabled="!canEdit || !hasVariants(s)"
                            class="form-control">
                        <option v-for=" variant in getVariants(s)"
                                :value="variant.id"
                                :key="variant.id">{{ variant.name }}
                        </option>
                    </select>
                </td>
                <td style="width:70px">
                    <input type="number" min="0" step="1" class="form-control"
                           :disabled="!canEdit || s.editable === false"
                           v-model="s.qty">
                </td>
                <td>
                                <textarea class="form-control"
                                          :disabled="!canEdit"
                                          v-model="s.note"></textarea>
                </td>
                <td style="width:120px">
                    <input class="form-control"
                           type="number"
                           v-model="s.price"
                           min="0"
                           step="1"
                           :disabled="!canSellableChangePrice(s) || !canEdit">
                </td>
                <td style="width:120px">
                    <input class="form-control"
                           type="number"
                           v-model="s.discount"
                           :disabled="!canEdit"
                           min="0"
                           step="1">
                </td>
                <td style="width:150px">
                    <input class="form-control"
                           :value="$options.filters.formatCurrency(calculateSubTotal(s))"
                           disabled>
                </td>
                <td v-if="canEdit">
                    <button type="button" @click="removeItem(s)"
                            class="btn btn-danger btn-sm"><i
                        class="fa fa-trash-alt"></i></button>
                </td>
            </tr>
            <tr v-if="previousInvoice">
                <td>
                    <div class="form-control bg-secondary">
                        Supersede Invoice
                    </div>
                </td>
                <td>
                </td>
                <td style="width:70px">
                    <span class="form-control">1</span>
                </td>
                <td>
                <textarea disabled class="form-control">
                     Previous Payment:
                    {{previousPaymentsSummary}}
                </textarea>
                </td>
                <td style="width:120px">
                    <span class="form-control"> {{ previousPaymentsTotal | formatCurrency }}</span>
                </td>
                <td style="width:120px">
                    <span class="form-control">0</span>
                </td>
                <td style="width:150px">
                    <span class="form-control"> {{ previousPaymentsTotal | formatCurrency }}</span>
                </td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-6">
                <label>Note</label>
                <textarea :disabled="!canEdit" class="form-control"
                          v-model="formData.note"></textarea>
            </div>
            <div class="col-6">
                <table class="table">
                    <tbody>
                    <tr>
                        <td>Subtotal</td>
                        <td>{{ subtotal | formatCurrency }}</td>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <td>
                            <input type="number"
                                   :disabled="!canEdit"
                                   min="0"
                                   step="1"
                                   v-model="formData.discount"
                                   class="form-control"/>
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
    </div>

</template>

<script>
import MyVSelect from '@/components/MyVSelect'
import _ from "lodash";
import {formatCurrency} from "@/filters/common"
import PreviousInvoice from "../mixins/PreviousInvoice";

export default {
    name: "NewInvoiceItemsTable",
    props: {
        formData: {
            type: Object,
            required: true
        },
        previousInvoice: {
            type: Object,
        },
        canEdit: {
            type: Boolean,
            default: true
        },
        sellables: {
            type: Array,
            default() {
                return []
            }
        },
    },
    mixins: [PreviousInvoice],
    components: {MyVSelect},
    filters: {formatCurrency},
    computed: {
        subtotal() {
            let subtotal = this.formData.items.reduce((carry, s) => carry + this.calculateSubTotal(s), 0)
            if (this.previousInvoice) {
                subtotal = subtotal - this.previousPaymentsTotal
            }
            return subtotal
        },
        nettotal() {
            return this.formData.discount ? this.subtotal - this.formData.discount : this.subtotal
        },
    },
    methods: {
        updatePrice(s) {
            const selectedSellable = this.getSellableById(s.sellable_id)

            if (selectedSellable) {
                if (selectedSellable.variants.length > 0) {
                    if (s.variant_id) {
                        const selectedVariant = _.find(selectedSellable.variants, {id: s.variant_id})
                        if (selectedVariant) {
                            s.price = selectedVariant.pivot.price
                            s.description = selectedVariant.pivot.description
                        }
                    }
                } else {
                    s.price = selectedSellable.price
                    s.description = selectedSellable.description
                    s.variant_id = null
                }
                s.qty = 1
            }
        },
        removeItem(s) {
            this.formData.items = _.filter(this.formData.items, i => i.uuid !== s.uuid)
        },
        getSellableById(id) {
            return _.find(this.sellables, {id: id})
        },
        hasVariants(s) {
            return this.getVariants(s).length > 0
        },
        getVariants(s) {
            const selectedSellable = _.find(this.sellables, {id: s.sellable_id})
            return selectedSellable ? selectedSellable.variants : []
        },
        canSellableChangePrice(s) {
            const selectedSellable = this.getSellableById(s.sellable_id)

            return selectedSellable ? selectedSellable.editable : false
        },
        calculateSubTotal(s) {
            return (s.qty * s.price) - s.discount
        },
    }
}
</script>

<style scoped>

</style>

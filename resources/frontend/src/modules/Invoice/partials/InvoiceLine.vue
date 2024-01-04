<template>
    <tr>
            <td>
                <v-select :options="sellables"
                          v-model="s.id"
                          :reduce="i=>i.id"
                          @input="updatePrice(s)"
                          label="name">
                </v-select>
            </td>
            <td>
                <select v-model="s.variant_id"
                        @change="updatePrice(s)"
                        class="form-control">
                    <option v-for=" variant in getVariants(s)"
                            :value="variant.id"
                            :key="variant.id">{{ variant.name }}</option>
                </select>
            </td>
            <td style="max-width:5%">
                <input type="number" min="0" step="1" class="form-control"
                       v-model="s.qty">
            </td>
            <td>
                <textarea class="form-control"
                          v-model="s.description"></textarea>
            </td>

            <td>
                <input class="form-control"
                       type="number"
                       v-model="s.price"
                       min="0"
                       step="1"
                       :disabled="!canSellableChangePrice(s)">
            </td>
            <td>
                <input class="form-control"
                       type="number"
                       v-model="s.discount"
                       min="0"
                       step="1">
            </td>
            <td>
                <input class="form-control"
                       type="number"
                       :value="calculateSubTotal(s)"
                       disabled>
            </td>
            <td>
                <button type="button" @click="removeItem(s)"
                        class="btn btn-danger btn-sm"><i
                    class="fa fa-trash-alt"></i></button>
            </td>
        </tr>
</template>

<script>
import {v4 as uuid} from 'uuid'
import vSelect from 'vue-select'
import _ from 'lodash'
import client from "@/client"
import clientEndpoints from "@/modules/Client/endpoints"
import sellableEndpoints from "@/modules/Sellable/endpoints"

require('vue-select/dist/vue-select.css')

export default {
    name      : "InvoiceLine",
    components: {
        vSelect
    },
    props     : {
        s: {
            type    : Object,
            required: true
        }
    },
    data() {
        return {
            clientPaginator: null,
            sellables      : []
        }
    },
    computed  : {
        clients() {
            return this.clientPaginator ? this.clientPaginator.data : []
        },
        subtotal() {
            return this.formData.sellables.reduce((carry, s) => carry + this.calculateSubTotal(s), 0)
        },
        nettotal() {
            return this.formData.discount ? this.subtotal - this.formData.discount : this.subtotal
        }
    },
    created() {
        this.addSellableItem()
        this.fetchClients()
        client.get(sellableEndpoints.all)
              .then(({data}) => this.sellables = data)
              .catch(error => console.log('cannot load sellables'))
    },
    methods   : {
        removeItem(s) {
            this.formData.sellables = _.filter(this.formData.sellables, i => i.id !== s.id)
        },
        addSellableItem() {
            this.formData.sellables.push({
                                             uuid       : uuid(),
                                             id         : null,
                                             variant_id : null,
                                             description: "",
                                             qty        : 0,
                                             price      : 0,
                                             discount   : 0
                                         })
        },
        updatePrice(s) {
            const selectedSellable = _.find(this.sellables, {id: s.id})

            if (selectedSellable) {
                if (selectedSellable.variants.length > 1 || s.variant_id) {
                    const selectedVariant = _.find(selectedSellable.variants, {id: s.variant_id})
                    if (selectedVariant) {
                        s.price = selectedVariant.pivot.price
                        s.description = selectedVariant.pivot.description
                    }
                } else {
                    s.price = selectedSellable.price
                    s.description = selectedSellable.description
                }
            }
        },
        calculateSubTotal(s) {
            return (s.qty * s.price) - s.discount
        },
        canSellableChangePrice(s) {
            const selectedSellable = _.find(this.sellables, {id: s.id})

            return selectedSellable ? selectedSellable.editable : false
        },
        getVariants(s) {
            const selectedSellable = _.find(this.sellables, {id: s.id})

            return selectedSellable ? selectedSellable.variants : []
        },
        fetchOptions(keyword, loading) {
            loading(true)
            this.throttledMethod(this, keyword, loading);
        },
        fetchClients(keyword = null) {
            return client.get(clientEndpoints.list, {search: keyword})
                         .then(({data}) => this.clientPaginator = data)
                         .catch(error => console.log(error))
        },
        throttledMethod: _.debounce((vm, keyword, loading) => {
            vm.fetchClients(keyword)
              .then(() => loading(false))
        }, 200)
    }
}
</script>

<style scoped></style>

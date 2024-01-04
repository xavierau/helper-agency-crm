<template>
    <div class="showSellable">
        <CCard v-if="sellable">
            <CCardHeader>
                <h4>Product
                    <router-link :to="{name:'Product Template',params:{product_id:sellable.id}}"
                                 class="btn btn-primary btn-sm">Template
                    </router-link>
                </h4>

            </CCardHeader>
            <CCardBody>
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" v-model="sellable.name" :disabled="!canEdit"/>
                </div>
                <div v-if="sellable.variants.length === 0">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" step="0.1" min="0" class="form-control"
                               :disabled="!canEdit"
                               v-model="sellable.price"/>
                    </div>
                    <div v-if="sellable.track_inventory" class="form-group">
                        <label>Inventory</label>
                        <input class="form-control" v-model="sellable.inventory"
                               :disabled="!canEdit"/>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" v-model="sellable.description"
                              :disabled="!canEdit"></textarea>
                </div>

                <div class="row">
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="form-group">
                            <label>Is Active
                                <CSwitch :disabled="!canEdit" color="success"
                                         :checked="sellable.is_active"
                                         @update:checked="sellable.is_active = !sellable.is_active"
                                         class="ml-3 pt-2"/>
                            </label>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="form-group">
                            <label>Track Inventory
                                <CSwitch :disabled="!canEdit" color="success"
                                         :checked="sellable.track_inventory"
                                         @update:checked="sellable.track_inventory = !sellable.track_inventory"
                                         class="ml-3 pt-2"/>
                            </label>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="form-group">
                            <label>Editable
                                <CSwitch :disabled="!canEdit" color="success"
                                         :checked="sellable.editable"
                                         @update:checked="sellable.editable = !sellable.editable"
                                         class="ml-3 pt-2"/>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group d-flex justify-content-between">
                    <router-link :to="{name:'Products'}"
                                 class="btn btn-secondary">Back
                    </router-link>
                    <button v-if="canEdit"
                            @click="updateSellable"
                            class="btn btn-success ml-auto">Update Product
                    </button>
                </div>


                <section>
                    <h4>Variants
                        <button v-if="canEdit" @click="showAddVariantModal = true"
                                class="btn btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                        </button>
                    </h4>
                    <div v-if="sellable.variants.length > 0" class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Variant name</th>
                                <th>Price</th>
                                <th v-if="sellable.track_inventory">Inventory</th>
                                <th>Description</th>
                                <th>Is Active</th>
                                <th v-if="canEdit">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="variant in $options.filters.sortBy(sellable.variants,'name')"
                                :key="variant.id">
                                <td>{{ variant.name }}</td>
                                <td>
                                    <input class="form-control" v-model="variant.pivot.price"
                                           :disabled="!canEdit"/>
                                </td>
                                <td v-if="sellable.track_inventory">
                                    <input class="form-control"
                                           v-model="variant.pivot.inventory"
                                           :disabled="!canEdit"/>
                                </td>
                                <td>
                                        <textarea class="form-control"
                                                  :disabled="!canEdit"
                                                  v-model="variant.pivot.description"></textarea>
                                </td>
                                <td>
                                    <CSwitch color="success"
                                             :disabled="!canEdit"
                                             :checked="variant.pivot.is_active"
                                             @update:checked="variant.pivot.is_active = !variant.pivot.is_active"/>
                                </td>
                                <td v-if="canEdit">
                                    <CButtonGroup size="sm">
                                        <button @click="updateVariant(variant)"
                                                class="btn btn-sm btn-success">Update
                                        </button>
                                        <CDropdown
                                            color="secondary"
                                            toggler-text="More"
                                        >
                                            <CDropdownItem
                                                :to="{name:'Product Variant Template',params:{product_id:sellable.id, variant_id:variant.id}}">
                                                <i
                                                    class="fa fa-print mr-1"></i>Template
                                            </CDropdownItem>
                                            <CDropdownDivider></CDropdownDivider>
                                            <CDropdownItem @click="removeVariant(variant)">
                                                <i class="fa fa-trash-alt mr-1"></i>Delete
                                            </CDropdownItem>
                                            <CDropdownItem disabled>Disabled action</CDropdownItem>
                                        </CDropdown>
                                    </CButtonGroup>


                                </td>
                            </tr>

                            </tbody>
                        </table>
                        ShowSellable

                    </div>

                    <p v-else><em>No variant</em></p>
                </section>


            </CCardBody>
        </CCard>
        <CCard v-else>
            <CCardHeader>
                <h4>Loading...</h4>
            </CCardHeader>
        </CCard>

        <CModal v-if="canEdit" title="Add variant"
                :show="showAddVariantModal"
                @update:show="showAddVariantModal=false">
            <div class="form-group">
                <label>Available Variants</label>
                <select class="form-control" multiple v-model="selected_variants">
                    <option v-for="variant in variants" :key="variant.id" :value="variant.id">
                        {{ variant.name }}
                    </option>
                </select>
            </div>
            <template #footer>
                <button class="btn btn-secondary btn-sm" @click="showAddVariantModal = false">Close</button>
                <button class="btn btn-success btn-sm ml-auto" @click="addVariant">Add</button>
            </template>

        </CModal>

    </div>

</template>

<script>
import endpoints from "@/modules/Sellable/endpoints"
import client from "@/client"
import {sortBy} from "@/filters/common"
import _ from "lodash"

export default {
    name: "ShowSellable",
    data() {
        return {
            showAddVariantModal: false,
            sellable: null,
            allVariants: [],
            selected_variants: []
        }
    },
    filters: {
        sortBy
    },
    computed: {
        canEdit() {
            return this.$store.getters.can('agency-core:sellable.edit')
        },
        variants() {
            if (this.sellable) {
                const ids = _.reduce(this.sellable.variants, (carry, v) => {
                    carry.push(v.id)
                    return carry
                }, [])
                return _.chain(this.allVariants)
                    .filter(v => ids.indexOf(v.id) === -1)
                    .sortBy(['name'])
                    .value()
            }
            return this.allVariants

        }
    },
    created() {
        client.get(endpoints.show(this.$route.params.id))
            .then(({data}) => this.sellable = data)
            .catch(error => console.log(error))

        client.get(endpoints.variants)
            .then(({data}) => this.allVariants = data)
            .catch(error => console.log(error))
    },
    methods: {
        updateSellable() {
            if (this.canEdit === false) {
                return
            }
            client.put(endpoints.update(this.sellable.id), this.sellable)
                .then(({data}) => this.sellable = data)
                .then(() => this.$toasted.success("Product is updated!"))
                .catch(error => this.$toasted.error("Something wrong! Try again later!"))
        },
        addVariant() {
            client.post(endpoints.add_product_variants(this.sellable.id), {variants: this.selected_variants})
                .then(({data}) => this.sellable = data)
                .then(() => this.showAddVariantModal = false)
                .then(() => this.selected_variants = [])
                .catch(error => console.log(error))
        },
        removeVariant(variant) {
            if (confirm("Are you sure to delete the variant?")) {

                client.delete(endpoints.remove_variants(this.sellable.id, variant.id))
                    .then(({data}) => this.sellable = data)
                    .then(() => this.showAddVariantModal = false)
                    .catch(error => console.log(error))
            }
        },
        updateVariant(variant) {
            client.put(endpoints.update_variants(this.sellable.id, variant.id), variant)
                .then(() => this.$toasted.success(`Variant: ${variant.name} is updated`))
                .catch(error => console.log(error))
        }
    }
}
</script>

<style scoped>

</style>

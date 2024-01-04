<template>
    <div class="SellableIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Variants</h5>
                <button @click="showAddVariantModal = true" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Variant
                </button>
            </CCardHeader>
             <CCardBody>
                <CDataTable
                    :items="items"
                    :fields="fields"
                    :loading="isLoading"
                    hover
                    :items-per-page="pageSize"
                    :items-per-page-select="{external:true}"
                    :column-filter="{ external: true, lazy: true }"
                    :table-filter="{ external: true, lazy: true }"
                    :sorter="{ external: true, resetable: true }"
                    @pagination-change="updatePerPageItems"
                    @update:table-filter-value="updateTableFilter"
                    @update:column-filter-value="updateColumnFilter"
                    @update:sorter-value="updateSorter"
                >
                    <template #editable-filter="{item}">
                        <select class="form-control"
                                style="height:28.36px; padding:0; font-size:0.76562rem"
                                v-model="columnFilters.editable"
                                @change="updateColumnFilter">
                            <option :value="true">Yes</option>
                            <option :value="false">No</option>
                        </select>
                    </template>
                    <template #is_active-filter="{item}">
                        <select class="form-control"
                                style="height:28.36px; padding:0; font-size:0.76562rem"
                                v-model="columnFilters.is_active"
                                @change="updateColumnFilter">
                            <option :value="true">Active</option>
                            <option :value="false">Inactive</option>
                        </select>
                    </template>
                    <template #has_variants-filter="{item}">
                        <select class="form-control"
                                style="height:28.36px; padding:0; font-size:0.76562rem"
                                v-model="columnFilters.has_variants"
                                @change="updateColumnFilter">
                            <option :value="true">Has</option>
                            <option :value="false">No</option>
                        </select>
                    </template>
                    <template #name="{item}">
                        <td>
                            <router-link :to="{name:'Product', params:{id:item.id}}">
                                {{ item.name | capitalize }}
                            </router-link>
                        </td>
                    </template>
                    <template #is_active="{item}">
                        <td>
                               <span class="badge"
                                     :class="{
                                   'badge-success':item.is_active,
                                   'badge-warning':!item.is_active
                               }">{{
                                       item.is_active ? 'Yes' : 'No'
                                  }}</span>
                        </td>
                    </template>
                    <template #editable="{item}">
                        <td>
                               <span class="badge"
                                     :class="{
                                   'badge-success':item.editable,
                                   'badge-warning':!item.editable
                               }">{{
                                       item.editable ? 'Yes' : 'No'
                                  }}</span>
                        </td>
                    </template>
                    <template #has_variants="{item}">
                        <td>
                               <span class="badge"
                                     :class="{
                                   'badge-success':item.has_variants,
                                   'badge-warning':!item.has_variants
                               }">{{
                                       item.has_variants ? 'Yes' : 'No'
                                  }}</span>
                        </td>
                    </template>
                    <template #status="{item}">
                        <td>
                            <span class="badge" :class="{
                                'badge-info':item.status==='active',
                                'badge-success':item.status==='win',
                                'badge-warning':item.status==='lost',
                            }">{{ item.status }}</span>
                        </td>
                    </template>
                    <template #actions="{item}">
                        <td>
                            <div class="btn-group btn-group-sm mr-3">
                                <router-link :to="{name:'Sellable',params:{id:item.id}}"
                                             class="btn btn-info">
                                    <i class="fa fa-edit"></i>
                                </router-link>
                            </div>
                            <button class="btn btn-sm btn-danger">X</button>
                        </td>
                    </template>
                </CDataTable>
                 <CPagination
                     :activePage="paginationObject.activePage"
                     :pages="paginationObject.pages"
                     @update:activePage="updateActivePage" />
             </CCardBody>
        </CCard>

        <CModal title="Add New Product Variant"
                color="success"
                :show.sync="showAddVariantModal">
            <div class="form-group">
                <label>Variant Name</label>
                <input class="form-control" v-model="formData.name" />
            </div>

            <template #footer>
                <button @click="showAddVariantModal = false"
                        class="btn btn-secondary">Close</button>
                <button @click="addVariant"
                        class="btn btn-success">Create</button>
            </template>

        </CModal>
    </div>
</template>

<script>
import endpoints from "@/modules/Sellable/endpoints"
import datatable from "@/mixins/datatable"
import {capitalize} from "@/filters/common"
import client from "@/client"

export default {
    name    : "SellableIndex",
    mixins  : [datatable],
    filters : {capitalize},
    data() {
        return {
            showAddVariantModal: false,
            isLoading          : true,
            search             : null,
            fields             : [
                {key: 'name'},
                {key: 'has_variants'},
                {key: 'editable'},
                {key: 'is_active'},
                {
                    key   : 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            external_url       : endpoints.variant_index,
            formData           : {data: null},
        }
    },
    computed: {
        permissions() {
            return this.$store.getters.permissions
        },
    },
    created() {
        this.fetchItems()
    },
    methods : {
        addVariant() {
            client.post(endpoints.add_variant, this.formData)
                  .then(() => this.fetchItems())
                  .then(() => this.formData = {name: null})
                  .then(() => this.showAddVariantModal = false)
                  .then(() => this.$toasted.success('New product variant added!'))
                  .catch(error => this.$toasted.error("Something wrong! Try again later!"))
        }
    }
}
</script>

<style scoped>

</style>

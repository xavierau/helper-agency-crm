<template>
    <div class="SupplierIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Suppliers</h5>
                <button @click="createSupplier"
                        class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Supplier
                </button>
            </CCardHeader>
            <CCardBody v-if="items">
                <CDataTable
                    :items="items"
                    :fields="fields"
                    :loading="isLoading"
                    hover
                    :items-per-page="pageSize"
                    :column-filter="{ external: true, lazy: true }"
                    :table-filter="{ external: true, lazy: true }"
                    :sorter="{ external: true, resetable: true }"
                    @pagination-change="updatePerPageItems"
                    @update:table-filter-value="updateTableFilter"
                    @update:column-filter-value="updateColumnFilter"
                    @update:sorter-value="updateSorter">
                    <template #actions="{item}">
                        <td>
                            <router-link :to="{name:'Supplier',params:{id:item.id}}"
                                         class="btn btn-sm btn-icon btn-primary">
                                <i class="fa fa-eye"></i>
                            </router-link>
                            <button @click="editSupplier(item)"
                                    class="ml-1 btn btn-sm btn-icon btn-info">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </template>
                </CDataTable>
            </CCardBody>
            <CCardBody v-else>
                <h4>Loading...</h4>
            </CCardBody>
        </CCard>
        <CModal :show.sync="showSupplierFormModal"
                :title="modalHeader"
                color="success"
                static
                size="xl">
            <supplier-form :form-data.sync="formData"/>
            <template #footer>
                <button @click="submit" class="btn btn-success"> {{ formButtonText }}</button>
            </template>
        </CModal>
        <!--        <CModal :show.sync="showAttachWorkflowModal"-->
        <!--                :title="`Attach ${selectedWorkflow? selectedWorkflow.label:null} to entity`"-->
        <!--                color="success"-->
        <!--                static-->
        <!--                size="xl">-->
        <!--            <form class="form">-->
        <!--                <div class="form-group">-->
        <!--                    <label for="entity_id">Entity</label>-->
        <!--                    <select name="entity_id" id="entity_id" class="form-control" v-model="entity">-->
        <!--                        <option v-for="entity in entities"-->
        <!--                                :key="entity"-->
        <!--                                :value="entity">-->
        <!--                            {{ entity.split('\\').pop() }}-->
        <!--                        </option>-->
        <!--                    </select>-->
        <!--                </div>-->

        <!--            </form>-->

        <!--            <template #footer>-->
        <!--                <button @click="closeAttachModal" class="btn btn-secondary">Close</button>-->
        <!--                <button @click="attachWorkflow" class="btn btn-success">Assign</button>-->
        <!--            </template>-->
        <!--        </CModal>-->
    </div>
</template>

<script>
import endpoints from "../endpoints"
import SupplierForm from "../views/partials/SupplierForm.vue"
import client from '@/client'
import datatable from "@/mixins/datatable";


export default {
    name: "SupplierIndex",
    components: {
        SupplierForm
    },
    mixins: [datatable],
    data() {
        return {
            showSupplierFormModal: false,
            showAttachWorkflowModal: false,
            isLoading: true,
            external_url: endpoints.list,
            isEdit: false,
            entity: null,
            entities: [],
            fields: [
                {key: 'name'},
                {key: 'code'},
                {
                    key: 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            formData: {
                id: null,
                name: null,
                code: null,
            },
        }
    },
    computed: {
        formButtonText() {
            return this.isEdit ? "Update" : "Create"
        },
        modalHeader() {
            return this.isEdit ? "Update Supplier" : "Create Supplier"
        },
        successMessage() {
            return this.isEdit ? "Supplier updated" : "Supplier created"
        },
    },
    methods: {
        editSupplier(applicant) {
            this.formData.id = applicant.id
            this.formData.name = applicant.name
            this.formData.code = applicant.code

            this.isEdit = true
            this.showSupplierFormModal = true
        },
        createSupplier() {
            this.resetFormData()
            this.isEdit = false
            this.showSupplierFormModal = true
        },
        submit() {
            this.isLoading = true
            const url = this.isEdit ? endpoints.edit(this.formData.id) : endpoints.store,
                method = this.isEdit ? 'put' : 'post'
            client[method](url, this.formData)
                .then(() => this.fetchItems())
                .then(() => this.$toasted.success(this.successMessage))
                .then(() => this.resetFormData())
                .then(() => this.showSupplierFormModal = false)
                .catch(error => this.$toasted.error('Something wrong. ' + error.message))
                .finally(() => this.isLoading = false)
        },
        resetFormData() {
            this.formData = {
                id: null,
                label: null,
                code: null,
            }
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <div class="WorkflowIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Contract Dates</h5>
                <button @click="showCreateModal = !showCreateModal"
                        class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Date
                </button>
            </CCardHeader>
            <CCardBody v-if="items">
                <CCardBody v-if="paginator">
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
                        @update:sorter-value="updateSorter">
                        <template #actions="{item}">
                            <td>
                                <button class="btn btn-sm btn-danger"><i
                                    class="fas fa-trash-alt"></i></button>
                            </td>
                        </template>
                    </CDataTable>
                    <CPagination
                        :activePage="paginationObject.activePage"
                        :pages="paginationObject.pages"
                        @update:activePage="updateActivePage"
                    />
                </CCardBody>
            </CCardBody>
            <CCardBody v-else>
                <h4>Loading...</h4>
            </CCardBody>
        </CCard>
        <CModal :show.sync="showCreateModal"
                title="Create New Contract Date"
                color="success"
                static
                size="xl">
            <contract-date-form :form-data.sync="formData"/>
            <template #footer>
                <button @click="submit" class="btn btn-success">Create</button>
            </template>
        </CModal>
        <CModal :show.sync="showEditModal"
                title="Edit Contract Date"
                color="success"
                static
                size="xl">
            <contract-date-form v-if="selectedContractDate" :form-data.sync="selectedContractDate"/>
            <template #footer>
                <button @click="update" class="btn btn-success">Update</button>
            </template>
        </CModal>
    </div>
</template>

<script>
import endpoints from "../endpoints"
import ContractDateForm from "../views/partials/ContractDateForm"
import client from '@/client'
import datatable from '@/mixins/datatable'


export default {
    name: "ContractDateIndex",
    components: {
        ContractDateForm
    },
    mixins: [datatable],
    data() {
        return {
            showCreateModal: false,
            showEditModal: false,
            isLoading: true,
            selectedContractDate: null,
            fields: [
                {key: 'label'},
                {
                    key: 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            formData: {
                label: null,
            },
            external_url: endpoints.list
        }
    },
    methods: {
        editContractDate(item) {
            this.selectedContractDate = item
            this.showEditModal = true
        },
        deleteContractDate(item) {
            if (confirm('Are your sure to delete the contract date')) {
                client.delete(endpoints.destroy(item.id))
                    .then(() => this.items = this.items.filter(d => d.id !== item.id))
                    .then(() => this.$toasted.success("Contract date deleted!"))
                    .catch(error => this.$toasted.error(error.message))
            }

        },
        update() {
            client.put(endpoints.update(this.selectedContractDate.id), this.selectedContractDate)
                .then(({data}) => this.items = this.items.map(d => d.id === data.id ? data : d))
                .then(() => this.selectedContractDate = {label: null})
                .then(() => this.showEditModal = false)
                .then(() => this.$toasted.success("Contract date updated!"))
                .catch(error => this.$toasted.error(error.message))
        },
        submit() {
            client.post(endpoints.list, this.formData)
                .then(({data}) => this.items.push(data))
                .then(() => this.formData = {label: null})
                .then(() => this.showCreateModal = false)
                .then(() => this.$toasted.success("Contract date created!"))
                .catch(error => this.$toasted.error(error.message))
        },
    }
}
</script>

<style scoped>

</style>

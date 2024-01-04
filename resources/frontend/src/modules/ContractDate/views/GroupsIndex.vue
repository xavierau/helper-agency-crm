<template>
    <div class="GroupsIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Contract Date Groups</h5>
                <button @click="showCreateModal = !showCreateModal"
                        class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Group
                </button>
            </CCardHeader>
            <CCardBody v-if="items">
                <CDataTable
                    :items="items"
                    :fields="fields"
                    :loading="isLoading"
                    hover
                    :items-per-page="15"
                    column-filter
                    table-filter
                    sorter>
                    <template #actions="{item}">
                        <td>
                            <button @click="editContractDate(item)" class="btn btn-sm btn-icon btn-info">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button @click="deleteContractDate(item)"
                                    class="ml-1 btn btn-sm btn-icon btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </template>
                </CDataTable>
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


export default {
    name: "ContractDateGroupIndex",
    components: {
        ContractDateForm
    },
    data() {
        return {
            showCreateModal: false,
            showEditModal: false,
            isLoading: true,
            selectedContractDate: null,
            items: null,
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
        }
    },
    created() {
        client.get(endpoints.group_list)
            .then(({data}) => this.items = data)
            .then(() => this.isLoading = false)
            .catch(error => this.$toasted.error(error.message))
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

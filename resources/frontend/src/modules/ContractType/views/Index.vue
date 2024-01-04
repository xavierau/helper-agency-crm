<template>
    <div class="ContractTypeIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">All Contract Types</h5>
                <button @click="showCreateModal = !showCreateModal"
                        class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Type
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
                            <button @click="showAttachModal(item)"
                                    class="ml-1 btn btn-sm btn-icon btn-info">
                                <i class="fas fa-cubes"></i>
                            </button>
                            <button @click="showAttachDocumentModal(item)"
                                    class="ml-1 btn btn-sm btn-icon btn-info">
                                <i class="far fa-folder-open"></i>
                            </button>
                            <button @click="showAssignTemplate(item)"
                                    class="ml-1 btn btn-sm btn-icon btn-info">
                                <i class="fa fa-print"></i>
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

            <contract-type-form :form-data.sync="formData"/>
            <template #footer>
                <button @click="submit" class="btn btn-success">Create</button>
            </template>
        </CModal>
        <CModal :show.sync="showAssignModal"
                title="Contract Type Has Dates"
                color="success"
                static
                size="xl">
            <contract-date-table :dates="dates"
                                 :reload-dates="fetchContractType"
                                 :contract_type="selected_contract_type"
                                 @reorder="reorder"/>


            <template #footer>
                <span></span>
            </template>
        </CModal>
        <CModal :show.sync="showAssignDocumentModal"
                title="Contract Type Has Documents"
                color="success"
                static
                size="xl">
            <contract-document-table :documents="documents"
                                     :reload-documents="fetchContractType"
                                     :contract_type="selected_contract_type"
                                     @reorder="reorderDoc"/>
            <template #footer>
                <span></span>
            </template>
        </CModal>
        <CModal :show.sync="showTemplateModal"
                title="Contract Type Has Print Template"
                color="success"
                static
                size="xl">
            <ContractTemplateTable :templates="templates"
                                   :contract_type="selected_contract_type"
                                   :reload="fetchContractType"/>
            <template #footer><span></span></template>
        </CModal>
    </div>
</template>

<script>
import client from "@/client"
import ContractTypeForm from "./partials/ContractTypeForm"
import endpoints from '../endpoints'
import ContractDateTable from "@/modules/ContractType/views/partials/ContractDateTable";
import ContractTemplateTable from "@/modules/ContractType/views/partials/ContractTemplateTable";
import ContractDocumentTable from "@/modules/ContractType/views/partials/ContractDocumentTable";

export default {
    name: "ContractTypeIndex",
    components: {
        ContractTypeForm,
        ContractDateTable,
        ContractDocumentTable,
        ContractTemplateTable,
    },
    data() {
        return {
            showCreateModal: false,
            showAssignModal: false,
            showAssignDocumentModal: false,
            showTemplateModal: false,
            selected_contract_type: null,
            isLoading: true,
            fields: [
                {key: 'label'},
                {
                    key: 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            items: [],
            formData: {label: null},
        }
    },
    computed: {
        dates() {
            return this.selected_contract_type?.contract_dates || []
        },
        documents() {
            return this.selected_contract_type?.contract_documents || []
        },
        templates() {
            return this.selected_contract_type?.templates || []
        },
    },
    created() {
        this.fetchContractTypes()
    },
    methods: {
        showAttachModal(contract_type) {
            this.selected_contract_type = contract_type;
            this.showAssignModal = true;
        },
        showAttachDocumentModal(contract_type) {
            this.selected_contract_type = contract_type;
            this.showAssignDocumentModal = true;
        },
        showAssignTemplate(contract_type) {
            this.selected_contract_type = contract_type;
            this.showTemplateModal = true;
        },
        fetchContractType() {
            client.get(endpoints.show(this.selected_contract_type.id))
                .then(({data}) => this.selected_contract_type = data)
                .then(() => this.items = this.items.map(t => t.id === this.selected_contract_type.id ? this.selected_contract_type : t))
                .catch(error => this.$toasted.error(error.message))
        },
        fetchContractTypes() {
            client.get(endpoints.list)
                .then(({data}) => this.items = data)
                .then(() => this.isLoading = false)
                .catch(error => this.$toasted.error(error.message))
        },
        submit() {
            client.post(endpoints.store, this.formData)
                .then(({data}) => this.items.push(data))
                .then(() => this.formDate = {label: null})
                .then(() => this.showCreateModal = false)
                .catch(error => this.$toasted.error(error.message))
        },
        updateDoc(contract_doc_1_id, contract_doc_2_id) {
            const data = {
                contract_type_id: this.selected_contract_type.id,
                contract_doc_1_id: contract_doc_1_id,
                contract_doc_2_id: contract_doc_2_id,
            }
            client.post(endpoints.ordering_doc, data)
                .then(() => this.$toasted.success('New order saved'))
                .catch(error => this.$toasted.error(error.message))
        },
        updateOrder(contract_date_1_id, contract_date_2_id) {
            const data = {
                contract_type_id: this.selected_contract_type.id,
                contract_date_1_id: contract_date_1_id,
                contract_date_2_id: contract_date_2_id,
            }
            client.post(endpoints.ordering, data)
                .then(() => this.$toasted.success('New order saved'))
                .catch(error => this.$toasted.error(error.message))
        },
        reorder(payload) {
            this.updateOrder(payload[0], payload[1])
            let first = this.selected_contract_type.contract_dates.find(d => d.id === payload[0])
            let second = this.selected_contract_type.contract_dates.find(d => d.id === payload[1])
            let temp = first.order
            first.order = second.order
            second.order = temp

            this.selected_contract_type.contract_dates = this.selected_contract_type.contract_dates.map(d => {
                if (d.id === first.id) {
                    return first
                } else if (d.id === second.id) {
                    return second
                } else {
                    return d
                }
            })

        },
        reorderDoc(payload) {
            this.updateDocOrder(payload[0], payload[1])
            let first = this.selected_contract_type.contract_documents.find(d => d.id === payload[0])
            let second = this.selected_contract_type.contract_documents.find(d => d.id === payload[1])
            let temp = first.order
            first.order = second.order
            second.order = temp

            this.selected_contract_type.contract_documents = this.selected_contract_type.contract_documents.map(d => {
                if (d.id === first.id) {
                    return first
                } else if (d.id === second.id) {
                    return second
                } else {
                    return d
                }
            })

        },

    }
}
</script>

<style scoped>

</style>

<template>
    <div class="WorkflowIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Workflows</h5>
                <button @click="showCreateModal = !showCreateModal"
                        class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Workflow
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
                            <router-link :to="{name:'Workflow',params:{id:item.id}}"
                                         class="btn btn-sm btn-icon btn-primary">
                                <i class="fa fa-eye"></i>
                            </router-link>
                            <button @click="showAttachModal(item)"
                                    class="ml-1 btn btn-sm btn-icon btn-info">
                                <i class="fas fa-cubes"></i>
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
                title="Create New Workflow"
                color="success"
                static
                size="xl">
            <create-new-workflow-form :form-data.sync="formData"/>
            <template #footer>
                <button @click="submit" class="btn btn-success">Create</button>
            </template>
        </CModal>
        <CModal :show.sync="showAttachWorkflowModal"
                :title="`Attach ${selectedWorkflow? selectedWorkflow.label:null} to entity`"
                color="success"
                static
                size="xl">
            <form class="form">
                <div class="form-group">
                    <label for="entity_id">Entity</label>
                    <select name="entity_id" id="entity_id" class="form-control" v-model="entity">
                        <option v-for="entity in entities"
                                :key="entity"
                                :value="entity">
                            {{ entity.split('\\').pop() }}
                        </option>
                    </select>
                </div>

            </form>

            <template #footer>
                <button @click="closeAttachModal" class="btn btn-secondary">Close</button>
                <button @click="attachWorkflow" class="btn btn-success">Assign</button>
            </template>
        </CModal>
    </div>
</template>

<script>
import endpoints from "../endpoints"
import CreateNewWorkflowForm from "../views/partials/CreateNewWorkflowForm"
import client from '@/client'


export default {
    name: "WorkflowIndex",
    components: {
        CreateNewWorkflowForm
    },
    data() {
        return {
            showCreateModal: false,
            showAttachWorkflowModal: false,
            isLoading: true,
            selectedWorkflow: null,
            entity: null,
            entities: [],
            items: null,
            fields: [
                {key: 'label'},
                {key: 'code'},
                {
                    key: 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            formData: {
                label: null,
                code: null,
            },
        }
    },
    created() {
        client.get(endpoints.list)
            .then(({data}) => this.items = data || [])
            .then(() => this.isLoading = false)

        client.get(endpoints.entities)
            .then(({data}) => this.entities = data)
    },
    methods: {
        showAttachModal(workflow) {
            this.selectedWorkflow = workflow
            this.showAttachWorkflowModal = true
        },
        closeAttachModal() {
            this.showAttachWorkflowModal = false
            this.selectedWorkflow = null
        },
        submit() {
            client.post(endpoints.store, this.formData)
                .then(() => this.$toasted.success('New workflow created'))
                .then(() => this.formData = {
                    label: null,
                    code: null,
                })
                .then(() => this.showCreateModal = false)
                .catch(error => this.$toasted.error('Cannot create wrokflow. ' + error.message))
        },
        attachWorkflow() {
            client.post(endpoints.assign_entity(this.selectedWorkflow.id), {entity: this.entity})
                .then(() => this.$toasted.success('Workflow attached to entity'))
                .then(() => this.closeAttachModal())
                .then(() => this.entity_id = null)
                .catch(error => this.$toasted.error('Cannot create wrokflow. ' + error.message))
        }
    }
}
</script>

<style scoped>

</style>

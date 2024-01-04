<template>
    <div class="OrganizationIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Organizations</h5>
                <button @click="showCreateModal = !showCreateModal"
                        class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Organization
                </button>
            </CCardHeader>
            <CCardBody v-if="items">
                <organization-tree-diagram :organizations="items" style="height:300px"/>
                <CDataTable
                    :items="items"
                    :fields="fields"
                    :loading="isLoading"
                    hover
                    :items-per-page="15"
                    column-filter
                    table-filter
                    sorter>
                    <template #parent.label="{item}">
                        <td>
                            {{ item.parent ? item.parent.label : 'none' }}
                        </td>
                    </template>
                    <template #actions="{item}">
                        <td>
                            <button @click="editOrg(item)" class="btn btn-sm btn-icon btn-info">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button @click="destroy(item)" class="ml-1 btn btn-sm btn-icon btn-danger">
                                <i class="far fa-trash-alt"></i>
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
                title="Create New Organization"
                color="success"
                static
                size="xl">
            <form class="form">
                <div class="form-group">
                    <label for="label">Organization Label</label>
                    <input type="text" id="label" class="form-control" v-model="formData.label"/>
                </div>
                <div class="form-group">
                    <label for="parent">Parent Organization</label>
                    <select type="text" id="parent" class="form-control" v-model="formData.parent_id">
                        <option :value="null">No parent organization</option>
                        <option v-for="org in items" :key="org.id" :value="org.id">{{ org.label }}</option>
                    </select>
                </div>
            </form>
            <template #footer>
                <button @click="submit" class="btn btn-success">Create</button>
            </template>
        </CModal>
        <CModal :show.sync="showUpdateModal"
                title="Create New Organization"
                color="success"
                static
                size="xl">
            <form class="form" v-if="selected_organization">
                <div class="form-group">
                    <label for="selected_label">Organization Label</label>
                    <input type="text" id="selected_label" class="form-control" v-model="selected_organization.label"/>
                </div>
                <div class="form-group">
                    <label for="selected_parent_org">Parent Organization</label>
                    <select type="text" id="selected_parent_org" class="form-control"
                            v-model="selected_organization.parent_id">
                        <option :value="null">No parent organization</option>
                        <option v-for="org in items" :key="org.id" :value="org.id">{{ org.label }}</option>
                    </select>
                </div>
            </form>
            <template #footer>
                <button @click="update" class="btn btn-success">Update</button>
            </template>
        </CModal>
    </div>
</template>

<script>
import endpoints from "../endpoints"
import client from '@/client'
import OrganizationTreeDiagram from "../components/OrganizationTreeDiagram";


export default {
    name: "OrganizationIndex",
    components: {OrganizationTreeDiagram},
    data() {
        return {
            showCreateModal: false,
            showUpdateModal: false,
            isLoading: true,
            selected_organization: null,
            entity: null,
            items: null,
            fields: [
                {key: 'label'},
                {key: 'parent.label'},
                {
                    key: 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            formData: {
                label: null,
                parent_id: null
            },
        }
    },
    created() {
        client.get(endpoints.list)
            .then(({data}) => this.items = data || [])
            .then(() => this.isLoading = false)
    },
    methods: {
        getParentLabel(org) {
            const item = this.items.find(i => i.id === org.parent_id)
            return item ? item.label : null
        },
        editOrg(org) {
            this.selected_organization = {
                id: org.id,
                label: org.label,
                parent_id: org.parent ? org.parent.id : null,
            }
            this.showUpdateModal = true
        },
        submit() {
            client.post(endpoints.store, this.formData)
                .then(({data}) => this.items.push(data))
                .then(() => this.$toasted.success("New organization created!"))
                .then(() => this.formData = {
                    label: null,
                    parent_id: null
                })
                .then(() => this.showCreateModal = false)
        },
        update() {
            client.put(endpoints.update(this.selected_organization.id), this.selected_organization)
                .then(({data}) => this.items = this.items.map(i => i.id === data.id ? data : i))
                .then(() => this.$toasted.success("Organization updated!"))
                .then(() => this.selected_organization = null)
                .then(() => this.showUpdateModal = false)
        },
        destroy(org) {
            client.delete(endpoints.delete(org.id))
                .then(({data}) => this.items = this.items.filter(i => i.id !== data.id))
                .then(() => this.$toasted.success("Organization deleted!"))
        },
    }
}
</script>

<style scoped>

</style>

<template>
    <div class="DutyIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Duties</h5>
                <button @click="showCreateModal = true"
                        class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i>
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
                    <template #label="{item}">
                        <td>
                            <button class="btn" @click="editItem(item)">{{ item.label }}</button>
                        </td>
                    </template>
                    <template #actions="{item}">
                        <td>
                            <button @click="goingDeleteItem(item)"
                                    type="button"
                                    class="btn btn-sm btn-danger">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </td>
                    </template>
                </CDataTable>
                 <CPagination
                     :activePage="paginationObject.activePage"
                     :pages="paginationObject.pages"
                     @update:activePage="updateActivePage"
                 />
             </CCardBody>
        </CCard>

        <CModal
            title="Warning"
            color="warning"
            centered
            :close-on-backdrop="false"
            :show="deleteWarningModal"
        >
            Are you sure to delete the item?
            <template #footer>
                <div class="w-100 d-flex justify-content-between">
                    <button @click="closeModal"
                            class="btn btn-secondary">Close</button>
                    <button @click="deleteItem"
                            class="btn btn-danger">Delete</button>
                </div>
            </template>
    </CModal>

        <CModal
            title="Create Duty"
            color="success"
            :close-on-backdrop="false"
            :show="showCreateModal"
        >
            <form class="form">
                <div class="form-group">
                    <label>Label</label>
                    <input v-model="formData.label" type="text" class="form-control" />
                </div>
            </form>
            <template #footer>
                <div class="w-100 d-flex justify-content-between">
                    <button @click="showCreateModal = false"
                            class="btn btn-secondary">Close</button>
                    <button @click="createItem"
                            class="btn btn-success">Create</button>
                </div>
            </template>
    </CModal>
        <CModal
            title="Create Duty"
            color="success"
            :close-on-backdrop="false"
            :show="showCreateModal"
        >
            <form class="form">
                <div class="form-group">
                    <label>Label</label>
                    <input v-model="formData.label" type="text" class="form-control" />
                </div>
            </form>
            <template #footer>
                <div class="w-100 d-flex justify-content-between">
                    <button @click="showCreateModal = false"
                            class="btn btn-secondary">Close</button>
                    <button @click="createItem"
                            class="btn btn-success">Create</button>
                </div>
            </template>
    </CModal>
        <CModal
            title="Edit Duty"
            color="info"
            :close-on-backdrop="false"
            :show="showEditModal"
        >
            <form v-if="selectedItem" class="form">
                <div class="form-group">
                    <label>Label</label>
                    <input v-model="selectedItem.label" type="text" class="form-control" />
                </div>
            </form>
            <template #footer>
                <div class="w-100 d-flex justify-content-between">
                    <button @click="showEditModal = false"
                            class="btn btn-secondary">Close</button>
                    <button @click="updateItem"
                            class="btn btn-success">Update</button>
                </div>
            </template>
    </CModal>
    </div>
</template>

<script>
import endpoints from "@/modules/Duty/endpoints"
import datatable from "@/mixins/datatable"
import client from "@/client"

export default {
    name    : "DutyIndex",
    mixins  : [datatable],
    data() {
        return {
            selectedDeleteItem: null,
            deleteWarningModal: false,
            showCreateModal   : false,
            showEditModal     : false,
            isLoading         : true,
            fields            : [
                {key: 'label'},
                {
                    key   : 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            external_url      : endpoints.list,
            selectedItem      : null,
            formData          : {
                label: null
            }
        }
    },
    computed: {
        permissions() {
            return this.$store.getters.permissions
        },
        items() {
            return this.paginator ? this.paginator.data : null;
        },
        paginationObject() {
            return {
                pages     : this.paginator ? this.paginator.last_page : 0,
                activePage: this.paginator ? this.paginator.current_page : 0,
            }
        }
    },
    created() {
        this.fetchItems()
    },
    methods : {
        goingDeleteItem(item) {
            this.selectedDeleteItem = item
            this.deleteWarningModal = true
        },
        deleteItem() {
            client.delete(endpoints.delete(this.selectedDeleteItem.id))
                  .then(() => this.fetchItems())
                  .then(() => this.closeModal())
                  .catch(error => console.log(error))

        },
        createItem() {
            client.post(endpoints.store, this.formData)
                  .then(() => this.fetchItems())
                  .then(() => this.formData.label = null)
                  .then(() => this.showCreateModal = false)
                  .catch(error => console.log(error))
        },
        editItem(item) {
            this.selectedItem = item
            this.showEditModal = true
        },
        updateItem() {
            client.put(endpoints.update(this.selectedItem.id), this.selectedItem)
                  .then(() => this.fetchItems())
                  .then(() => this.selectedItem = null)
                  .then(() => this.showEditModal = false)
                  .catch(error => console.log(error))
        },
        closeModal() {
            this.selectedDeleteItem = null
            this.deleteWarningModal = false
        }
    }
}
</script>

<style scoped>

</style>

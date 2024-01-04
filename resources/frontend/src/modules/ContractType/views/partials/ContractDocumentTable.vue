<template>
    <div>
        <h4>Add Documents
            <button @click="showAssignModal =true"
                    class="btn btn-sm btn-icon btn-success"><i class="fa fa-plus"></i>
            </button>
        </h4>
        <div v-if="documents.length > 0">
            <div @drop='onDrop($event,1)'
                 class="drop-zone"
                 @dragover.prevent
                 @dragenter.prevent>
                <div draggable v-for="doc in ordered_docs" :key="doc.is"
                     :data-id="doc.id"
                     @dragstart='startDrag($event, doc)'
                     @dragover='dragOver($event, doc)'
                     class="drag-el border rounded p-2">
                    {{ doc.label }} <span v-if="doc.is_required" class="badge badge-info">Required</span>
                </div>
            </div>
        </div>
        <div v-else>
            No date assigned to the contract type
        </div>

        <CModal title="Assign document to contract type"
                color="success"
                :show.sync="showAssignModal">
            <div class="form-group">
                <label>Document</label>
                <select v-model="formData.contract_doc_id"
                        class="form-control">
                    <option v-for="doc in available_docs" :key="doc.id" :value="doc.id">{{ doc.label }}</option>
                </select>
            </div>
            <div class="form-group">
                <label>Order</label>
                <input class="form-control" type="number" min="0" v-model="formData.order">
            </div>
            <div class="form-group">
                <label>Is required</label>
                <select v-model="formData.is_required"
                        class="form-control">
                    <option :value="true">Required</option>
                    <option :value="false">Optional</option>
                </select>
            </div>

            <template #footer>
                <div class="d-block w-100">
                    <button @click="closeModal" class="d-inline-block btn btn-secondary">Close</button>
                    <button @click="submit" class=" d-inline-block btn btn-success float-right">Assign</button>
                </div>
            </template>
        </CModal>
    </div>
</template>

<script>
import _ from 'lodash'
import client from "@/client"
import endpoints from "../../endpoints"

export default {
    name: "ContractDocumentTable",
    props: {
        contract_type: {
            type: Object,
        },
        documents: {
            type: Array,
            required: true
        },
        reloadDocuments: {
            type: Function,
            required: true
        },
    },

    data() {
        return {
            showAssignModal: false,
            draggingId: null,
            dragOverId: null,
            all_documents: [],
            formData: {
                contract_doc_id: null,
                order: null,
                is_required: false,
            }
        }
    },
    computed: {
        ordered_docs() {
            return _.sortBy(this.documents, ['order', 'label'])
        },
        available_docs() {
            const docIds = this.documents.map(d => d.id)
            return _.filter(this.all_documents, doc => {
                return docIds.indexOf(doc.id) === -1
            })
        }
    },
    mounted() {
        client.get(endpoints.all_docs)
            .then(({data}) => this.all_documents = data)
            .catch(({error}) => this.$toasted.error(error.message()))
    },
    methods: {
        submit() {
            this.formData.contract_type_id = this.contract_type.id
            client.post(endpoints.assign_doc, this.formData)
                .then(() => this.$toasted.success('Contract date assigned'))
                .then(() => this.reloadDocuments())
                .then(() => this.showAssignModal = false)
                .catch(error => this.$toasted.error(error.message))
        },
        startDrag(evt, item) {
            evt.dataTransfer.dropEffect = 'move'
            evt.dataTransfer.effectAllowed = 'move'
            this.draggingId = item.id
        },
        dragOver(evt) {
            this.dragOverId = parseInt(evt.target.dataset.id)
        },
        onDrop() {
            this.$emit('reorder', [this.draggingId, this.dragOverId])
            this.draggingId = this.dragOverId = null
        },
        closeModal() {
            this.showAssignModal = false
            this.formData = {
                contract_doc_id: null,
                order: null,
                is_required: false,
            }
        }
    },

}
</script>

<style scoped>
.drop-zone {
    margin-bottom: 10px;
    padding: 10px;
}

.drag-el {
    background-color: #fff;
    margin-bottom: 10px;
    padding: 5px;
}

</style>

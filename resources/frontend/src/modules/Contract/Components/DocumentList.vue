<template>
    <div class="DocumentList">
        <h4>Documents
            <button v-if="canUpdateContract"
                    @click="showModal = true"
                    class="btn btn-success btn-sm btn-icon">
                <i class="fa fa-plus"></i>
            </button>
        </h4>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>File Name</th>
                <th v-if="canUpdateContract">Actions</th>
            </tr>
            </thead>

            <tbody>
            <DocumentTableRow v-for="document in displayed_documents"
                              :document="document"
                              :can-update-contract="canUpdateContract"
                              @upload-file="uploadFile(document)"
                              @remove-file="removeFile"/>
            </tbody>
        </table>

        <CModal title="Add Document"
                size="lg"
                :show.sync="showModal">
            <v-select v-model="formData.document_id" :reduce="d=>d.id" :options="can_be_added_documents"
                      label="label"></v-select>
            <template #footer>
                <button @click="addDocument" class="btn btn-success">Add</button>
            </template>
        </CModal>

        <CModal size="lg"
                title="Add file"
                :show.sync="showFileUploadModal">
            <Dropzone v-if="showFileUploadModal"
                      :url="fileUploadUrl"
                      :options="uploadFileOptions"
                      @success="fileUploadSuccess"/>
            <template #footer>
                <button @click="showFileUploadModal=false" class="btn btn-secondary">Close</button>
            </template>
        </CModal>


    </div>

</template>

<script>
import vSelect from 'vue-select'
import DocumentTableRow from './DocumentTableRow'
import Dropzone from '@/components/Base/Dropzone'
import endpoints from '../endpoints'
import client from '@/client'


export default {
    name: "DocumentList",
    components: {vSelect, DocumentTableRow, Dropzone},
    props: {
        contractId: {
            type: Number,
        },
        documents: {
            type: Array,
            required: true
        },
        selectedDocuments: {
            type: Array,
            required: true
        },
        canUpdateContract: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            showModal: false,
            showFileUploadModal: false,
            selectedDocument: null,
            uploadFileOptions: {
                maxFile: 1
            },
            formData: {
                document_id: null
            }
        }
    },
    computed: {
        displayed_documents() {
            return this.documents.map(d => this.findSelectedDocument(d) ?? (d.assignment.is_required ? d : null))
                .filter(d => d !== null)
        },
        can_be_added_documents() {
            return this.documents.filter(d => !this.inSelectedDocuments(d) && d.assignment.is_required === false)
        },
        fileUploadUrl() {
            return endpoints.update_contract_document(this.contractId)
        }
    },

    methods: {
        findSelectedDocument(document) {
            return this.selectedDocuments.find(sd => sd.id === document.id)
        },
        inSelectedDocuments(document) {
            return this.selectedDocuments.map(sd => sd.id).indexOf(document.id) > -1
        },
        showValue(document) {
            return this.findSelectedDocument(document)?.value || "TBC"
        },
        updateDate(evt, document) {
            this.$emit('update-document', {contract_document_id: document.id, value: evt.target.value})
        },
        setValue(document) {
            return this.selectedDocuments.find(sd => sd.id === document.id)?.value.value
        },
        addDocument() {
            this.$emit('add-document', {contract_document_id: this.formData.document_id})
            this.showModal = false
            this.formData.date_id = null
        },

        uploadFile(document) {
            this.uploadFileOptions.params = {
                document_id: document.id,
            }

            this.$nextTick(() => {
                this.showFileUploadModal = true
            })
        },
        removeFile(payload) {
            if (confirm('Are you sure to remove the document?')) {
                client.delete(endpoints.remove_contract_document(this.contractId, payload.id))
                    .then(() => this.$toasted.success("Document removed"))
                    .then(() => this.$emit('file-deleted'))
                    .catch(({response}) => this.$toasted.error(response.message))
            }
        },
        fileUploadSuccess() {
            this.$toasted.success('File uploaded')
            this.showFileUploadModal = false
            this.$emit('file-uploaded');
        }
    }
}
</script>

<style scoped>

</style>

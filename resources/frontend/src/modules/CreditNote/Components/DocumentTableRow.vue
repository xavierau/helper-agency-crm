<template>
    <tr>
        <td>{{ document.label }}</td>
        <td>
            <a v-if="hasUploadFile"
               class="btn btn-primary btn-sm btn-icon"
               target="_blank"
               :href="`/contracts/${document.doc.contract_id}/documents/${document.id}`">
                Show
            </a>
            <CButton v-else color="info"
                     size="sm"
                     @click="uploadFile">
                Upload File
            </CButton>
        </td>
        <td v-if="canUpdateContract">
            <button @click="$emit('remove-file',document)"
                    class="btn btn-sm btn-icon btn-danger">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    </tr>
</template>

<script>
export default {
    name: "DocumentTableRow",
    props: {
        document: {
            type: Object,
            required: true
        },
        canUpdateContract: {
            type: Boolean,
            required: true
        }
    },
    computed: {
        hasUploadFile() {
            return !!this.document.doc?.value
        }
    },
    methods: {
        uploadFile() {
            this.$emit('upload-file')
        },
    }
}
</script>

<style scoped>

</style>

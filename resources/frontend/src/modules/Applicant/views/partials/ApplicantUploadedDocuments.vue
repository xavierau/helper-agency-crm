<template>
    <div>
        <button class="mb-3 float-right btn btn-success btn-sm"
                @click="show_add_document = true">
            <i class="fa fa-plus"></i> Add
        </button>
        <table class="table striped">
            <thead>
            <th>Label</th>
            <th>Link</th>
            </thead>
            <tbody>
            <tr v-for="document in documents"
                :key="document.id">
                <td>{{ document.label }}</td>
                <td>
                    <a :href="`/${document.link}`"
                       target="_blank"
                       class="btn btn-primary btn-sm">File</a>
                </td>
            </tr>
            </tbody>
        </table>

        <CModal :show.sync="show_add_document"
                title="Add New Document">
            <form id="newUploadDocumentForm"
                  enctype="multipart/form-data"
                  @submit.prevent="submit">
                <div class="form-group">
                    <label>Label</label>
                    <input type="text" name="label" class="form-control">
                </div>
                <div class="form-group">
                    <label>File</label>
                    <input type="file" name="file" class="form-control">
                </div>

                <div class="form-group">
                    <button class="btn btn-success"
                            type="submit">Submit
                    </button>
                </div>

            </form>

            <template #footer>
                <span></span>
            </template>

        </CModal>
    </div>

</template>

<script>
import client from "@/client";
import endpoints from "../../endpoints";

export default {
    name: "ApplicantUploadedDocuments",
    props: {
        applicantId: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            documents: [],
            show_add_document: false,
        }
    },
    created() {
        this.fetchUploadedDocuments()
    },
    methods: {
        fetchUploadedDocuments() {
            client.get(endpoints.uploaded_documents(this.applicantId))
                .then(({data}) => this.documents = data)
                .then(error => this.$toasted.error(error.message))
        },
        submit(e) {
            const data = new FormData(e.target)

            client.post(endpoints.store_uploaded_documents(this.applicantId), data)
                .then(({data}) => this.fetchUploadedDocuments())
                .then(() => this.$toasted.success('Document uploaded!'))
                .then(() => e.target.reset())
                .then(() => this.show_add_document = false)
                .catch(error => this.$toasted.error('Cannot upload document'))

        }
    }
}
</script>

<style scoped>

</style>

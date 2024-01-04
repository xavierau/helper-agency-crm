<template>
    <div>
        <h4>Add Dates
            <button @click="showAssignModal =true"
                    class="btn btn-sm btn-icon btn-success"><i class="fa fa-plus"></i>
            </button>
        </h4>
        <div v-if="templates.length > 0">
            <div class="drop-zone">
                <div v-for="template in templates" :key="template.is"
                     class="border rounded p-2 m-2 clearfix">
                    {{ template.label }}

                    <button @click="removeTemplate(template)" class="btn btn-danger btn-sm float-right"><i
                        class="far fa-trash-alt"></i></button>
                </div>
            </div>
        </div>
        <div v-else>
            No date assigned to the contract type
        </div>

        <CModal title="Assign template to contract type"
                color="success"
                :close-on-backdrop="false"
                :show.sync="showAssignModal">
            <div class="form-group">
                <label>Template</label>
                <v-select v-model="formData.template_id"
                          :options="available_templates"
                          :reduce="t=>t.id"
                          label="label">
                </v-select>
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
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'

export default {
    name: "ContractTemplateTable",
    props: {
        contract_type: {
            type: Object,
        },
        templates: {
            type: Array,
            required: true
        },
        reload: {
            type: Function,
        }
    },
    components: {
        vSelect
    },
    data() {
        return {
            showAssignModal: false,
            draggingId: null,
            dragOverId: null,
            all_templates: [],
            formData: {
                template_id: null,
            }
        }
    },
    computed: {
        available_templates() {
            const templateIds = this.templates.map(t => t.id)
            return _.filter(this.all_templates, template => templateIds.indexOf(template.id) === -1)
        }
    },
    mounted() {
        client.get(endpoints.all_templates)
            .then(({data}) => this.all_templates = data)
            .catch(({error}) => this.$toasted.error(error.message()))
    },
    methods: {
        submit() {
            client.post(endpoints.assign_templates(this.contract_type.id), this.formData)
                .then(() => this.$toasted.success('Template assigned'))
                .then(() => this.reload())
                .then(() => this.closeModal())
                .catch(error => this.$toasted.error(error.message))
        },
        removeTemplate(template) {
            if (confirm('Are you sure to remove the template?')) {
                client.delete(endpoints.remove_templates(this.contract_type.id, template.id))
                    .then(() => this.$toasted.success('Template removed'))
                    .then(() => this.reload())
                    .then(() => this.closeModal())
                    .catch(error => this.$toasted.error(error.message))
            }

        },
        closeModal() {
            this.showAssignModal = false
            this.formData = {
                template_id: null,
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

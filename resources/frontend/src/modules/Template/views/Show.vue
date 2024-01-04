<template>
    <div class="EditTemplate">
        <CCard v-if="template">
            <CCardHeader>Edit Template</CCardHeader>
            <CCardBody>
                <fieldset>
                    <legend>Basic Info</legend>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Template name</label>
                                <input class="form-control" v-model="template.label"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Template tags</label>
                                <v-select :options="tags" taggable multiple v-model="template.tags"></v-select>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Content
                        <button @click="isEditorMode = !isEditorMode" class="btn btn-info btn-sm ml-3">Source Mode
                        </button>
                    </legend>
                    <div class="form-group">
                        <ckeditor v-if="isEditorMode"
                                  :editor="editor"
                                  :config="editorConfig"
                                  v-model="editorData"
                                  class="form-control"></ckeditor>
                        <textarea v-else
                                  v-model="editorData"
                                  class="form-control" style="height:50vh"></textarea>
                    </div>
                </fieldset>
            </CCardBody>
            <CCardFooter>
                <div class="row">
                    <div class="col-12">
                        <router-link :to="{name:'Templates'}"
                                     class="btn btn-secondary">Back
                        </router-link>
                        <button @click="submit"
                                class="btn btn-success float-right">Update
                        </button>

                    </div>
                </div>

            </CCardFooter>
        </CCard>
        <h1 class="text-center" v-else>Loading...</h1>
    </div>
</template>

<script>
import client from "@/client"
import endpoints from "@/modules/Template/endpoints"
import CKEditor from '@ckeditor/ckeditor5-vue2'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'

export default {
    name: "EditTemplate",
    components: {
        ckeditor: CKEditor.component,
        vSelect
    },
    data() {
        return {
            isEditorMode: true,
            editor: ClassicEditor,
            editorData: '',
            editorConfig: {
                htmlEncodeOutput: false,
                entities: false,
                typing: {
                    transformations: {
                        remove: [
                            'arrowRight',
                        ]
                    }
                }
            },
            tags: [
                'Product',
                'Product Variant',
                'Contract Type',
            ],
            isLoading: true,
            template: null
        }
    },
    created() {

        client.get(endpoints.show(this.$route.params.id))
            .then(({data}) => this.template = data)
            .catch(error => this.$toasted.error('Cannot load template. ' + error.message))

        client.get(endpoints.get_template_content(this.$route.params.id))
            .then(({data}) => this.editorData = data)
            .catch(error => this.$toasted.error('Cannot load template content. ' + error.message))
    },


    methods: {
        submit() {
            const data = {
                label: this.template.label,
                tags: this.template.tags,
                content: this.editorData,
            }
            client.put(endpoints.update(this.$route.params.id), data)
                .then(() => this.$toasted.success('template updated!'))
                .catch(error => this.$toasted.error('Cannot create client. ' + error.message))
        }
    }
}
</script>

<style lang="scss">
.ck-editor__editable {
    min-height: 500px;
}
</style>

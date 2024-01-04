<template>
    <div class="CreateTemplate">
        <CCard>
            <CCardHeader>New Template</CCardHeader>
            <CCardBody>
                <fieldset>
                    <legend>Basic Info</legend>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Template name</label>
                                <input class="form-control" v-model="formData.label"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Template tags</label>
                                <v-select :options="tags" taggable multiple v-model="formData.tags"></v-select>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Content</legend>
                    <div class="form-group">
                        <ckeditor :editor="editor"
                                  :config="editorConfig"
                                  v-model="formData.content"
                                  class="form-control"></ckeditor>
                    </div>
                </fieldset>
            </CCardBody>
            <CCardFooter>
                <div class="row">
                    <div class="col-12">
                        <router-link :to="{name:'Templates'}"
                                     class="btn btn-secondary btn-sm">Back
                        </router-link>
                        <button @click="submit"
                                class="btn btn-success btn-sm float-right">Create
                        </button>

                    </div>
                </div>

            </CCardFooter>
        </CCard>
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
    name: "CreateTemplate",
    components: {
        ckeditor: CKEditor.component,
        vSelect
    },
    data() {
        return {
            editor: ClassicEditor,
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
                'General',
            ],
            isLoading: true,
            formData: {
                label: null,
                tags: [],
                content: null,
            }
        }
    },
    methods: {
        submit() {
            client.post(endpoints.store, this.formData)
                .then(() => this.$router.push({name: "Templates"}))
                .then(() => this.$toasted.success('template created!'))
                .catch(error => this.$toasted.error('Cannot create client. ' + error.message))
        },
    }
}
</script>

<style lang="scss">
.ck-editor__editable {
    min-height: 500px;
}
</style>

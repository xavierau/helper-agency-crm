<template>
    <div class="VariantTemplate">
        <div v-if="product">
            <h1>Print template for {{ product.name }} ({{ variant.name }})</h1>

            <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>

            <div class="row mt-2">
                <div class="col-12">
                    <button @click="submit" class="btn btn-success">Submit</button>
                </div>
            </div>

        </div>
        <div v-else>
            <h1 class="text-center">Loading...</h1>
        </div>


    </div>


</template>

<script>
import client from "@/client"
import endpoints from "../endpoints"
import CKEditor from "@ckeditor/ckeditor5-vue2"
// import DecoupledEditor from "@ckeditor/ckeditor5-build-decoupled-document"
import ClassicEditor from "@ckeditor/ckeditor5-build-classic"


export default {
    name: "VariantTemplate",
    components: {
        // Use the <ckeditor> component in this view.
        ckeditor: CKEditor.component
    },
    data() {
        return {
            product: null,
            variant: null,
            editor: ClassicEditor,
            editorData: "",
            editorConfig: {
                typing: {
                    transformations: {
                        remove: [
                            'arrowLeft',
                            'arrowRight'
                        ]
                    }
                }
            }
        }
    },
    created() {
        client.get(endpoints.show_product_variants(this.$route.params.product_id, this.$route.params.variant_id))
            .then(({data}) => {
                this.product = data.product
                this.variant = data.variant
            })
            .catch(error => this.$toasted.error(error.message))

        client.get(endpoints.load_variant_template(this.$route.params.product_id, this.$route.params.variant_id))
            .then(({data}) => this.editorData = data)
            .catch(error => this.$toasted.error(error.message))

    },
    methods: {
        submit() {
            let data = {
                variant_id: this.$route.params.variant_id,
                content: this.editorData.replace(/&gt;/gi,'>'),
            }
            client.post(endpoints.add_template(this.product.id), data)
                .then(() => this.$toasted.success('Updated Template'))
                .catch(error => this.$toasted.error(error.message))
        }
    }

}
</script>

<style>
.ck-editor__editable {
    background-color: white;
    /*padding: 5mm;*/
    /*width: 21cm;*/
    /*height: 29.7cm;*/

    height: 20vh;
    min-height: 300px;
}
</style>

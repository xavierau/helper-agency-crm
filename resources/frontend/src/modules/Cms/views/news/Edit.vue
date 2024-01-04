<template>
    <div class="NewsEdit">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Create News</h5>
            </CCardHeader>
            <CCardBody>
                <form class="form"
                      @submit.prevent="submit">
                    <CTabs variant="pills" :active-tab="0">
                        <CTab title="English" class="mb-3">
                            <div class="form-group">
                                <CInput
                                    label="Title"
                                    name="title"
                                    v-model="news.title"
                                    placeholder="Enter news title"
                                />
                            </div>
                            <div class="form-group">
                                <label for="summary"
                                       class="form-label">Summary</label>
                                <textarea class="form-control"
                                          name="summary"
                                          rows="3"
                                          v-model="news.summary"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="col-12 col-md-4 col-lg-3" v-if="news.thumbnail">
                                    <img :src="`${news.thumbnail}`" class="img-fluid">
                                </div>
                                <label for="thumbnail"
                                       class="form-label">Thumbnail</label>
                                <input type="file" class="form-control"
                                       accept="image/png, image/jpeg"
                                       name="thumbnail"
                                       @change="updateFile">
                            </div>
                            <div class="form-group">
                                <label for="content"
                                       class="form-label">Content</label>
                                <ckeditor :editor="editor"
                                          v-model="news.content"
                                          :config="editorConfig"></ckeditor>

                            </div>
                        </CTab>
                        <CTab title="中文" class="mb-3">
                            <div class="form-group">
                                <label for="title_chi"
                                       class="form-label">標題</label>
                                <input type="text"
                                       class="form-control"
                                       name="title_chi"
                                       v-model="news.title_chi">
                            </div>
                            <div class="form-group">
                                <label for="summary_chi"
                                       class="form-label">簡介</label>
                                <textarea class="form-control"
                                          name="summary_chi"
                                          rows="3"
                                          v-model="news.summary_chi"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="thumbnail_chi"
                                       class="form-label">Thumbnail</label>
                                <CInputFile v-model="news.thumbnail_chi"/>
                            </div>
                            <div class="form-group">
                                <label for="content_chi"
                                       class="form-label">內容</label>
                                <ckeditor :editor="editor"
                                          v-model="news.content_chi"
                                          :config="editorConfig"/>

                            </div>
                        </CTab>
                    </CTabs>
                    <div class="form-group">
                        <label for="is_active"
                               class="form-label">Is Active</label>
                        <select name="is_active"
                                id="is_active"
                                class="form-control"
                                v-model="news.is_active">
                            <option :value="true">Active</option>
                            <option :value="false">Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit"
                                :disabled="loading"
                                class="btn btn-success btn-sm">Update
                        </button>
                        <router-link class="btn btn-info btn-sm" :to="{name:'News'}">Back</router-link>
                    </div>
                </form>

            </CCardBody>
        </CCard>
    </div>
</template>

<script>
import datatable from "@/mixins/datatable";
import {capitalize, formatCurrency} from "@/filters/common";
import endpoints from "@/modules/Cms/endpoints";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import client from "@/client";

export default {
    name: "NewsEdit",
    data() {
        return {
            loading: false,
            news: null,
            form: {
                title: '',
                title_chi: '',
                summary: '',
                summary_chi: '',
                content: '',
                content_chi: '',
                thumbnail: '',
                thumbnail_chi: '',
                is_active: true,
            },
            editor: ClassicEditor,
            editorConfig: {
                // The configuration of the editor.
            },

        }
    },

    created() {
        client.get(endpoints.get_news(this.$route.params.id))
            .then(({data}) => this.news = data)
            .catch(error => this.$toasted.error(error.message))
    },
    methods: {
        submit(e) {
            this.loading = true
            const data = new FormData(e.target)
            client.post(endpoints.create_news, data, {headers: {'Content-Type': 'multipart/form-data'}})
                .then(() => this.$router.push({name: 'News'}))
                .then(() => this.$toasted.success("News is created"))
                .finally(() => this.loading = false)
            console.log('going to submit')
        },
        updateFile(e) {
            const name = e.target.name
            this.form[name] = e.target.files[0]
        }
    }
}
</script>

<style scoped>

</style>

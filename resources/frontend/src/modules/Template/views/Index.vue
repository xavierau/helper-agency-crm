<template>
    <div class="TemplateIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">All Templates</h5>
                <router-link :to="{name:'Create Template'}" class="btn btn-success btn-sm"><i
                    class="fa fa-plus"></i> Template
                </router-link>
            </CCardHeader>
            <CCardBody class="table-responsive">
                <CDataTable
                    :items="templates"
                    :fields="fields"
                    column-filter
                    table-filter
                    items-per-page-select
                    :items-per-page="15"
                    hover
                    sorter
                    pagination
                >
                    <template #tags="{item}">
                        <td>
                            <span v-for="(tag, index) in item.tags"
                                  :key="index"
                                  class="badge badge-info p-1">{{ tag }}</span>
                        </td>
                    </template>
                    <template #actions="{item}">
                        <td>
                            <router-link :to="{name:'Template', params:{id:item.id}}"
                                         class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i>
                                Show
                            </router-link>
                        </td>
                    </template>
                </CDataTable>
            </CCardBody>
        </CCard>
    </div>
</template>

<script>
import endpoints from "@/modules/Template/endpoints"
import client from '@/client'

const defaultFormData = {label: null, tags: []}

export default {
    name: "TemplateIndex",
    data() {
        return {
            isLoading: true,
            fields: [
                {key: 'label', label: name},
                {key: 'tags'},
                {
                    key: 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            formData: Object.assign({}, defaultFormData),
        }
    },
    computed: {
        templates() {
            return this.$store.getters['template/templates']
        }
    },
    created() {
        this.$store.dispatch('template/fetchTemplates')
    },
    methods: {
        submit() {
            client.post(endpoints.store, this.formData)
                .then(() => this.$toasted.success('New applicant created'))
                .then(() => this.formData = Object.assign({}, defaultFormData))
                .catch(error => this.$toasted.error('Cannot create applicant. ' + error.message))
        }
    }
}
</script>

<style scoped>

</style>

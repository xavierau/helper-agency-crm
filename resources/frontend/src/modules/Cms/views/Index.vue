<template>
    <div class="PagesIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Pages</h5>
            </CCardHeader>
            <CCardBody>
                <CDataTable
                    :items="items"
                    :fields="fields"
                    column-filter
                    table-filter
                    items-per-page-select
                    :items-per-page="5"
                    hover
                    sorter
                    pagination
                >
                    <template #status="{item}">
                        <td>
                            <CBadge :color="getBadge(item.status)">
                                {{ item.status }}
                            </CBadge>
                        </td>
                    </template>
                    <template #actions="{item, index}">
                        <td class="py-2">
                            <router-link :to="{name:'Page Content', params:{id:item.id}}"
                                         class="btn btn-outline-primary btn-sm">
                                Content
                            </router-link>
                        </td>
                    </template>
                    <template #details="{item}">
                        <CCollapse :show="Boolean(item._toggled)" :duration="collapseDuration">
                            <CCardBody>
                                <CMedia :aside-image-props="{ height: 102 }">
                                    <h4>
                                        {{ item.username }}
                                    </h4>
                                    <p class="text-muted">User since: {{ item.registered }}</p>
                                    <CButton size="sm" color="info" class="">
                                        User Settings
                                    </CButton>
                                    <CButton size="sm" color="danger" class="ml-1">
                                        Delete
                                    </CButton>
                                </CMedia>
                            </CCardBody>
                        </CCollapse>
                    </template>
                </CDataTable>

            </CCardBody>
        </CCard>

        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Common Contents</h5>
            </CCardHeader>
            <CCardBody>
                <CDataTable
                    :items="common_items"
                    :fields="common_fields"
                    column-filter
                    table-filter
                    items-per-page-select
                    :items-per-page="5"
                    hover
                    sorter
                    pagination
                >
                    <template #actions="{item, index}">
                        <td class="py-2">
                            <router-link :to="{name:'Common Page Content', params:{key:item.key}}" F
                                         class="btn btn-outline-primary btn-sm">
                                Edit
                            </router-link>
                        </td>
                    </template>
                </CDataTable>

            </CCardBody>
        </CCard>
    </div>
</template>

<script>
import endpoints from "@/modules/Cms/endpoints"
import datatable from "@/mixins/datatable"
import {capitalize, formatCurrency} from "@/filters/common"
import client from "@/client";

export default {
    name: "InvoiceIndex",
    mixins: [datatable],
    filters: {capitalize, formatCurrency},
    data() {
        return {
            showCreateInvoiceModal: false,
            isLoading: true,
            search: null,
            fields: [
                {key: 'url'},
                {key: 'view'},
                {key: 'is_active'},
                {
                    key: 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
            items: [],
            clientPaginator: null,
            formData: {
                client_id: null,
                sellables: []
            },
            common_items: null,
            common_fields: [
                {key: 'key'},
                {key: 'content'},
                {
                    key: 'actions',
                    sorter: false,
                    filter: false,
                },
            ],
        }
    },
    computed: {
        clients() {
            return this.clientPaginator ? this.clentPaginator.items : []
        },
        permissions() {
            return this.$store.getters.permissions
        },
        canEdit() {
            return this.$store.getters.can('agency-finance:invoice.edit')
        }
    },
    created() {
        client.get(endpoints.pages)
            .then(({data}) => this.items = data)

        client.get(endpoints.common_contents)
            .then(({data}) => this.common_items = data)
    },
    methods: {}
}
</script>

<style scoped>

</style>

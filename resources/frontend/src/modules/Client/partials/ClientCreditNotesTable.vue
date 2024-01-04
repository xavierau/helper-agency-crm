<template>
    <CDataTable
        :items="credit_notes"
        :fields="[
                                           {key: 'first_name'},
                                           {key: 'last_name'},
                                           {key: 'is_primary'},
                                            'actions',
                                           ]"
        hover
        column-filter
        table-filter
        items-per-page-select
        :items-per-page="15"
        sorter
        pagination>
        <template #client_name="{item}">
            <td>
                <router-link
                    :to="{name:'Client',params:{id:item.client_id}}">
                    {{ item.client_name }}
                </router-link>
            </td>
        </template>
        <template #is_primary="{item}">
            <td>
                                               <span class="badge"
                                                     :class="{'badge-success':item.is_primary,'badge-warning':!item.is_primary }">
                                                   {{ item.is_primary ? 'Yes' : 'No' }}
                                               </span>
            </td>
        </template>
        <template #actions="{item}">
            <td>
                <router-link
                    :to="{name:'Client', params:{id:item.id}}"
                    class="btn btn-info btn-sm">
                    <i class="fa fa-eye"></i>
                </router-link>
            </td>
        </template>
    </CDataTable>
</template>

<script>
import endpoints from '@/modules/CreditNote/endpoints'
import client from "@/client";

export default {
    name: "ClientCreditNotesTable",
    props: {
        clientId: {
            type: Number,
            required: true
        }
    },
    data() {
        return {
            creditNotePaginator: null
        }
    },
    computed: {
        credit_notes() {
            return this.creditNotePaginator?.data || []
        }
    },
    created() {
        client.get(endpoints.list + `?client_id=${this.clientId}`)
            .then(({data}) => this.creditNotePaginator = data)
            .catch(error => this.$toasted.error('Something wrong! Cannot fetch credit notes'))
    }
}
</script>

<style scoped>

</style>

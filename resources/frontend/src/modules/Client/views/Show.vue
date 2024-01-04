<template>
    <div class="ShowClient">
        <CCard v-if="client">
            <CCardHeader>
                <h4>{{ client.prefix }} {{ client.full_name }}
                    <small>
                        <span v-if="client.is_primary"
                              class="badge badge-primary">{{ "Primary Contact" }}</span>
                        ({{ client.client_number }})
                    </small>
                    <button @click="showNewJobModal= true" class=" mx-2 btn btn-sm btn-success float-right">
                        <i class="fa fa-plus"></i> Job
                    </button>
                    <router-link :to="{name:'Edit Client', params:{id:client.id}}"
                                 class="btn btn-sm btn-info float-right mx-2">
                        <i class="fa fa-edit"></i> Edit
                    </router-link>
                    <router-link :to="{name:'Client Addresses', params:{id:client.id}}"
                                 class="btn btn-sm btn-info float-right mx-2">
                        <i class="fa fa-edit"></i> Edit Address
                    </router-link>
                </h4>
            </CCardHeader>
            <CCardBody>
                <div class="row">
                    <div class="col-sm-6">
                        <h6>Mobile: <a class="mr-1" :href="`tel:${client.mobile}`">{{
                                client.mobile
                            }}</a>
                            <a class="text-success" :href="`whatsapp://send?abid=${client.mobile}`"><i
                                class="fab fa-whatsapp"></i></a></h6>
                    </div>
                    <div class="col-sm-6">
                        <h6>HK ID: {{ client.hk_id }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6>
                            Address: <span v-for="a in my_addresses" :key="a.id">
                            {{ a.address_1 }} {{ a.address_2 }} {{ a.address_3 }} {{ a.country }}
                            <br>
                        </span>

                        </h6>
                    </div>
                </div>
                <CTabs variant="pills" :active-tab="0">
                    <CTab class="pt-3" title="Jobs">
                        <div v-if="client.jobs.length">
                            <div class="row">
                                <div class="col-12">
                                    <CDataTable
                                        :items="client.jobs"
                                        :fields="[
                                           {key: 'service_type'},
                                           {key: 'client_name'},
                                           {key: 'note'},
                                           {key: 'status'},
                                           {key: 'created_at'},
                                           {key: 'actions'}
                                           ]"
                                        hover
                                        column-filter
                                        table-filter
                                        items-per-page-select
                                        :items-per-page="5"
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
                                        <template #status="{item}">
                                            <td>
                                               <span class="badge"
                                                     :class="{'badge-success':item.status ==='active','badge-warning':item.status !=='active' }">
                                                   {{ item.status }}
                                               </span>
                                            </td>
                                        </template>
                                        <template #created_at="{item}">
                                            <td>
                                                {{ item.created_at | formatDate }}
                                            </td>
                                        </template>
                                        <template #actions="{item}">
                                            <td>
                                                <router-link :to="{name:'Job',params:{id:item.id}}"
                                                             class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </router-link>
                                            </td>
                                        </template>
                                    </CDataTable>
                                </div>
                            </div>


                        </div>
                        <div v-else>
                            <p>This client doesn't have any job</p>
                        </div>

                    </CTab>
                    <CTab class="pt-3" title="Contracts">
                        <div v-if="client.contracts.length">
                            <div class="row">
                                <div class="col-12">
                                    <CDataTable
                                        :items="client.contracts"
                                        :fields="[
                                           {key: 'contract_number'},
                                           {key: 'applicant.name'},
                                           {key: 'status'}
                                           ]"
                                        column-filter
                                        table-filter
                                        items-per-page-select
                                        :items-per-page="5"
                                        hover
                                        sorter
                                        pagination>
                                        <template #contract_number="{item}">
                                            <td>
                                                <router-link
                                                    :to="{name:'Contract',params:{id:item.id}}">
                                                    {{ item.contract_number }}
                                                </router-link>

                                            </td>
                                        </template>
                                        <template #applicant.name="{item}">
                                            <td>
                                                <router-link
                                                    :to="{name:'Applicant',params:{id:item.applicant.id}}">
                                                    {{ item.applicant.name }}
                                                </router-link>
                                            </td>
                                        </template>
                                        <template #status="{item}">
                                            <td>
                                          <span class="badge"
                                                :class="{'badge-success':item.status ==='active','badge-warning':item.status !=='active' }">
                                              {{ item.status }}
                                          </span>
                                            </td>
                                        </template>
                                    </CDataTable>

                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <p>This client doesn't have any contract</p>
                        </div>
                    </CTab>
                    <CTab class="pt-3" title="Invoices">
                        <div v-if="client.invoices.length">
                            <div class="row">
                                <div class="col-12">
                                    <CDataTable
                                        :items="client.invoices"
                                        :fields="[
                                           {key: 'invoice_number'},
                                           {key: 'contract.contract_number',label:'Contract'},
                                           {key: 'status'},
                                           {key: 'total',label:'Invoice Amount'},
                                           {key: 'paid'},
                                           ]"
                                        column-filter
                                        table-filter
                                        items-per-page-select
                                        :items-per-page="5"
                                        hover
                                        sorter
                                        pagination>
                                        <template #invoice_number="{item}">
                                            <td>
                                                <router-link
                                                    :to="{name:'Invoice', params:{id:item.id}}">
                                                    {{ item.invoice_number }}
                                                </router-link>
                                            </td>
                                        </template>
                                        <template #contract.contract_number="{item}">
                                            <td>
                                                <router-link
                                                    :to="{name:'Contract', params:{id:item.contract.id}}">
                                                    {{ item.contract.contract_number }}
                                                </router-link>
                                            </td>
                                        </template>
                                        <template #total="{item}">
                                            <td>
                                                {{ item.total | formatCurrency }}
                                            </td>
                                        </template>
                                        <template #paid="{item}">
                                            <td>
                                                {{ item.paid | formatCurrency }}
                                            </td>
                                        </template>
                                    </CDataTable>

                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <p>This client doesn't have any invoice</p>
                        </div>
                    </CTab>
                    <CTab class="pt-3" title="Payments">
                        <div>
                            <div class="row">
                                <div class="col-12">
                                    <ClientPaymentsTable
                                        :client-id="parseInt($route.params.id)"/>
                                </div>
                            </div>
                        </div>
                    </CTab>
                    <CTab class="pt-3" title="Relatives">
                        <div v-if="relatives && relatives.length">
                            <div class="row">
                                <div class="col-12">
                                    <CDataTable
                                        :items="relatives"
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
                                </div>

                            </div>
                        </div>
                        <div v-else>
                            <p>This client doesn't have other people</p>
                        </div>
                    </CTab>
                    <CTab class="pt-3" title="Credit Notes">
                        <div>
                            <div class="row">
                                <div class="col-12">
                                    <ClientCreditNoteTable
                                        :client-id="parseInt($route.params.id)"/>
                                </div>
                            </div>
                        </div>
                    </CTab>

                </CTabs>
            </CCardBody>
        </CCard>

        <CModal :show.sync="showNewJobModal" title="New Job" size="xl">

            <form class="form">
                <fieldset>
                    <legend>Job Info</legend>
                    <div class="form-group">
                        <label>Request service</label>
                        <div class="row">
                            <div class="btn-group btn-group-toggle btn-group-justified col-12"
                                 data-toggle="buttons">
                                <label class="btn btn-outline-info"
                                       :class="{active:service.value === formData.service_type }"
                                       v-for="service in service_types"
                                       :key="service.value">
                                    <input type="radio" :value="service.value"
                                           v-model="formData.service_type"> {{ service.label }}
                                </label>
                            </div>
                        </div>

                    </div>

                    <PeopleJobOrderForm v-if="formData.service_type === 'people'"
                                        :form-data.sync="formData.people"
                                        @inputUpdated="updatePeopleInput"/>

                    <section v-if="formData.service_type === 'other'">
                        <div class="form-group">
                            <label>Other Services</label>
                            <select class="form-control" multiple v-model="formData.other.services">
                                <option>Insurance</option>
                                <option>Ticket</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea v-model="formData.other.note" class="form-control"></textarea>
                        </div>
                    </section>
                </fieldset>
            </form>

            <template #footer>
                <button @click="showNewJobModal=false"
                        class="btn btn-sm mr-3 btn-secondary">Close
                </button>
                <button @click="submitNewJob" class="btn btn-sm mr-3 btn-success">Create</button>
            </template>
        </CModal>
    </div>
</template>

<script>
import endpoints from "@/modules/Client/endpoints"
import client from "@/client"
import PeopleJobOrderForm from '../partials/PeopleJobOrderForm'
import ClientCreditNoteTable from '../partials/ClientCreditNotesTable'
import ClientPaymentsTable from '../partials/ClientPaymentsTable'
import {formatDate, formatCurrency} from "@/filters/common"


export default {
    name: "ShowClient",
    data() {
        return {
            showNewJobModal: false,
            client: null,
            formData: {
                service_type: 'people',
                people: {
                    type: 'no_preference',
                    note: '',
                    nationality: null,
                },
                other: {
                    services: [],
                    note: ''
                },
            },
            service_types: [
                {label: 'People', value: 'people'},
                {label: 'Other', value: 'other'},
            ],
        }
    },
    components: {
        PeopleJobOrderForm,
        ClientPaymentsTable,
        ClientCreditNoteTable
    },
    filters: {
        formatDate,
        formatCurrency
    },
    computed: {
        my_addresses() {
            let me = this.client.account?.clients.find(c => c.id === this.client.id)
            if(me === undefined) return []
            return me.addresses
        },
        relatives() {
            return this.client.account?.clients.filter(c => c.id !== this.client.id)
        }
    },
    created() {
        this.fetchClient()
    },
    methods: {
        fetchClient() {
            client.get(endpoints.show(this.$route.params.id))
                .then(({data}) => this.client = data)
                .catch(error => this.$toasted.error(error.message))
        },
        submitNewJob() {
            client.post(endpoints.new_job(this.$route.params.id), this.formData)
                .then(({data}) => {
                    console.log('data return, ', data)
                    this.$router.push({name: 'Job', param: {id: data.id}})
                })
                .then(() => this.$toasted.success('New job created!'))
                .then(() => this.showNewJobModal = false)
                .catch(error => this.$toasted.error(error.message))
        },
        updatePeopleInput(payload) {
            this.formData.people[payload.key] = payload.value
        }
    }
}
</script>

<style scoped>

</style>

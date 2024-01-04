<template>
    <fieldset>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Client</label>
                    <span v-if="!canEdit || cannotEditField('client_id') "
                          class="form-control bg-secondary">
                            <router-link
                                :to="{name:'Client', params:{id:formData.client.id}}">
                                {{ formData.client.prefix }} {{ formData.client.full_name }}
                            </router-link>
                        </span>

                    <my-v-select v-else
                                 :options="clients"
                                 v-model="formData.client"
                                 label="full_name"
                                 placeholder="Search Client name, mobile etc"
                                 :disabled="!canEdit || hasPreset"
                                 :search-func="fetchClients">
                        <template #option="option">
                            {{ option.prefix }} {{ option.full_name }} - ({{ option.mobile }})
                        </template>
                    </my-v-select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Contract</label>
                    <span v-if="!canEdit || cannotEditField('contract.id') "
                          class="form-control bg-secondary">
                            <router-link
                                :to="{name:'Contract', params:{id:formData.contract.id}}">
                                {{ formData.contract.contract_number }}
                            </router-link>
                        </span>
                    <my-v-select v-else
                                 :options="contracts"
                                 v-model="formData.contract.id"
                                 :reduce="c=>c.id"
                                 label="contract_number"
                                 placeholder="Search Contact Number"
                                 :disabled="!canEdit || hasPreset"
                                 @search-func="fetchContracts">
                        <template #option="option">
                            {{ option.contract_number }} <small>({{ option.status }})</small>
                        </template>
                    </my-v-select>
                </div>
            </div>
        </div>
        <div class="row" v-if="formData.contract.id === 'new'">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Applicant</label>
                    <my-v-select :options="applicants"
                                 v-model="formData.contract.applicant"
                                 label="name"
                                 :search-func="fetchApplicants"
                                 :disabled="!canEdit || hasPreset"
                                 placeholder="Search Applicant">
                    </my-v-select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Contract Number</label>
                    <input class="form-control"
                           required
                           v-model="formData.contract.contract_number"
                           placeholder="Contract Number"/>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Internal Contract Code</label>
                    <input class="form-control"
                           required
                           v-model="formData.contract.internal_code"
                           placeholder="Internal Contract code"/>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Expected Arrival Date</label>
                    <input class="form-control"
                           type="date"
                           required
                           v-model="formData.requirement.expected_arrival_date"
                           placeholder="Expected arrival Date"/>
                </div>
            </div>
        </div>
    </fieldset>
</template>

<script>
import MyVSelect from "@/components/MyVSelect";
import client from "@/client"
import contractEndpoints from "@/modules/Contract/endpoints"
import clientEndpoints from "@/modules/Client/endpoints"
import applicantEndpoints from "@/modules/Applicant/endpoints"
import jobEndpoints from "@/modules/Job/endpoints"

export default {
    name: "NewInvoiceBasicInfo",
    props: {
        formData: {
            type: Object,
            required: true
        },
        canEdit: {
            type: Boolean,
            default: true
        },
        disabledFields: {
            type: Array,
            default() {
                return []
            }
        },
    },
    components: {MyVSelect},
    data() {
        return {
            clientPaginator: null,
            applicantPaginator: null,
            job: null,
            hasPreset: false
        }
    },
    computed: {
        clients() {
            return this.clientPaginator ? this.clientPaginator.data : []
        },
        applicants() {
            return this.applicantPaginator ? this.applicantPaginator.data : []
        },
        // client() {
        //     return this.clients.find(c => c.id === this.formData.client_id)
        // },
        contracts() {
            if (this.client) {
                return this.client.contracts.concat([{
                    id: 'new',
                    contract_number: 'Create New Contract',
                    status: 'new'
                }])
            } else {
                return [
                    {
                        id: 'new',
                        contract_number: 'Create New Contract',
                        status: 'new'
                    }
                ]
            }
        },
    },
    created() {
        this.parseQuery()
    },
    methods: {
        parseQuery() {
            console.log('going to parse')
            if (this.$route.query.job_id && this.$route.query.applicant_ref_number) {
                console.log('has job id')
                this.fetchJob(this.$route.query.job_id)
                    .then(({data}) => this.job = data)
                    .then(() => this.fetchClients(this.job.client.client_number)
                        .then(() => this.formData.client = this.clientPaginator.data[0]))
                    .then(() => this.formData.contract.job_id = this.job.id)
                    .then(() => this.formData.requirement.expected_arrival_date = this.job.requirement.expected_arrival_date)

                this.fetchApplicants(this.$route.query.applicant_ref_number)
                    .then(() => this.formData.contract.applicant = this.applicantPaginator.data[0])

                this.formData.contract.id = 'new'

                this.hasPreset = true

            } else if (this.$route.query.client_number &&
                this.$route.query.client_id &&
                this.$route.query.applicant_ref_number &&
                this.$route.query.applicant_id) {
                this.formData.contract.id = 'new'

                this.hasPreset = true

                this.fetchClients(this.$route.query.client_number)
                    .then(() => this.formData.client_id = this.clientPaginator.data[0].id)

                this.fetchApplicants(this.$route.query.applicant_ref_number)
                    .then(() => this.formData.contract.applicant = this.applicantPaginator.data[0])
            } else {
                this.fetchClients()
            }
        },
        cannotEditField(fieldName) {
            return this.disabledFields.indexOf(fieldName) > -1
        },
        fetchContracts(keyword = null) {
            return client.get(contractEndpoints.list, {params: {"filter[search]": keyword}})
                .then(({data}) => this.clientPaginator = data)
                .catch(error => console.log(error))
        },
        fetchClients(keyword = null) {
            return client.get(clientEndpoints.list, {params: {"filter[search]": keyword}})
                .then(({data}) => this.clientPaginator = data)
                .catch(error => console.log(error))
        },
        fetchApplicants(keyword = null) {
            return client.get(applicantEndpoints.list, {params: {"filter[search]": keyword}})
                .then(({data}) => this.applicantPaginator = data)
                .catch(error => console.log(error))
        },
        fetchJob(job_id) {
            return client.get(jobEndpoints.show(job_id))

        },
    }
}
</script>

<style scoped>

</style>

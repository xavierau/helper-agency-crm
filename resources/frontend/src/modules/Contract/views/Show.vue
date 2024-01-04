<template>
    <div class="ContractShow">
        <CCard v-if="contract">
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">
                    Contract: {{ contract.contract_number }}
                    <small><span class="badge badge-success">{{ contract.internal_code }}</span> ({{
                            contract.type.label
                        }})({{ contract.status }})</small>
                    <a target="_blank"
                       :href="`/contracts/${contract.id}/agreement`"
                       class="btn btn-info btn-sm mx-1">Print Agreement
                    </a>
                    <a target="_blank"
                       :href="`/contracts/${contract.id}/job_memo`"
                       class="btn btn-info btn-sm mx-1">Print Job memo
                    </a>
                    <router-link
                        v-if="contract && contract.invoice"
                        :to="{name:'Invoice', params:{id:contract.invoice.id}}"
                        class="mr-1 btn btn-info btn-sm">
                        Invoice
                    </router-link>
                    <router-link
                        v-if="contract && contract.invoice"
                        :to="{name:'Payments',query:{invoice_id:contract.invoice.id}}"
                        class="mr-1 btn btn-info btn-sm">
                        Add Payment
                    </router-link>

                    <button class="btn btn-success btn-sm"
                            @click="show_upload_documents = true">Uploaded Document
                    </button>
                </h5>
                <div>
                    <button v-for="transition in contract.transitions"
                            @click="applyTransition(transition)"
                            :key="transition.id"
                            class="mr-1 btn btn-info btn-sm">
                        {{ transition.label }}
                    </button>
                </div>
            </CCardHeader>
            <CCardBody>
                <div class="row">

                    <ClientBasicInfo :client="contract.client"
                                     class="col-md-6"/>

                    <ApplicantBasicInfo :applicant="contract.applicant"
                                        class="col-md-6"/>

                </div>

                <div class="row mt-3">
                    <DateList class="col-md-6"
                              :dates="contract.type.contract_dates"
                              :selected-dates="contract.dates"
                              :can-update-contract="canUpdateContract"
                              @update-date="updateDate"
                              @add-date="addDate"/>

                    <DocumentList class="col-md-6"
                                  :documents="contract.type.contract_documents"
                                  :contract-id="contract.id"
                                  :can-update-contract="canUpdateContract"
                                  :selected-documents="contract.documents"
                                  @file-uploaded="fetchContract"
                                  @add-document="addDocument"
                                  @file-deleted="fetchContract"
                    />

                    <div class="col-12">

                    </div>

                    <CButton
                        @click="show_contract_address_and_residents = !show_contract_address_and_residents"
                        color="info"
                        class="mb-2 btn-block"
                    >
                        {{
                            show_contract_address_and_residents ? "Hide Contract Address and Residents" : "Show Contract Address and Residents"
                        }}
                    </CButton>
                    <CCollapse class="col-12" :show="show_contract_address_and_residents">

                        <SelectContractAddress :contract.sync="contract"
                                               :can-update-contract="canUpdateContract"
                                               @address-changed="updateContract()"
                                               class="col-12"/>


                        <SelectContractResidents :contract.sync="contract"
                                                 :can-update-contract="canUpdateContract"
                                                 class="col-12"/>
                    </CCollapse>

                    <CButton
                        @click="show_requirement_section = !show_requirement_section"
                        color="info"
                        class="mb-2 btn-block"
                    >
                        {{ show_requirement_section ? "Hide Job Requirement" : "Show Job Requirement" }}
                    </CButton>
                    <CCollapse class="col-12" :show="show_requirement_section">
                        <RequirementInfo class="mb-3"
                                         :hidden-inputs="hiddenJobRequirmentInputs"
                                         :disabled-inputs="['expected_arrival_date']"
                                         :url="updateRequirementUrl"
                                         :requirement.sync="contract.requirement"/>
                    </CCollapse>
                    <CButton
                        @click="show_contract_detail = !show_contract_detail"
                        color="info"
                        class="mb-2 btn-block"
                    >
                        {{ show_contract_detail ? "Hide Contract Info" : "Show Contract Info" }}
                    </CButton>
                    <CCollapse class="col-12" :show="show_contract_detail">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Salary</label>
                                <input class="form-control" type="number" v-model="contract.salary"/>
                            </div>

                            <div class="form-group">
                                <label>Food Subsidy</label>
                                <input class="form-control" type="number" v-model="contract.food_subsidy"/>
                            </div>

                            <div class="form-group">
                                <label>Special Request 1</label>
                                <input class="form-control" type="number" v-model="contract.special_request_1"/>
                            </div>

                            <div class="form-group">
                                <label>Special Request 2</label>
                                <input class="form-control" type="number" v-model="contract.special_request_1"/>
                            </div>

                            <div class="form-group">
                                <label>Special Request 3</label>
                                <input class="form-control" type="number" v-model="contract.special_request_1"/>
                            </div>


                        </div>
                    </CCollapse>

                </div>
            </CCardBody>
        </CCard>
        <CCard v-else class="text-center">
            <h2 class="p-3">Loding...</h2>
        </CCard>

        <CModal :show.sync="show_upload_documents"
                title="Uploaded Documents"
                size="lg">
            <ContractUploadedDocuments
                :contract-id="parseInt($route.params.id)"/>
            <template #footer>
                <div></div>
            </template>
        </CModal>
    </div>
</template>

<script>
import endpoints from "@/modules/Contract/endpoints"
import client from "@/client"
import vSelect from "vue-select"
import "vue-select/dist/vue-select.css"
import DocumentList from "../Components/DocumentList"
import DateList from "../Components/DateList"
import ClientBasicInfo from "./_partials/ClientBasicInfo"
import ApplicantBasicInfo from "./_partials/ApplicantBasicInfo"
import SelectContractAddress from "./_partials/SelectContractAddress"
import SelectContractResidents from "./_partials/SelectContractResidents"
import RequirementInfo from "@/components/Requirement"
import ContractUploadedDocuments from './_partials/ContractUploadedDocuments'


export default {
    name: "ContractShow",
    data() {
        return {
            contract: null,
            showAddResidentsModal: false,
            showAddAddressModal: false,
            contract_dates: [],
            addresses: [],
            show_requirement_section: false,
            show_contract_detail: false,
            show_contract_address_and_residents: false,
            show_upload_documents: false
        }
    },
    computed: {
        updateRequirementUrl() {
            return endpoints.update_requirement(this.contract.id)
        },
        documents() {
            return []
        },
        canUpdateContract() {
            return this.contract.status === 'Pending' || this.contract.status === 'Submitted'
        },
        hiddenJobRequirmentInputs() {
            return [
                'number_of_adults',
                'number_of_elders',
                'number_of_kids',
                'number_of_young_adults',
                'number_of_expecting_babies'
            ]
        },
    },
    components: {
        vSelect,
        DateList,
        DocumentList,
        RequirementInfo,
        ClientBasicInfo,
        ApplicantBasicInfo,
        SelectContractAddress,
        SelectContractResidents,
        ContractUploadedDocuments
    },
    created() {
        this.fetchContract()
    },
    methods: {
        isState(state_code) {
            return this.contract.current_state?.state.code === state_code
        },
        fetchContract() {
            return client.get(endpoints.show(this.$route.params.id))
                .then(({data}) => this.contract = data)
                .catch(error => this.$toasted.error('cannot fetch contract ' + error.message))
        },
        updateContract() {
            client.put(endpoints.update(this.contract.id), {
                applicant_id: this.contract.applicant.id,
                client_id: this.contract.client.id,
                address_id: this.contract.address.id,
                status: this.contract.status,
                number_of_bedrooms: this.contract.number_of_bedrooms,
                dayoff_arrangement: this.contract.dayoff_arrangement,
                accommodation_type: this.contract.accommodation_type,
                accomodation_value: this.contract.accomodation_value,
                contract_number: this.contract.contract_number,
            })
                .then(() => this.$toasted.success("Contract updated"))
        },
        applyTransition(transition) {
            if (confirm('Are you sure to make the transition?')) {
                client.post(endpoints.transition(this.contract.id, transition.id))
                    .then(({data}) => this.contract = data)
                    .then(() => this.$toasted.success("Contract updated"))
                    .catch(error => this.$toasted.error(error.response.data.message))
            }

        },
        updateDate(payload) {
            return client.put(endpoints.update_contract_date(this.contract.id), payload)
                .then(() => this.fetchContract())
                .then(() => this.$toasted.success('Date updated!'))
                .catch(error => this.$toasted.error(error.message))

        },
        addDate(payload) {
            return client.post(endpoints.add_contract_date(this.contract.id), payload)
                .then(() => this.fetchContract())
                .then(() => this.$toasted.success('New date added!'))
                .catch(error => this.$toasted.error(error.message))

        },
        addDocument(payload) {
            return client.post(endpoints.add_contract_document(this.contract.id), payload)
                .then(() => this.fetchContract())
                .then(() => this.$toasted.success('New date added!'))
                .catch(error => this.$toasted.error(error.message))
        },
        refreshDocumentList() {

        }

    }
}
</script>

<style scoped>

</style>

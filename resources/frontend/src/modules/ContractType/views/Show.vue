<template>
    <div class="ContractShow">
        <CCard v-if="contract">
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">
                    Contract: {{ contract.contract_number }} <small>({{ contract.status }})</small>
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
                    <div class="col-md-6">
                        <div>
                            Client Name: <strong>{{ contract.client.prefix }}
                            {{ contract.client.full_name }}</strong>
                        </div>
                        <div>
                            Mobile: <strong>{{ contract.client.mobile }}</strong>
                        </div>
                        <div>
                            <router-link :to="{name:'Client',params:{id:contract.client.id}}"
                                         class="btn btn-info bnt-sm">Detail
                            </router-link>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            Applicant Name: <strong>{{
                                contract.applicant.name
                            }}</strong>
                        </div>
                        <div>
                            Gender: <strong>{{
                                contract.applicant.gender
                            }}</strong>
                        </div>
                        <div>
                            Age: <strong>{{
                                contract.applicant.age
                            }}</strong>
                        </div>
                        <div>
                            Nationality: <strong>{{
                                contract.applicant.nationality
                            }}</strong>
                        </div>
                        <div>
                            <router-link :to="{name:'Applicant',params:{id:contract.applicant.id}}"
                                         class="btn btn-info bnt-sm">Detail
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12" v-if="isState('active')">
                        <div class="row">
                            <div class="col-sm-6">
                                Start Date: {{ contract.start_date }}
                            </div>
                            <div class="col-sm-6">
                                End Date: {{ contract.end_date }}
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12">
                        Status: <strong>{{ contract.status }}</strong>
                    </div>
                    <div class="col-sm-12" v-if="!isState('pending')">
                        <div class="form-group">
                            <label>VISA appointment date</label>
                            <input :disabled="!isState('submitted')"
                                   type="date" class="form-control"
                                   placeholder="VISA appointment date"/>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h4>Address
                            <button v-if="canUpdateContract"
                                    @click="showAddAddressModal = true"
                                    class="btn btn-sm btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </h4>
                        <v-select :disabled="!canUpdateContract"
                                  :options="availableAddresses" labe="label"
                                  v-model="contract.address"></v-select>
                    </div>
                    <fieldset class="col-12">
                        <legend>Other Residents
                            <button v-if="canUpdateContract"
                                    @click="showSelectResidentsModal = true"
                                    class="btn btn-sm btn-success">
                                <i class="fa fa-plus"></i>
                            </button>
                        </legend>
                        <CDataTable :items="contract.residents"
                                    :fields="[
                                           {key: 'full_name'},
                                           {key: 'hk_id', label:'HK ID'},
                                           {key: 'mobile'},
                                           {key: 'actions', sorter:false,filter:false},
                                           ]"
                                    column-filter
                                    table-filter
                                    items-per-page-select
                                    :items-per-page="15"
                                    hover
                                    sorter
                                    pagination>
                            <template #actions="{item}">
                                <td>
                                    <button v-if="canUpdateContract"
                                            @click="removeResident(item)"
                                            class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </template>

                        </CDataTable>
                    </fieldset>
                </div>
            </CCardBody>

            <CCardFooter v-if="canUpdateContract">
                <button @click="updateContract" class="btn btn-success">Update</button>
            </CCardFooter>


            <CModal
                title="Select resident"
                color="success"
                size="xl"
                :show.sync="showSelectResidentsModal">
                <div class="form-group">
                    <label>Select Other Resident
                        <button @click='showAddResidentsModal=true'
                                class="btn btn-icon btn-rounded btn-success btn-sm">
                            <i class="fa fa-plus"></i>
                        </button>
                    </label>
                    <v-select :options="availableResidents"
                              label='full_name'
                              multiple
                              v-model="new_residents"></v-select>
                </div>
                <template #footer>
                    <button @click="showSelectResidentsModal=false"
                            class="btn btn-sm btn-secondary">Close
                    </button>
                    <button @click="addResidents" class="btn btn-sm btn-success">Create</button>
                </template>
            </CModal>

            <CModal
                title="Add New resident"
                color="success"
                size="xl"
                :show.sync="showAddResidentsModal">
                <div class="form-group">
                    <label>Add Resident</label>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" v-model="new_resident.first_name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" v-model="new_resident.last_name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" class="form-control" v-model="new_resident.mobile" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>HK ID</label>
                                <input type="text" class="form-control" v-model="new_resident.hk_id" required>
                            </div>
                        </div>
                    </div>
                </div>
                <template #footer>
                    <button @click="showAddResidentsModal=false"
                            class="btn btn-sm btn-secondary">Close
                    </button>
                    <button @click="createNewResident" class="btn btn-sm btn-success">Create</button>
                </template>
            </CModal>

            <CModal
                title="Add Address"
                color="success"
                size="xl"
                :show.sync="showAddAddressModal">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Address 1</label>
                                <input type="text" class="form-control" v-model="new_address.address_1" required>
                            </div>
                            <div class="form-group">
                                <label>Address 2</label>
                                <input type="text" class="form-control" v-model="new_address.address_2" required>
                            </div>
                            <div class="form-group">
                                <label>Address 3</label>
                                <input type="text" class="form-control" v-model="new_address.address_3" required>
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" class="form-control" v-model="new_address.country" required>
                            </div>
                        </div>
                    </div>
                </div>
                <template #footer>
                    <button @click="showAddAddressModal=false"
                            class="btn btn-sm btn-secondary">Close
                    </button>
                    <button @click="createNewAddress" class="btn btn-sm btn-success">Create</button>
                </template>
            </CModal>
        </CCard>
        <CCard v-else class="text-center">
            <h2 class="p-3">Loding...</h2>
        </CCard>
    </div>
</template>

<script>
import endpoints from "@/modules/Contract/endpoints"
import client from "@/client"
import vSelect from "vue-select"
import "vue-select/dist/vue-select.css"

export default {
    name: "ContractShow",
    data() {
        return {
            contract: null,
            showSelectResidentsModal: false,
            showAddResidentsModal: false,
            showAddAddressModal: false,
            addresses: [],
            new_residents: [],
            new_resident: {
                first_name: null,
                last_name: null,
                hk_id: null,
                mobile: null,
            },
            new_address: {
                address_1: null,
                address_2: null,
                address_3: null,
                country: 'Hong Kong',
            }
        }
    },
    computed: {
        canUpdateContract() {
            return this.contract.status === 'Pending' || this.contract.status === 'Submitted'
        },
        availableResidents() {
            return this.contract.client.account.clients.filter(c => c.id !== this.contract.client_id)
        },
        availableAddresses() {
            return this.contract.client.account.addresses.map(a => {
                a['label'] = `${a.address_1}, ${a.address_2 ? a.address_2 + "," : ''} ${a.address_3 ? a.address_3 + "," : ''} ${a.country},`
                return a
            })
        }
    },
    components: {vSelect},
    created() {
        this.fetchContract()
    },
    methods: {
        isState(state_code) {
            return this.contract.current_state?.state.code === state_code
        },
        fetchContract() {
            client.get(endpoints.show(this.$route.params.id))
                .then(({data}) => this.contract = data)
                .catch(error => this.$toasted.error('cannot fetch contract ' + error.message))
        },
        createNewResident() {
            client.post(endpoints.create_new_resident(this.contract.client_id), this.new_resident)
                .then(({data}) => this.contract.client.account.clients.push(data))
                .then(() => this.showAddResidentsModal = false)
                .then(() => this.new_resident = {
                    first_name: null,
                    last_name: null,
                    hk_id: null,
                    mobile: null,
                })
        },
        addResidents() {
            client.post(endpoints.add_residents(this.contract.id), {residents: this.new_residents})
                .then(({data}) => Array.isArray(data) ? data.forEach(c => this.contract.residents.push(c)) : this.contract.residents.push(data))
                .then(() => this.showSelectResidentsModal = false)
                .then(() => this.new_residents = [])
                .then(() => this.$toasted.success("Resident added"))
        },
        removeResident(resident) {
            if (confirm('Are you sure to remove resident?')) {
                client.delete(endpoints.remove_residents(this.contract.id, resident.id))
                    .then(() => this.contract.residents = this.contract.residents.filter(c => c.id !== resident.id))
                    .then(() => this.$toasted.success("Resident deleted"))
            }

        },

        createNewAddress() {
            client.post(endpoints.add_address(this.contract.id), this.new_address)
                .then(({data}) => this.contract.client.account.addresses.push(data))
                .then(() => this.showAddAddressModal = false)
                .then(() => this.new_address = {
                    address_1: null,
                    address_2: null,
                    address_3: null,
                    country: 'Hong Kong',
                })
                .then(() => this.$toasted.success("Address added"))
        },
        updateContract() {
            client.put(endpoints.update(this.contract.id), {
                applicant_id: this.contract.applicant.id,
                client_id: this.contract.client.id,
                address_id: this.contract.address.id,
                status: this.contract.status,
                contract_number: this.contract.contract_number,
            })
                .then(() => this.$toasted.success("Contract updated"))
        },
        applyTransition(transition) {
            if (confirm('Are you sure to make the transition?')) {
                client.post(endpoints.transition(this.contract.id, transition.id))
                    .then(({data}) => this.contract = data)
                    .then(() => this.$toasted.success("Contract updated"))
            }

        }
    }
}
</script>

<style scoped>

</style>

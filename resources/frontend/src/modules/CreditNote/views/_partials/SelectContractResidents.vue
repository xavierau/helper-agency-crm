<template>
    <fieldset class="SelectContractResidents">
        <legend>Other Residents
            <button v-if="canUpdateContract"
                    @click="showModal = true"
                    class="btn btn-sm btn-success">
                <i class="fa fa-plus"></i>
            </button>
        </legend>
        <CDataTable :items="residents"
                    :fields="fields"
                    column-filter
                    table-filter
                    items-per-page-select
                    :items-per-page="15"
                    hover
                    sorter
                    pagination>
            <template #full_name="{item}">
                <td>
                    <router-link :to="{name:'Edit Client', params:{id:item.id}}">{{ item.full_name }}</router-link>
                </td>
            </template>
            <template #actions="{item}">
                <td>
                    <DeleteButton v-if="canUpdateContract"
                                  :click="()=>removeResident(item)"/>
                </td>
            </template>

        </CDataTable>
        <CModal
            title="Select resident"
            color="success"
            size="xl"
            :show.sync="showModal">
            <div class="form-group">
                <label>Select Other Resident
                    <button @click='showAddResidentsModal=true'
                            class="btn btn-icon btn-rounded btn-success btn-sm">
                        <i class="fa fa-plus"></i>
                    </button>
                </label>
                <v-select :options="availableResidents"
                          label='full_name'
                          v-model="resident"></v-select>
            </div>
            <div class="form-group">
                <label>Relation</label>
                <input class="form-control" type="text" v-model="resident.relation"/>
            </div>
            <template #footer>
                <button @click="showModal=false"
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
            <CreateResident :new_resident.sync="new_resident"/>
            <template #footer>
                <button @click="showAddResidentsModal=false"
                        class="btn btn-sm btn-secondary">Close
                </button>
                <button @click="createNewResident" class="btn btn-sm btn-success">Create</button>
            </template>
        </CModal>
    </fieldset>
</template>

<script>
import client from "@/client";
import endpoints from "@/modules/Contract/endpoints";
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import DeleteButton from '@/components/Base/DeleteButton'
import CreateResident from "./CreateResident";

export default {
    name: "SelectContractResidents",
    props: {
        contract: {
            type: Object,
            required: true
        },
        canUpdateContract: {
            type: Boolean,
            require: true
        },
    },
    components: {
        vSelect,
        DeleteButton,
        CreateResident
    },
    data() {
        return {
            showModal: false,
            showAddResidentsModal: false,
            resident: {},
            new_resident: {
                hk_id: null,
                mobile: null,
                is_male: null,
                relation: null,
                last_name: null,
                first_name: null,
                date_of_birth: null,
            }
        }
    },
    computed: {
        residents() {
            const residentIds = this.contract.residents.reduce((carry, r) => {
                carry.push(r.id)
                return carry
            }, [])

            return _.filter(this.contract.client.relatives, r => residentIds.indexOf(r.id) > -1)
        },
        availableResidents() {
            const selectedResidents = this.contract.residents.map(r => r.id)
            return this.contract.client.relatives.filter(c => c.id !== this.contract.client.id && selectedResidents.indexOf(c.id) === -1)
        },
        fields() {
            let f = [
                {key: 'full_name'},
                {key: 'hk_id', label: 'HK ID'},
                {key: 'relation'},
                {key: 'mobile'},
            ]

            if (this.canUpdateContract) {
                f.push({key: 'actions', sorter: false, filter: false})
            }

            return f
        }

    },
    methods: {
        removeResident(resident) {
            if (confirm('Are you sure to remove resident?')) {
                client.delete(endpoints.remove_residents(this.contract.id, resident.id))
                    .then(() => this.contract.residents = this.contract.residents.filter(c => c.id !== resident.id))
                    .then(() => this.$toasted.success("Resident deleted"))
            }

        },
        addResidents() {
            client.post(endpoints.add_residents(this.contract.id), this.resident)
                .then(({data}) => this.updateResidents(data))
                // .then(({data}) => this.contract.client = data)
                // .then(() => this.showModal = false)
                .then(() => this.resident = {})
                .then(() => this.$toasted.success("Resident added"))
        },
        createNewResident() {
            client.post(endpoints.add_new_resident(this.contract.id), this.new_resident)
                .then(({data}) => {
                    this.contract.client.relatives.push(data)
                    this.updateResidents(data)
                })
                .then(() => this.$toasted.success("Resident added"))
                .then(() => this.showAddResidentsModal = false)
                .then(() => this.showModal = false)
                .then(() => this.resetNewResident())
        },
        resetNewResident() {
            this.new_resident = {
                hk_id: null,
                mobile: null,
                is_male: null,
                relation: null,
                last_name: null,
                first_name: null,
                date_of_birth: null,
            }
        },
        updateResidents(data) {
            Array.isArray(data) ?
                data.forEach(c => this.contract.residents.push(c)) :
                this.contract.residents.push(data)
        }
    }
}
</script>

<style scoped>

</style>

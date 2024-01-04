<template>
    <div>
        <h4>Add Dates
            <button @click="showAssignModal =true"
                    class="btn btn-sm btn-icon btn-success"><i class="fa fa-plus"></i>
            </button>
        </h4>
        <div v-if="dates.length > 0">
            <div @drop='onDrop($event,1)'
                 class="drop-zone"
                 @dragover.prevent
                 @dragenter.prevent>
                <div draggable v-for="date in ordered_dates" :key="date.is"
                     :data-id="date.id"
                     @dragstart='startDrag($event, date)'
                     @dragover='dragOver($event, date)'
                     class="drag-el border rounded p-2">
                    {{ date.label }} <span v-if="date.is_required" class="badge badge-info">Required</span>
                </div>
            </div>
        </div>
        <div v-else>
            No date assigned to the contract type
        </div>

        <CModal title="Assign date to contract type"
                color="success"
                :show.sync="showAssignModal">
            <div class="form-group">
                <label>Date</label>
                <select v-model="formData.contract_date_id"
                        class="form-control">
                    <option v-for="date in available_dates" :key="date.id" :value="date.id">{{ date.label }}</option>
                </select>
            </div>
            <div class="form-group">
                <label>Order</label>
                <input class="form-control" type="number" min="0" v-model="formData.order">
            </div>
            <div class="form-group">
                <label>Is required</label>
                <select v-model="formData.is_required"
                        class="form-control">
                    <option :value="true">Required</option>
                    <option :value="false">Optional</option>
                </select>
            </div>

            <template #footer>
                <div class="d-block w-100">
                    <button @click="closeModal" class="d-inline-block btn btn-secondary">Close</button>
                    <button @click="submit" class=" d-inline-block btn btn-success float-right">Assign</button>
                </div>
            </template>
        </CModal>
    </div>
</template>

<script>
import _ from 'lodash'
import client from "@/client"
import endpoints from "../../endpoints"

export default {
    name: "ContractDateTable",
    props: {
        contract_type: {
            type: Object,
        },
        dates: {
            type: Array,
            required: true
        },
        reloadDates: {
            type: Function,
            required: true
        },
    },

    data() {
        return {
            showAssignModal: false,
            draggingId: null,
            dragOverId: null,
            all_dates: [],
            formData: {
                contract_date_id: null,
                order: null,
                is_required: false,
            }
        }
    },
    computed: {
        ordered_dates() {
            return _.sortBy(this.dates, ['order', 'label'])
        },
        available_dates() {
            const dateIds = this.dates.map(d => d.id)
            return _.filter(this.all_dates, date => {
                return dateIds.indexOf(date.id) === -1
            })
        }
    },
    mounted() {
        client.get(endpoints.all_dates)
            .then(({data}) => this.all_dates = data)
            .catch(({error}) => this.$toasted.error(error.message()))
    },
    methods: {
        submit() {
            this.formData.contract_type_id = this.contract_type.id
            client.post(endpoints.assign, this.formData)
                .then(() => this.$toasted.success('Contract date assigned'))
                .then(() => this.reloadDates())
                .then(() => this.showAssignModal = false)
                .catch(error => this.$toasted.error(error.message))
        },
        startDrag(evt, item) {
            evt.dataTransfer.dropEffect = 'move'
            evt.dataTransfer.effectAllowed = 'move'
            this.draggingId = item.id
        },
        dragOver(evt) {
            this.dragOverId = parseInt(evt.target.dataset.id)
        },
        onDrop() {
            this.$emit('reorder', [this.draggingId, this.dragOverId])
            this.draggingId = this.dragOverId = null
        },
        closeModal() {
            this.showAssignModal = false
            this.formData = {
                contract_date_id: null,
                order: null,
                is_required: false,
            }
        }
    },

}
</script>

<style scoped>
.drop-zone {
    margin-bottom: 10px;
    padding: 10px;
}

.drag-el {
    background-color: #fff;
    margin-bottom: 10px;
    padding: 5px;
}

</style>

<template>

    <div class="DateList">
        <h4>Dates
            <button v-if="canUpdateContract"
                    @click="showModal = true"
                    class="btn btn-success btn-sm btn-icon">
                <i class="fa fa-plus"></i>
            </button>
        </h4>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th v-if="canUpdateContract">Actions</th>
            </tr>
            </thead>

            <tbody>
            <DateTableRow v-for="date in displayed_dates"
                          :date="date"
                          :can-update-contract="canUpdateContract"
                          @update-date="updateDate"/>
            </tbody>
        </table>

        <CModal title="Add Date"
                size="lg"
                :show.sync="showModal">
            <v-select v-model="formData.date_id" :reduce="d=>d.id" :options="can_be_added_dates"
                      label="label"></v-select>
            <template #footer>
                <button @click="addContractDate" class="btn btn-success">Add</button>
            </template>
        </CModal>
    </div>
</template>

<script>
import vSelect from 'vue-select'
import DateTableRow from "./DateTableRow";

export default {
    name: "DateList",
    components: {
        vSelect,
        DateTableRow
    },
    props: {
        dates: {
            type: Array,
            required: true
        },
        selectedDates: {
            type: Array,
            required: true
        },
        canUpdateContract: {
            type: Boolean,
            required: true
        }

    },
    data() {
        return {
            showModal: false,
            formData: {
                date_id: null
            }
        }
    },
    computed: {
        displayed_dates() {
            return this.dates.map(d => this.findSelectedDate(d) ?? (d.assignment.is_required ? d : null))
                .filter(d => d !== null)
        },
        can_be_added_dates() {
            return this.dates.filter(d => !this.inSelectedDate(d) && d.assignment.is_required === false)
        },
    },
    methods: {
        findSelectedDate(date) {
            return this.selectedDates.find(sd => sd.id === date.id)
        },
        inSelectedDate(date) {
            return this.selectedDates.map(sd => sd.id).indexOf(date.id) > -1
        },
        showValue(date) {
            return this.findSelectedDate(date)?.value || "TBC"
        },
        updateDate(payload) {
            this.$emit('update-date', payload)
        },
        setValue(date) {
            return this.selectedDates.find(sd => sd.id === date.id)?.value.value
        },
        addContractDate() {
            this.$emit('add-date', {contract_date_id: this.formData.date_id})
            this.showModal = false
            this.formData.date_id = null
        },
    }

}
</script>

<style scoped>

</style>

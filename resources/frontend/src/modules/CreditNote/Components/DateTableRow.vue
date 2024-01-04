<template>
    <tr>
        <td>{{ date.label }}</td>
        <td>
            <CInput
                type="date"
                :disabled="canUpdateContract === false"
                :value="selectedValue"
                @change="updateDateValue">
                <template #append>
                    <CButton v-if="showButton"
                             @click="updateDate"
                             type="button"
                             color="success">
                        <i class="fa fa-check"></i>
                    </CButton>
                </template>
            </CInput>
        </td>
        <td v-if="canUpdateContract">
            <button class="btn btn-sm btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
        </td>
    </tr>
</template>

<script>
export default {
    name: "DateTableRow",
    props: {
        date: {
            type: Object,
            required: true
        },
        canUpdateContract: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            dateValue: null
        }
    },
    computed: {
        selectedValue() {
            return this.date.value?.value
        },
        isDirty() {
            if (this.dateValue === null) {
                return false
            }
            return this.date.value?.value !== this.dateValue
        },
        buttonColor() {
            return this.isDirty ? 'warning' : 'success'
        },
        showButton() {
            return this.date.value === null || this.isDirty
        },
    },
    methods: {
        updateDateValue(value) {
            this.dateValue = value
        },
        updateDate() {
            this.$emit('update-date', {contract_date_id: this.date.id, value: this.dateValue})
            this.dateValue = null
        }
    }
}
</script>

<style>
input.warning {
    border-color: orange;
}

</style>

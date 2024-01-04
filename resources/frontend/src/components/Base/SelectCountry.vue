<template>
    <select name="country"
            class="form-control"
            @change="updateData"
            :required="required">
        <option :value="null">--- Please Select ---</option>
        <option v-for="country in countries"
                :key="country.value"
                :value="country.value"
                :selected="isSelected(country)"
        >{{ country.label }}
        </option>
    </select>
</template>

<script>
export default {
    name: "SelectCountry",
    props: {
        formData: {
            type: Object,
            required: true
        },
        formDataKey: {
            type: String,
            required: true
        },
        required: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            countries: [
                {
                    value: 'hong_kong',
                    label: 'Hong Kong'
                },
                {
                    value: 'indonesia',
                    label: 'Indonesia'
                },
                {
                    value: 'philippines',
                    label: 'Philippines'
                },
                {
                    value: 'taiwan',
                    label: 'Taiwan'
                },
                {
                    value: 'singapore',
                    label: 'Singapore'
                },
            ]
        }
    },
    methods: {
        updateData(e) {
            this.formData[this.formDataKey] = e.target.value
        },
        isSelected(country) {
            return country.value === this.formData[this.formDataKey]
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <select class="form-control"
            v-model="formData.current_state">
        <option :value="state"
                v-for="state in states[formData[countryKey]]"
                :key="state">
            {{ state }}
        </option>
    </select>
</template>

<script>

import {states} from "../../modules/Applicant/countries"

export default {
    name: "SelectCountryRegion",
    props: {
        formData: {
            type: Object,
            required: true
        },
        formDataKey: {
            type: String,
            required: true
        },
        countryKey: {
            type: String,
            required: true
        },
        required: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        states() {
            return states
        }
    },
}
</script>

<style scoped>

</style>

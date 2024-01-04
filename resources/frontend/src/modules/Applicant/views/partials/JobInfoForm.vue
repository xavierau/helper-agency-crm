<template>
    <section class="JobInfoForm row">
        <h5 class="col-12">Job Info</h5>
        <AvailableDate v-model="formData.date_of_release"/>
        <DutyPreferences size="col-12" v-model="formData.duties"/>
    </section>
</template>

<script>

import "vue-select/dist/vue-select.css"
import AvailableDate from "@/components/ApplicantForm/AvailableDate.vue";
import DutyPreferences from "@/components/ApplicantForm/DutyPreferences.vue";

export default {
    name: "JobInfoForm",
    props: {
        formData: {
            type: Object,
            required: true
        }
    },
    components: {
        AvailableDate,
        DutyPreferences
    }
}
</script>

<style scoped>

</style>

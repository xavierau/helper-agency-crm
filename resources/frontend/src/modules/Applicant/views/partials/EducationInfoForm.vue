<template>
    <section class="EducationInfoForm row">
        <h5 class="col-12">Education Info</h5>
        <HighestEducation size="col-6" v-model="formData.highest_education"/>
        <GraduationYear size="col-6" v-model.number="formData.graduation_year"/>
        <SchoolName size="col-6" v-model="formData.school_name"/>
        <Major size="col-6" v-model="formData.major"/>
    </section>
</template>

<script>
import endpoints from "@/modules/Applicant/endpoints"
import client from "@/client"
import HighestEducation from "@/components/ApplicantForm/HighestEducation.vue";
import GraduationYear from "@/components/ApplicantForm/GraduationYear.vue";
import SchoolName from "@/components/ApplicantForm/SchoolName.vue";
import Major from "@/components/ApplicantForm/Major.vue";

export default {
    name: "EducationInfoForm",
    components: {
        HighestEducation,
        GraduationYear,
        SchoolName,
        Major,
    },
    props: {
        formData: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            duties: []
        }
    },
    created() {
        this.fetchDuties()
    },
    methods: {
        fetchDuties() {
            client.get(endpoints.duties)
                .then(({data}) => this.duties = data)
                .catch(error => console.log(error))
        }
    }
}
</script>

<style scoped>

</style>

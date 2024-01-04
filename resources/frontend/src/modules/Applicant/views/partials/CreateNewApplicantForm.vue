<template>
    <form class="form">

        <BasicInfoForm class="m-1 p-1 border" :form-data.sync="formData"/>

        <identity-document-info-form class="m-1 p-1 border" :form-data.sync="formData"/>
        <family-info-form class="m-1 p-1 border" :form-data.sync="formData"/>
        <education-info-form class="m-1 p-1 border" :form-data.sync="formData"/>
        <JobInfoForm class="m-1 mb-3 p-1 border" :form-data.sync="formData"/>
        <HolidayArrangementForm class="m-1 mb-3 p-1 border" :form-data.sync="formData"/>
        <ApplicantQuestionsForm class="m-1 mb-3 p-1 border" :form-data.sync="formData.questions"/>
        <experience-info-form class="m-1 mb-3 p-1 border"
                              :form-data.sync="formData.experience"
                              @remove-experience="removeExperience"
                              @add-experience="addExperience"/>
    </form>
</template>

<script>
import BasicInfoForm from "@/modules/Applicant/views/partials/BasicInfoForm"
import FamilyInfoForm from "@/modules/Applicant/views/partials/FamilyInfoForm"
import JobInfoForm from "@/modules/Applicant/views/partials/JobInfoForm"
import ExperienceInfoForm from "@/modules/Applicant/views/partials/ExperienceInfoForm"
import EducationInfoForm from "@/modules/Applicant/views/partials/EducationInfoForm"
import IdentityDocumentInfoForm from "@/modules/Applicant/views/partials/IdentityDocumentInfoForm"
import HolidayArrangementForm from "@/modules/Applicant/views/partials/HolidayArrangementForm.vue";
import ApplicantQuestionsForm from "@/modules/Applicant/views/partials/ApplicantQuestionsForm.vue";

export default {
    name: "CreateNewApplicantForm",
    props: {
        formData: {
            type: Object,
            required: true
        }
    },
    watch: {
        formData: {
            immediate: true,
            deep: true,
            handler(newValue) {
                if (newValue?.current_country === 'hong_kong') {
                    this.formData.experience[0].current_country = 'hong_kong'
                }
            }
        },

    },
    components: {
        ApplicantQuestionsForm,
        HolidayArrangementForm,
        JobInfoForm,
        ExperienceInfoForm,
        BasicInfoForm,
        FamilyInfoForm,
        IdentityDocumentInfoForm,
        EducationInfoForm
    },
    methods: {
        addExperience(payload) {
            if (!Array.isArray(this.formData.experience)) {
                this.formData.experience = []
            }
            this.formData.experience.push(payload)
        },
        removeExperience(experience_uuid) {
            this.formData.experience = this.formData.experience.filter(e => e.uuid !== experience_uuid)
        }
    }
}
</script>

<style scoped>

</style>


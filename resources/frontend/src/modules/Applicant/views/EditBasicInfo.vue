<template>
    <div class="ApplicantEditPersonalInfo">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Edit applicant info: {{ applicant ? applicant.name : '' }}</h5>
            </CCardHeader>
            <CCardBody v-if="applicant">
                <FamilyInfoForm class="m-1 mb-3 p-1 border" :form-data="applicant.family"/>
                <EducationInfoForm class="m-1 mb-3 p-1 border" :form-data="applicant.education"/>
                <LanguageForm class="m-1 mb-3 p-1 border" :form-data="applicant"/>
                <JobInfoForm class="m-1 mb-3 p-1 border" :form-data.sync="applicant"/>
                <HolidayArrangementForm class="m-1 mb-1 p-1 border" :form-data.sync="applicant.holiday_arrangement"/>
                <ApplicantQuestionsForm class="m-1 mb-1 p-1 border" :form-data.sync="applicant.questions"/>
            </CCardBody>
            <CCardBody v-else>
                <h4>Loading...</h4>
            </CCardBody>

            <CCardFooter class="d-flex justify-content-between">
                <router-link :to="{name:RouteName.Applicant, params:{id:$route.params.id}}" class="btn btn-secondary">
                    Back
                </router-link>
                <button class="btn btn-primary" @click.prevent="updateApplicant">Save</button>
            </CCardFooter>
        </CCard>
    </div>
</template>

<script>

import client from "@/client";
import endpoints from "../endpoints";
import {RouteName} from "@/modules/Applicant/route";
import FamilyInfoForm from "@/modules/Applicant/views/partials/FamilyInfoForm.vue";
import EducationInfoForm from "@/modules/Applicant/views/partials/EducationInfoForm.vue";
import JobInfoForm from "@/modules/Applicant/views/partials/JobInfoForm.vue";
import HolidayArrangementForm from "@/modules/Applicant/views/partials/HolidayArrangementForm.vue";
import ApplicantQuestionsForm from "@/modules/Applicant/views/partials/ApplicantQuestionsForm.vue";
import LanguageForm from "@/modules/Applicant/views/partials/LanguageForm.vue";

export default {
    name: "ApplicantEditBasicInfo",
    components: {
        LanguageForm,
        ApplicantQuestionsForm,
        EducationInfoForm,
        FamilyInfoForm,
        HolidayArrangementForm,
        JobInfoForm,
    },
    computed: {
        RouteName() {
            return RouteName
        }
    },
    data() {
        return {
            applicant: null
        }
    },
    created() {
        client.get(endpoints.edit_personal_info(this.$route.params.id))
            .then(({data}) => this.applicant = data)
    },
    methods: {
        updateApplicant() {
            const url = endpoints.edit_basic_info(this.$route.params.id),
                data = this.applicant

            client.put(url, data)
                .then(() => this.$toasted.success('Successfully updated'))
                .then(() => this.$router.push({name: RouteName.Applicant, params: {id: this.$route.params.id}}))
                .catch(error => this.$toasted.error(error.message))

        }
    }
};
</script>

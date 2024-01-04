<template>
    <div class="ApplicantEditPersonalInfo">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Edit applicant personal info: {{ applicant ? applicant.name : '' }}</h5>

            </CCardHeader>
            <CCardBody v-if="applicant">
                <section class="row m-1 p-1 border ">
                    <ApplicantHKCode size="col-12 col-md-4" v-model="applicant.hk_code"/>
                    <ApplicantSupplier size="col-12 col-md-4" v-model.number="applicant.supplier_id"/>
                    <ApplicantPTCode size="col-12 col-md-4" v-model="applicant.pt_code"/>

                    <GivenName size="col-md-5" v-model="applicant.given_name"/>
                    <MiddleName size="col-md-2" v-model="applicant.middle_name"/>
                    <Surname size="col-md-5" v-model="applicant.surname"/>

                    <ApplicantDateOfBirth v-model="applicant.date_of_birth"/>
                    <ApplicantHeight v-model.number="applicant.height"/>
                    <ApplicantWeight v-model.number="applicant.weight"/>
                    <ApplicantMaritalStatus size="col-sm-6 col-md-4" v-model.number="applicant.marital_status"/>
                    <ApplicantGender size="col-sm-6 col-md-4" v-model.number="applicant.gender"/>
                    <ApplicantNationality size="col-sm-6 col-md-4" v-model.number="applicant.nationality"/>
                </section>

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
import ApplicantDateOfBirth from "@/components/ApplicantForm/DateOfBirth.vue";
import ApplicantGender from "@/components/ApplicantForm/Gender.vue";
import ApplicantHKCode from "@/components/ApplicantForm/HKCode.vue";
import ApplicantHeight from "@/components/ApplicantForm/Height.vue";
import ApplicantMaritalStatus from "@/components/ApplicantForm/MaritalStatus.vue";
import ApplicantNationality from "@/components/ApplicantForm/Nationality.vue";
import ApplicantPTCode from "@/components/ApplicantForm/PTCode.vue";
import ApplicantSupplier from "@/components/ApplicantForm/Supplier.vue";
import ApplicantWeight from "@/components/ApplicantForm/Weight.vue";
import GivenName from "@/components/ApplicantForm/GivenName.vue";
import MiddleName from "@/components/ApplicantForm/MiddleName.vue";
import Surname from "@/components/ApplicantForm/Surname.vue";

export default {
    name: "ApplicantEditPersonalInfo",
    components: {
        ApplicantDateOfBirth,
        ApplicantGender,
        ApplicantHKCode,
        ApplicantHeight,
        ApplicantMaritalStatus,
        ApplicantNationality,
        ApplicantPTCode,
        ApplicantSupplier,
        ApplicantWeight,
        GivenName,
        MiddleName,
        Surname,
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
            const url = endpoints.edit_personal_info(this.$route.params.id),
                data = this.applicant

            client.put(url, data)
                .then(() => this.$toasted.success('Successfully updated'))
                .then(() => this.$router.push({name: RouteName.Applicant, params: {id: this.$route.params.id}}))
                .catch(error => this.$toasted.error(error.message))

        }
    }
};
</script>

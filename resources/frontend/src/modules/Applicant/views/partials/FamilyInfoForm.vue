<template>
    <section class="BasicInform row">
        <h5 class="col-12">Family Info</h5>
        <ApplicationFatherAge v-model.number="formData.father_age"/>
        <ApplicationFatherOccupation v-model="formData.father_occupation"/>
        <ApplicationMotherAge v-model.number="formData.mother_age"/>
        <ApplicationMotherOccupation v-model="formData.mother_occupation"/>

        <NumberOfBrothers size="col-12 col-md-4" v-model.number="formData.number_of_brothers"/>
        <NumberOfSisters size="col-12 col-md-4" v-model.number="formData.number_of_sisters"/>
        <NumberInFamily size="col-12 col-md-4" v-model.number="formData.number_in_family"/>

        <SpouseName v-model="formData.spouse_name"/>
        <SpouseAge v-model.number="formData.spouse_age"/>
        <SpouseOccupation v-model="formData.spouse_occupation"/>

        <NumberOfSons v-model.number="formData.number_of_sons"></NumberOfSons>
        <AgeOfSons v-model="formData.age_of_sons"/>
        <NumberOfDaughters v-model.number="formData.numage_of_daughters"></NumberOfDaughters>
        <AgeOfDaughters v-model="formData.age_of_daughters"/>

    </section>
</template>

<script>
import endpoints from "@/modules/Applicant/endpoints"
import client from "@/client"

import ApplicationFatherAge from "@/components/ApplicantForm/FatherAge"
import ApplicationFatherOccupation from "@/components/ApplicantForm/FatherOccupation.vue"
import ApplicationMotherAge from "@/components/ApplicantForm/MotherAge"
import ApplicationMotherOccupation from "@/components/ApplicantForm/MotherOccupation.vue"
import NumberOfBrothers from "@/components/ApplicantForm/NumberOfBrothers.vue"
import NumberOfSisters from "@/components/ApplicantForm/NumberOfSisters.vue"
import NumberInFamily from "@/components/ApplicantForm/NumberInFamily.vue";

import SpouseName from "@/components/ApplicantForm/SpouseName.vue";
import SpouseAge from "@/components/ApplicantForm/SpouseAge.vue";
import SpouseOccupation from "@/components/ApplicantForm/SpouseOccupation.vue";
import NumberOfSons from "@/components/ApplicantForm/NumberOfSons.vue";
import AgeOfSons from "@/components/ApplicantForm/AgeOfSons.vue";
import AgeOfDaughters from "@/components/ApplicantForm/AgeOfDaughters.vue";
import NumberOfDaughters from "@/components/ApplicantForm/NumberOfDaughters.vue";

export default {
    name: "FamilyInfoForm",
    components: {
        ApplicationFatherAge,
        ApplicationFatherOccupation,
        ApplicationMotherAge,
        ApplicationMotherOccupation,
        NumberInFamily,
        NumberOfBrothers,
        NumberOfSisters,
        SpouseName,
        SpouseAge,
        SpouseOccupation,
        NumberOfSons,
        AgeOfSons,
        AgeOfDaughters,
        NumberOfDaughters,

    },
    props: {
        formData: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            nationalities: []
        }
    },
    created() {
        this.fetchNationalities()
    },
    methods: {
        fetchNationalities() {
            client.get(endpoints.nationalities)
                .then(({data}) => this.nationalities = data)
                .catch(error => console.log(error))
        }
    }
}
</script>

<style scoped>

</style>

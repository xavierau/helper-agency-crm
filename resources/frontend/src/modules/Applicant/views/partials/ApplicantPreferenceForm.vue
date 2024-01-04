<template>
    <section class="BasicInform row">
        <h5 class="col-12">Family Info</h5>
        <div class="form-group col-12">
            <label>Father Age</label>
            <input name="father_age"
                   class="form-control"
                   type="number"
                   min="0"
                   step="1"
                   v-model="formData.father_age"/>
        </div>
        <div class="form-group col-12">
            <label>Father Occupation</label>
            <input name="father_occupation"
                   autocomplete="true"
                   class="form-control"
                   type="text"
                   v-model="formData.father_occupation"/>
        </div>

        <div class="form-group col-12">
            <label>Mother Age</label>
            <input name="mother_age"
                   class="form-control"
                   type="number"
                   min="0"
                   step="1"
                   v-model="formData.mother_age"/>
        </div>
        <div class="form-group col-12">
            <label>Mother Occupation</label>
            <input name="mother_occupation"
                   autocomplete="true"
                   class="form-control"
                   type="text"
                   v-model="formData.mother_occupation"/>
        </div>

        <div class="form-group col-12">
            <label>Number of brothers</label>
            <input name="number_of_brothers"
                   class="form-control"
                   type="number"
                   min="0"
                   step="1"
                   v-model="formData.number_of_brothers"/>
        </div>
        <div class="form-group col-12">
            <label>Number of sisters</label>
            <input name="number_of_sisters"
                   class="form-control"
                   type="number"
                   min="0"
                   step="1"
                   v-model="formData.number_of_sisters"/>
        </div>
        <div class="form-group col-12">
            <label>Number in family</label>
            <input name="position_in_family"
                   class="form-control"
                   type="number"
                   min="0"
                   step="1"
                   v-model="formData.position_in_family"/>
        </div>

        <div class="form-group col-12">
            <label>Spouse Name</label>
            <input name="spouse_name" class="form-control" type="text"
                   v-model="formData.spouse_name"/>
        </div>
        <div class="form-group col-12">
            <label>Spouse Age</label>
            <input name="spouse_age" class="form-control" type="number" min="0" step="1"
                   v-model="formData.spouse_age"/>
        </div>
        <div class="form-group col-12">
            <label>Spouse Occupation</label>
            <input name="spouse_occupation"
                   autocomplete="true"
                   class="form-control"
                   type="text"
                   v-model="formData.spouse_occupation"/>
        </div>

        <div class="form-group col-12 ">
            <label>Number of sons</label>
            <input name="number_of_sons" class="form-control" type="number" min="0" step="1"
                   v-model="formData.number_of_sons"/>
        </div>
        <div class="form-group col-12 ">
            <label>Age of sons</label>
            <input name="age_of_sons" class="form-control" type="number" min="0" step="1"
                   v-model="formData.age_of_sons"/>
        </div>
        <div class="form-group col-12 ">
            <label>Number of daughters</label>
            <input class="form-control"
                   type="number" min="0" step="1"
                   v-model="formData.number_of_daughters"/>
        </div>
        <div class="form-group col-12 ">
            <label>Age of daughters</label>
            <input name="age_of_daughters"
                   class="form-control"
                   v-model="formData.age_of_daughters"/>
        </div>
    </section>
</template>

<script>
import endpoints from "@/modules/Applicant/endpoints"
import client from "@/client"

export default {
    name: "FamilyInfoForm",
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

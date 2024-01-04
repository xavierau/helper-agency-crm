<template>
    <div class="container mt-3">
        <h2>New Applicant Registration</h2>
        <CreateNewApplicantForm :form-data.sync="formData"/>
        <div class="form-group">
            <button class="btn btn-success"
                    @click="submit">Submit
            </button>
        </div>
    </div>
</template>

<script>
import CreateNewApplicantForm from "@/modules/Applicant/views/partials/CreateNewApplicantForm"
import client from "@/client";

let defalutFormdata = {
    name: null,
    date_of_birth: null,
    gender: 'female',
    nationality: null,
    available_date: null,
    phone: null,
    marital_status: null,
    height: null,
    weight: null,
    email: null,
    facebook: null,
    father_age: null,
    father_occupation: null,
    mother_age: null,
    mother_occupation: null,
    spouse_age: null,
    spouse_occupation: null,
    number_of_brothers: 0,
    number_of_sisters: 0,
    number_in_family: 1,
    number_of_sons: 0,
    age_of_sons: "",
    number_of_daughters: 0,
    age_of_daughters: "",
    duties: [],
    experience: [],
    english: '',
    cantonese: '',
    mandarin: '',
    other_language: '',
}

export default {
    name: "Register",
    components: {
        CreateNewApplicantForm
    },
    data() {
        return {
            formData: Object.assign({}, defalutFormdata)
        }
    },
    methods: {
        submit() {
            client.post('/api/agencycore/applicants/registration', this.formData)
                .then(({data}) => this.$toasted.success(data))
                .then(() => this.formData = Object.assign({}, defalutFormdata))
        }
    }
}
</script>

<style scoped>

</style>

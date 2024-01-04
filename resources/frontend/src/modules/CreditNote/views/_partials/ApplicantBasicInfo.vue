<template>

    <div class="ApplicantBasicInfo">
        <div>
            Applicant Name: <strong>{{
                applicant.name
            }}</strong>
        </div>
        <div>
            Gender: <strong>{{
                applicant.gender
            }}</strong>
        </div>
        <div>
            Age: <strong>{{
                applicant.age
            }}</strong>
        </div>
        <div>
            Nationality: <strong>{{
                applicant.nationality
            }}</strong>
        </div>
        <div>
            <router-link :to="{name:'Applicant',params:{id:applicant.id}}"
                         class="btn btn-info bnt-sm">Detail
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "ApplicantBasicInfo",
    props: {
        applicant: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>

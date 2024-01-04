<template>
    <div class="ApplicantSearchItem">
        <CCard>
            <CCardBody>
                <div class="row">
                    <div class="col-4">
                        <img :src="applicant.thumbnail" alt="" class="img-fluid">
                    </div>
                    <div class="col-8">
                        <p>Ref #: {{ applicant.ref_number }}</p>
                        <p>Age: {{ applicant.age }}</p>
                        <p>Gender: {{ applicant.is_male ? 'Male' : 'Female' }}</p>
                    </div>
                </div>
            </CCardBody>
            <CCardFooter>
                <a :href="`/core/applicants/profile/${applicant.hash}`" target="_blank"
                   class="btn btn-primary">Profile</a>
            </CCardFooter>
        </CCard>

    </div>
</template>

<script>
export default {
    name: "ApplicantSearchItem",
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

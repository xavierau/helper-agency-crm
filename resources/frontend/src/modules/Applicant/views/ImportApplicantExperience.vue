<template>
    <div class="ImportApplicantExperience container mt-3">
        <div class="form-group">
            <label for="">Import Applicant Experience</label>
            <Dropzone :url="url" @success="uploadSuccess"></Dropzone>
        </div>
    </div>
</template>

<script>

import Dropzone from "@/components/Base/Dropzone.vue";
import {RouteName} from "@/modules/Applicant/route";

export default {
    name: "ImportApplicantExperience",
    components: {Dropzone},
    computed: {
        url() {
            return '/api/agencycore/applicants/experience/import';
        }
    },
    methods: {
        uploadSuccess() {
            this.$toasted.success('Upload Completed')
            this.$router.push({name: RouteName.Applicants})
        }
    }
}
</script>

<style scoped>

</style>

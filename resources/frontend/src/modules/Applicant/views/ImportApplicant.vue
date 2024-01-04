<template>
    <div class="ImportApplicant container mt-3">
        <div class="form-group">
            <label for="">Import Applicant</label>
            <Dropzone :url="url" @success="uploadSuccess"></Dropzone>
        </div>
    </div>
</template>

<script>

import Dropzone from "@/components/Base/Dropzone.vue";
import {RouteName} from "@/modules/Applicant/route";

export default {
    name: "ImportApplicant",
    components: {Dropzone},
    computed: {
        url() {
            return '/api/agencycore/applicants/import';
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

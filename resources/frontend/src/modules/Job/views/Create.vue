<template>
    <div class="JobIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">All Jobs</h5>
            </CCardHeader>
            <CCardBody>
                <CreateNewForm/>
            </CCardBody>
        </CCard>
    </div>
</template>

<script>

import CreateNewForm from "@/modules/Job/partials/CreateNewForm.vue";

export default {
    name: "JobCreate",
    components: {CreateNewForm},

}
</script>

<style scoped>

</style>

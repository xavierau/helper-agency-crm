<template>
<CCard class="JobItem">
    <CCardHeader>
        <h5>Type: <router-link :to="{name:'Job',params:{id:job.id}}">{{ job.service_type }} <small> ({{
                job.status
                                                                                                    }})</small></router-link> </h5>
    </CCardHeader>
    <CCardBody>
        <p v-if="job.service_type === 'people'">
            <span class="badge badge-info p-1 m-1" v-for="duty in job.duties"
                  :key="duty.id">
                {{ duty.label }}
            </span>
        </p>
        <p v-else>
            <span class="badge badge-info p-1 m-1" v-for="service in job.services"
                  :key="service">
                {{ service }}
            </span>
        </p>
        <p>Note: {{ job.note }}</p>
    </CCardBody>

</CCard>
</template>

<script>
export default {
    name : "JobItem",
    props: {
        job: {
            type    : Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>

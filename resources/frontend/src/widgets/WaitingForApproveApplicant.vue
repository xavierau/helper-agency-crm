<template>
    <CWidgetDropdown color="primary"
                     :header="numbers"
                     text="Pending approval applicants">
        <template #default>
            <router-link :to="{name:'Applicants',query:{'is_approved':0}}" href="#"
                         class="btn btn-info btn-sm ">
                Go
            </router-link>
        </template>
        <template #footer>
            <CChartLineSimple
                pointed
                class="mt-3 mx-3"
                style="height:70px"
                :data-points="[65, 59, 84, 84, 51, 55, 40]"
                point-hover-background-color="primary"
                label="Members"
                labels="months"
            />
        </template>
    </CWidgetDropdown>
</template>

<script>
import CChartLineSimple from "@/views/charts/CChartLineSimple";
import endpoints from '@/aggregate_endpoints'
import client from "@/client";

export default {
    name: "WaitingForApproveApplicant",
    components: {CChartLineSimple},
    data() {
        return {
            numbers: 'Loading...'
        }
    },
    created() {
        client.get(endpoints.applicant.pending_for_approval)
            .then(({data}) => this.numbers = data.toString())
    }
}
</script>

<style scoped>

</style>

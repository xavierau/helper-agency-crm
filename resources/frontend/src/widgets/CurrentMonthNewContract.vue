<template>
    <CWidgetDropdown color="success"
                     :header="numbers"
                     text="Current Month New Contract">
        <template #footer>
            <CChartLineSimple
                pointed
                class="mt-3 mx-3"
                style="height:70px"
                :data-points="[65, 59, 84, 84, 51, 55, 40]"
                point-hover-background-color="success"
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
import {formatCurrency} from '@/filters/common'

export default {
    name: "CurrentMonthNewContract",
    components: {CChartLineSimple},
    filters: {formatCurrency},
    data() {
        return {
            numbers: 'Loading...'
        }
    },
    created() {
        client.get(endpoints.contract.current_month_total_new)
            .then(({data}) => this.numbers = data.toString())
    }
}
</script>

<style scoped>

</style>

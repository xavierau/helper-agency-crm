<template>
    <CWidgetDropdown color="info"
                     :header="numbers|formatCurrency"
                     text="Current Month Total Payment">
        <template #footer>
            <CChartLineSimple
                v-if="dataset"
                pointed
                class="mt-3 mx-3"
                style="height:70px"
                :data-points="dataPoints"
                point-hover-background-color="info"
                label="Amount"
                :labels="labels"
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
    name: "CurrentMonthTotalPayment",
    components: {CChartLineSimple},
    filters: {formatCurrency},
    data() {
        return {
            numbers: 'Loading...',
            dataset: null,
        }
    },
    computed: {
        labels() {
            return this.dataset?.months || []
        },
        dataPoints() {
            return this.dataset?.data_points || []
        },
    },
    created() {
        client.get(endpoints.payment.current_month_total)
            .then(({data}) => this.numbers = data.toString())
        client.get(endpoints.payment.current_month_total_dataset)
            .then(({data}) => this.dataset = data)
    }
}
</script>

<style scoped>

</style>

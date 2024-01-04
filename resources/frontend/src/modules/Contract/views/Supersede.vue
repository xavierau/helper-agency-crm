<template>
    <div class="InvoiceIndex">
        <CCard>
            <CCardHeader class="d-flex justify-content-between align-content-center">
                <h5 class="m-0">Supersede Invoice</h5>
            </CCardHeader>
            <CCardBody>

             </CCardBody>
        </CCard>
    </div>
</template>
<script>
import client from "@/client"
import endpoints from "@/modules/Contract/endpoints"

export default {
    name   : "Supersede",
    created() {
        this.fetchContract()
    },
    methods: {
        fetchContract() {
            client.get(endpoints.show(this.$route.params.id))
        }
    }
}
</script>

<style scoped>

</style>

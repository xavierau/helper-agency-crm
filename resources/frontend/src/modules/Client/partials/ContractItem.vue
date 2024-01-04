<template>
    <CCard class="ContractItem">
        <CCardHeader>
            <router-link :to="{name:'Contract',params:{id:contract.id}}">{{
                    contract.contract_number
                                                                         }} ({{
                    contract.status
                                                                         }})
            </router-link>
        </CCardHeader>
        <CCardBody>
            <p>Applicant: <router-link
                :to="{name:'Applicant',params:{id:contract.applicant_id}}">
            {{ contract.applicant.name }}
            </router-link>
            </p>
             <p>Start Date: {{ contract.start_date }}</p>
                <p>End Date: {{ contract.end_date }}</p>
        </CCardBody>
    </CCard>
</template>

<script>
export default {
    name : "ContractItem",
    props: {
        contract: {
            type    : Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <div class="ShowContracts">
         <ul v-if="contracts.length > 0" class="list-unstyled col-12">
            <li v-for="contract in contracts" :key="contract.id">
                <h5>Contract Number: <router-link
                    :to="{name:'Contract',params:{id:contract.id}}">{{
                        contract.contract_number
                                                                    }}</router-link></h5>
                <div class="row">
                    <div class="col-6">
                        Status: {{ contract.status }}
                        <br>
                        Client: <router-link :to="{name:'Client', params:{id:contract.client.id}}">{{
                            contract.client.full_name
                                                                                                   }}</router-link>
                    </div>
                    <div class="col-6">
                        <div>Start Date: {{ contract.start_date }}</div>
                        <div>Start Date: {{ contract.end_date }}</div>
                    </div>
                </div>
                <hr />
            </li>
        </ul>
        <p v-else>No contract with this applicant</p>
    </div>
</template>

<script>
export default {
    name : "ShowContracts",
    props: {
        contracts: {
            type    : Array,
            required: true
        }
    }
}
</script>

<style scoped>

</style>

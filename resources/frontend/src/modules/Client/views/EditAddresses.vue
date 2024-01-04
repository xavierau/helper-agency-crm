<template>
    <div class="EditAddresses">
        <CCard>
            <CCardHeader>
                Client Address
                <button class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add</button>
            </CCardHeader>
            <CCardBody>
                <div v-for="address in data" :key="address.id">
                    <CButton
                        @click="collapse = !collapse"
                        color="info"
                        class="mb-2 btn-block"
                    >
                        {{ address.address_1 }},{{ address.address_2 }},{{ address.address_3 }}
                    </CButton>
                    <CCollapse :show="collapse">
                        <CCard body-wrapper>
                            <form @submit.prevent="updateAddress(address)">
                                <div class="form-group">
                                    <label class="label">Room and Building</label>
                                    <input class="form-control" v-model="address.address_1">
                                </div>
                                <div class="form-group">
                                    <label class="label">Street</label>
                                    <input class="form-control" v-model="address.address_2">
                                </div>
                                <div class="form-group">
                                    <label class="label">District</label>
                                    <HKRegionSelect v-model="address.address_3"/>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success bnt-sm">Update</button>
                                </div>
                            </form>
                        </CCard>
                    </CCollapse>
                </div>
            </CCardBody>
        </CCard>


    </div>
</template>

<script>
import client from "@/client";
import endpoints from '../endpoints'
import HKRegionSelect from "@/components/HKRegionSelect";

export default {
    name: "EditAddresses",
    components: {
        HKRegionSelect
    },
    data() {
        return {
            data: [],
            collapse: false
        }
    },
    created() {
        client.get(endpoints.client_addresses(this.$route.params.id))
            .then(({data}) => this.data = data)
    },
    methods: {
        updateAddress(address) {
            client.put(endpoints.update_address(this.$route.params.id, address.id), address)
                .then(({data}) => this.$toasted.success('Address updated'))
        }
    }
}
</script>

<style scoped>

</style>

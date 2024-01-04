<template>
    <div class="SelectContractAddress">
        <h4>Address
            <button v-if="canUpdateContract"
                    @click="showModal = true"
                    class="btn btn-sm btn-success">
                <i class="fa fa-plus"></i>
            </button>
        </h4>
        <v-select :disabled="!canUpdateContract"
                  :options="availableAddresses"
                  labe="label"
                  @input="$emit('address-changed')"
                  v-model="contract.address"></v-select>

        <CModal
            title="Add Address"
            color="success"
            size="xl"
            :show.sync="showModal">
            <div class="form-group">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Address 1</label>
                            <input type="text" class="form-control" v-model="new_address.address_1" required>
                        </div>
                        <div class="form-group">
                            <label>Address 2</label>
                            <input type="text" class="form-control" v-model="new_address.address_2" required>
                        </div>
                        <div class="form-group">
                            <label>Address 3</label>
                            <input type="text" class="form-control" v-model="new_address.address_3" required>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" v-model="new_address.country" required>
                        </div>
                    </div>
                </div>
            </div>
            <template #footer>
                <button @click="showModal=false"
                        class="btn btn-sm btn-secondary">Close
                </button>
                <button @click="createNewAddress" class="btn btn-sm btn-success">Create</button>
            </template>
        </CModal>
    </div>
</template>

<script>
import client from "@/client";
import endpoints from "@/modules/Contract/endpoints";
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'

export default {
    name: "SelectContractAddress",
    props: {
        contract: {
            type: Object,
            required: true
        },
        canUpdateContract: {
            type: Boolean,
            require: true
        },
    },
    components: {
        vSelect
    },
    data() {
        return {
            showModal: false,
            new_address: {
                address_1: null,
                address_2: null,
                address_3: null,
                country: 'Hong Kong',
            }
        }
    },
    computed: {
        availableAddresses() {
            return this.contract.client.account.addresses.map(a => {
                a['label'] = `${a.address_1}, ${a.address_2 ? a.address_2 + "," : ''} ${a.address_3 ? a.address_3 + "," : ''} ${a.country},`
                return a
            })
        }
    },
    methods: {
        createNewAddress() {
            client.post(endpoints.add_address(this.contract.id), this.new_address)
                .then(({data}) => this.contract.client.account.addresses.push(data))
                .then(() => this.showModal = false)
                .then(() => this.new_address = {
                    address_1: null,
                    address_2: null,
                    address_3: null,
                    country: 'Hong Kong',
                })
                .then(() => this.$toasted.success("Address added"))
        },
    }
}
</script>

<style scoped>

</style>

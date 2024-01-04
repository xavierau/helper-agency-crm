<template>
    <div class="Trail">
        <h4>Total Net Invoiced Amount <strong> {{ netInvoiceAmount | formatCurrency }}</strong></h4>
        <div class="item-container" v-for="(item,index) in trail" :key="index">
            <div class="item">
                Invoice Number: {{ item.invoice_number }}
                <br>
                Invoice Net Amount: {{ item.total | formatCurrency }}
                <br>
                Created At: {{ item.created_at }}
            </div>
            <span class="pointer d-block text-center"><i class="fas fa-chevron-up"></i></span>
        </div>
    </div>
</template>

<script>
import client from "@/client"
import endpoints from "@/modules/Invoice/endpoints"
import {formatCurrency} from "@/filters/common"
import _ from 'lodash'

export default {
    name: "Trail",
    data() {
        return {
            trail: null,
        }
    },
    computed: {
        netInvoiceAmount() {
            if (this.trail === null) {
                return 0
            }
            return _.reduce(this.trail, (carry, i) => carry + i.total, 0)
        }
    },
    filters: {
        formatCurrency
    },
    created() {
        this.fetchTrail()
    },
    methods: {
        fetchTrail() {
            client.get(endpoints.trail(this.$route.params.id))
                .then(({data}) => this.trail = data)
                .catch(error => this.$toasted.error('Cannot fetch trail'))
        }
    }
}
</script>

<style scoped>
.item {
    border: 1px solid lightgrey;
    border-radius: 5px;
    padding: 15px
}

.item .pointer {
    width: 100%;
    height: 30px;
}

.pointer:last-child {
    display: none
}

</style>

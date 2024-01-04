<template>
    <div class="Trail" v-if="trail">
        <h4>Total Invoiced Amount <strong> {{ netInvoiceAmount | formatCurrency }}</strong></h4>
        <h4>Total Paid Amount <strong> {{ trail.total_payment | formatCurrency }}</strong></h4>
        <h4>Remaining Amount <strong> {{ netInvoiceAmount - trail.total_payment | formatCurrency }}</strong></h4>
        <div class="item-container " v-for="(item,index) in trail.invoices" :key="index">
            <div class="item bg-white">
                Client name:
                <router-link
                    :to="{name:'Client',params:{id:item.client.id}}">{{ item.client.name }}
                </router-link>
                <br>
                Invoice Number:
                <router-link
                    :to="{name:'Invoice',params:{id:item.id}}">{{ item.invoice_number }}
                </router-link>
                <br>
                Contract Number:
                <router-link
                    :to="{name:'Contract',params:{id:item.contract.id}}">{{ item.contract.contract_number }}
                </router-link>
                <br>
                Invoice Net Amount: {{ item.total | formatCurrency }}
                <br>
                Created At: {{ item.created_at | formatDate('D/M/Y HH:MM') }}

                <br/>
                <strong>Payments</strong>
                <ul class="list-unstyled">
                    <li v-for="payment in item.payments" :ke="payment.id">
                        Payment Amount: {{ payment.amount | formatCurrency }}
                        <br>
                        Payment type: {{ payment.type }}
                        <br>
                        Date: {{ payment.created_at | formatDate('D/M/Y HH:MM') }}
                        <br>
                        Note: {{ payment.note }}
                        <br>
                        Attachment: <a v-if="payment.attachment"
                                       target="_blank"
                                       :href="payment.attachment">Show attachment</a>
                        <span v-else>No Attachment</span>
                    </li>
                </ul>
            </div>
            <span class="pointer d-block text-center"><i class="fas fa-chevron-up"></i></span>
        </div>
    </div>
</template>

<script>
import client from "@/client"
import endpoints from "@/modules/Invoice/endpoints"
import {formatCurrency, formatDate} from "@/filters/common"

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


            return this.trail.invoices[0].total
        },
        totalPaidAmount() {
            if (this.trail === null) {
                return 0
            }

            return this.trail.map(i => i.payments).flat().reduce((carry, p) => carry + p.amount, 0)
        }
    },
    filters: {
        formatCurrency,
        formatDate
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
    border: 1px solid grey;
    border-radius: 5px;
    padding: 15px
}

.pointer {
    width: 100%;
    height: 30px;
}

.item-container:last-child .pointer i.fas {
    display: none
}

ul {
    padding: 10px
}

li {
    margin: 5px;
    padding: 10px;
    border: 1px solid navy;
    border-radius: 5px;
}

</style>

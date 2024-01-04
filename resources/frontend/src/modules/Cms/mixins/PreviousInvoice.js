export default {
    computed: {
        previousPaymentsSummary() {
            return this.getPayments().reduce((carry, p) => {
                carry = carry + `${p.amount} ${p.created_at}\n`
                return carry;
            }, "\n")
        },
        previousPaymentsTotal() {
            return this.getPayments().reduce((carry, p) => {
                carry = carry + p.amount
                return carry;
            }, 0)
        }
    },
    methods: {
        getPayments(invoice = null, payments = []) {

            invoice = invoice || this.previousInvoice

            if (invoice) {
                payments = payments.concat(invoice.payments)
                if (invoice.previousInvoice) {
                    this.getPayments(invoice.previousInvoice, payments)
                }
            }

            return payments;
        },
    }
}

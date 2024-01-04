/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    list  : '/api/agencyfinance/payments',
    store : '/api/agencyfinance/payments',
    show  : payment_id => `/api/agencyfinance/payments/${payment_id}`,
    update: payment_id => `/api/agencyfinance/payments/${payment_id}`,
}


export default endpoints

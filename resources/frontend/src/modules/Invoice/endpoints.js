/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    list     : '/api/agencyfinance/invoices',
    store    : '/api/agencyfinance/invoices',
    show     : invoice_id => `/api/agencyfinance/invoices/${invoice_id}`,
    update   : invoice_id => `/api/agencyfinance/invoices/${invoice_id}`,
    supersede: invoice_id => `/api/agencyfinance/invoices/${invoice_id}/supersede`,
    trail: invoice_id => `/api/agencyfinance/invoices/${invoice_id}/trail`,
}


export default endpoints

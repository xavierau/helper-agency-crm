/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    applicant: {
        pending_for_approval: '/api/aggregates/applicants/pending_approval',
    },
    payment: {
        current_month_total: '/api/agencyfinance/metrics/current_month_total',
        current_month_total_dataset: '/api/agencyfinance/metrics/current_month_total_dataset',
    },
    contract: {
        current_month_total_new: '/api/agencycontract/metrics/current_month_new',
    },
}

export default endpoints

/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    list: '/api/agencycontractdate/contract_dates',
    store: '/api/agencycontractdate/contract_dates',
    update: contract_date_id => `/api/agencycontractdate/contract_dates/${contract_date_id}`,
    destroy: contract_date_id => `/api/agencycontractdate/contract_dates/${contract_date_id}`,
}

export default endpoints

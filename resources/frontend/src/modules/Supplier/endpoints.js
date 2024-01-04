/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    list: '/api/agencycore/suppliers',
    store: '/api/agencycore/suppliers',
    edit: supplier_id => `/api/agencycore/suppliers/${supplier_id}`,
}

export default endpoints

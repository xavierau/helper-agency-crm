/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    list: '/api/agencycore/clients',
    show: client_id => `/api/agencycore/clients/${client_id}`,
    new_job: client_id => `/api/agencycore/clients/${client_id}/jobs`,
    duties: '/api/agencycore/duties/all',
    personalities: '/api/agencycore/personalities',
    new_client_and_job: '/api/agencycore/new_client_and_job',
    client_addresses: client_id => `/api/agencycore/clients/${client_id}/addresses`,
    update_address: (client_id, address_id) => `/api/agencycore/clients/${client_id}/addresses/${address_id}`,
}

export default endpoints

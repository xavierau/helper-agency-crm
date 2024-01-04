/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    all: '/api/agencycore/duties/all',
    list: '/api/agencycore/duties',
    store: '/api/agencycore/duties',
    update: duty_id => `/api/agencycore/duties/${duty_id}`,
    delete: duty_id => `/api/agencycore/duties/${duty_id}`
}


export default endpoints

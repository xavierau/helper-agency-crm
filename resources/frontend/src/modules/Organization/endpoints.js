/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    list: `/api/organizations`,
    store: `/api/organizations`,
    update: organization_id => `/api/organizations/${organization_id}`,
    delete: organization_id => `/api/organizations/${organization_id}`,
}


export default endpoints

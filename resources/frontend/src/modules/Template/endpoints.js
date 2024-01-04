/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    list: '/api/agencytemplate/templates',
    store: '/api/agencytemplate/templates',
    update: (template_id) => `/api/agencytemplate/templates/${template_id}`,
    show: (template_id) => `/api/agencytemplate/templates/${template_id}`,
    delete: (template_id) => `/api/agencytemplate/templates/${template_id}`,
    get_template_content: (template_id) => `/api/agencytemplate/templates/${template_id}/content`,
}

export default endpoints

/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    list: '/api/agencycontract/contract_types',
    show: contract_type_id => `/api/agencycontract/contract_types/${contract_type_id}`,
    store: '/api/agencycontract/contract_types',
    all_dates: '/api/agencycontractdate/all_dates',
    assign: '/api/agencycontractdate/assign',
    ordering: `/api/agencycontractdate/ordering`,
    all_docs: '/api/agencycontractdoc/all_docs',
    assign_doc: '/api/agencycontractdoc/assign',
    ordering_doc: `/api/agencycontractdoc/ordering`,
    all_templates: `/api/agencytemplate/templates/all`,
    assign_templates: contract_type_id => `/api/agencytemplate/templates/contract_types/${contract_type_id}`,
    remove_templates: (contract_type_id, template_id) => `/api/agencytemplate/templates/${template_id}/contract_types/${contract_type_id}`,
}

export default endpoints


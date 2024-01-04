/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    list: '/api/agencycontractdoc/contract_docs',
    store: '/api/agencycontractdoc/contract_docs',
    update: contract_doc_id => `/api/agencycontractdoc/contract_docs/${contract_doc_id}`,
    destroy: contract_doc_id => `/api/agencycontractdoc/contract_docs/${contract_doc_id}`,
}

export default endpoints

/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    list: '/api/agencycontract/contracts',
    store: '/api/agencycontract/contracts',
    transition: (contract_id, transition_id) => `/api/agencycontract/contracts/${contract_id}/transitions/${transition_id}`,
    supersede: (contract_id) => `/api/agencycontract/contracts/${contract_id}/supersede`,
    show: (contract_id) => `/api/agencycontract/contracts/${contract_id}`,
    update: contract_id => `/api/agencycontract/contracts/${contract_id}`,
    client: (contract_id) => `/api/agencycore/client/${contract_id}/contracts/`,
    create_new_resident: client_id => `/api/agencycore/clients/${client_id}/relatives`,
    add_residents: contract_id => `/api/agencycontract/contracts/${contract_id}/add_residents`,
    add_new_resident: contract_id => `/api/agencycontract/contracts/${contract_id}/add_new_residents`,
    remove_residents: (contract_id, client_id) => `/api/agencycontract/contracts/${contract_id}/remove_residents/${client_id}`,
    add_address: contract_id => `/api/agencycontract/contracts/${contract_id}/add_address`,
    contract_dates: contract_type_id => `/api/agencycontractdates/contract_types/${contract_type_id}`,
    add_contract_date: contract_id => `/api/agencycontract/contracts/${contract_id}/dates/`,
    update_contract_date: contract_id => `/api/agencycontract/contracts/${contract_id}/dates/`,
    add_contract_document: contract_id => `/api/agencycontract/contracts/${contract_id}/documents/`,
    update_contract_document: contract_id => `/api/agencycontract/contracts/${contract_id}/documents/upload`,
    remove_contract_document: (contract_id, document_id) => `/api/agencycontract/contracts/${contract_id}/documents/${document_id}`,
    update_requirement: contract_id => `/api/agencycontract/contracts/${contract_id}/requirement`,
    expiring_contract: `/api/agencycontract/widgets/expiring_contract`,
    uploaded_documents: contract_id => `/api/agencycontract/contracts/${contract_id}/uploaded_documents`,
    store_uploaded_documents: contract_id => `/api/agencycontract/contracts/${contract_id}/uploaded_documents`,
    show_uploaded_documents: (contract_id, document_id) => `/api/agencycontract/contracts/${contract_id}/uploaded_documents/${document_id}`,
    update_uploaded_documents: (contract_id, document_id) => `/api/agencycontract/contracts/${contract_id}/uploaded_documents/${document_id}`,
    delete_uploaded_documents: (contract_id, document_id) => `/api/agencycontract/contracts/${contract_id}/uploaded_documents/${document_id}`,
}

export default endpoints

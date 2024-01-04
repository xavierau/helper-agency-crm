/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    public_search_applicants: '/api/agencycore/public_search_applicants',
    list: '/api/agencycore/applicants',
    count_by_current_location: '/api/agencycore/applicants/count/current_location',
    store: '/api/agencycore/applicants',
    delete: applicant_id => `/api/agencycore/applicants/${applicant_id}`,
    show: applicant_id => `/api/agencycore/applicants/${applicant_id}`,
    approve: applicant_id => `/api/agencycore/applicants/${applicant_id}/approve`,
    nationalities: '/api/agencycore/nationalities',
    duties: '/api/agencycore/duties/all',
    upload_thumbnail: applicant_id => `/api/agencycore/applicants/${applicant_id}/thumbnail`,
    upload_full_body: applicant_id => `/api/agencycore/applicants/${applicant_id}/full_body`,
    store_uploaded_documents: applicant_id => `/api/agencycore/applicants/${applicant_id}/uploaded_documents`,
    uploaded_documents: applicant_id => `/api/agencycore/applicants/${applicant_id}/uploaded_documents`,
    show_uploaded_documents: (applicant_id, document_id) => `/api/agencycore/applicants/${applicant_id}/uploaded_documents/${document_id}`,
    update_uploaded_documents: (applicant_id, document_id) => `/api/agencycore/applicants/${applicant_id}/uploaded_documents/${document_id}`,
    delete_uploaded_documents: (applicant_id, document_id) => `/api/agencycore/applicants/${applicant_id}/uploaded_documents/${document_id}`,

    edit_personal_info:(applicant_id)=>`/api/agencycore/applicants/${applicant_id}/edit_personal_info`,
    edit_basic_info:(applicant_id)=>`/api/agencycore/applicants/${applicant_id}/edit_basic_info`
}

export default endpoints

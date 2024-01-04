/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    list: '/api/agencycore/jobs',
    show: job_id => `/api/agencycore/jobs/${job_id}`,
    duties: `/api/agencycore/duties/all`,
    nationalities: `/api/agencycore/nationalities`,
    potential_applicants: `/api/agencycore/applicants/available`,
    all_assigned_applicants: job_id => `/api/agencycore/jobs/${job_id}/applicants/all`,
    assign_applicant: job_id => `/api/agencycore/jobs/${job_id}/applicants`,
    remove_applicant: (job_id, applicant_id) => `/api/agencycore/jobs/${job_id}/applicants/${applicant_id}`,
    email_applicant: (job_id) => `/api/agencycore/jobs/${job_id}/applicants/email`,
    update_requirement: job_id => `/api/agencycore/jobs/${job_id}/update_requirement`,
    comments: job_id => `/api/agencycore/jobs/${job_id}/comments`,
}


export default endpoints

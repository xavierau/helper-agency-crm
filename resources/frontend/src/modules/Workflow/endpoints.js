/**
 * Created by Xavier on 10/8/2020.
 */
const endpoints = {
    entities: '/api/agencycore/entities',
    list: '/api/workflows',
    store: '/api/workflows',
    assign_entity: workflow_id => `/api/workflows/${workflow_id}/entities`,
    show: workflow_id => `/api/workflows/${workflow_id}`,
    create_transition: workflow_id => `/api/workflows/${workflow_id}/transitions/`,
    update_transition: (workflow_id, transition_id) => `/api/workflows/${workflow_id}/transitions/${transition_id}`,
    delete_transition: (workflow_id, transition_id) => `/api/workflows/${workflow_id}/transitions/${transition_id}`,
    create_state: workflow_id => `/api/workflows/${workflow_id}/states/`,
    update_state: (workflow_id, state_id) => `/api/workflows/${workflow_id}/states/${state_id}`,
    delete_state: (workflow_id, state_id) => `/api/workflows/${workflow_id}/states/${state_id}`,
}

export default endpoints

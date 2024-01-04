import client from "@/client"
import Vue from "vue"
import endpoints from "@/modules/Template/endpoints"

export const template = {
    namespaced: true,
    state     : () => ({
        templates: []
    }),
    mutations : {
        setTemplates(state, templates) {
            state.templates = templates
        }
    },
    actions   : {
        fetchTemplates({commit}, params) {
            client.get(endpoints.list, params)
                  .then(({data}) => commit('setTemplates', data))
                  .catch(error => Vue.toasted.error('Cannot fetch templates! ' + error.message))
        }
    },
    getters   : {
        templates: state => state.templates
    }
}

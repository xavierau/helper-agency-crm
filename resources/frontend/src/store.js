import Vue from 'vue'
import Vuex from 'vuex'

import api from "@/api.js"

import _ from "lodash"

import client from "@/client"
import sellablesEndpoints from "@/modules/Sellable/endpoints.js"

import {template} from '@/modules/Template/store/store.js'

Vue.use(Vuex)

const state = {
    sidebarShow: 'responsive',
    sidebarMinimize: true,
    user: null,
    sellables: null
}

const mutations = {
    setUser(state, user) {
        state.user = user
    },
    toggleSidebarDesktop(state) {
        const sidebarOpened = [true, 'responsive'].includes(state.sidebarShow)
        state.sidebarShow = sidebarOpened ? false : 'responsive'
    },
    toggleSidebarMobile(state) {
        const sidebarClosed = [false, 'responsive'].includes(state.sidebarShow)
        state.sidebarShow = sidebarClosed ? true : 'responsive'
    },
    setSellables(state, sellables) {
        state.sellables = sellables
    },
    set(state, [variable, value]) {
        state[variable] = value
    }
}
const actions = {
    refreshSellables(context) {
        return client.get(sellablesEndpoints.all)
            .then(data => context.commit('setSellables', data))
            .catch(error => Vue.$toasted.error('Cannot fetch sellables', error.message))
    }
}

const getters = {
    isLogin: () => api.isLogin(),
    user: state => state.user,
    sellables: state => state.sellables,
    permissions: state => state.user ? _.chain(state.user.roles)
            .map(r => r.permissions)
            .flatten()
            .uniq()
            .value()
        : [],
    can: (state) => (permission_name, attrs = {}) => {
        // TODO: fix front end permissions
        return true

        return state.user === null ? false : !!_.chain(state.user.roles)
            .map(r => r.permissions)
            .flatten()
            .uniq()
            .find({name: permission_name})
            .value()

    }
}

export default new Vuex.Store({
    modules: {
        template: template
    },
    state,
    getters,
    mutations
})

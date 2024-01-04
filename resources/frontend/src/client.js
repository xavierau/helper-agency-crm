/**
 * Created by Xavier on 2/8/2020.
 */

import axios from 'axios'
import Vue from 'vue'

function getErrorMessage(error) {

    let message = "Something wrong! Try again later!"

    switch (error.response.status) {
        case 422:
            Object.keys(error.response.data.errors)
                .reduce((msg, key) => error.response.data.errors[key]
                        .map(m => `${msg}<br/>${m}`),
                    '')
            Vue.toasted.error(message, {duration: 5000})
            break
        default:
            Vue.toasted.error(message, {duration: 5000})

    }
    console.error(error.message, error)

    throw error
}

class client {
    constructor() {
        this.instance = axios.create()
        this.instance.defaults.withCredentials = true
    }

    get(url, config) {
        return this.instance.get(url, config)
            .catch(getErrorMessage)
    }

    post(url, data, config) {
        return this.instance.post(url, data, config)
            .catch(getErrorMessage)
    }

    put(url, data, config) {
        return this.instance.put(url, data, config)
            .catch(getErrorMessage)
    }

    delete(url, config) {
        return this.instance.delete(url, config)
            .catch(getErrorMessage)
    }

    all(requests) {
        return axios.all(requests)
    }
}

export default new client()

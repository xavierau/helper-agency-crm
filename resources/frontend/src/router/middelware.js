import store from "@/store";
import Vue from "vue";

export const hasPermission = (permission, message, routeName, params = {}) => {
    return (to, from, next) => {
        if (store.getters.can(permission)) {
            next()
        } else {
            Vue.toasted.error(message)
            next({name: routeName})
        }
    }
}

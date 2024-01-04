import 'core-js/stable'
import Vue from 'vue'
import App from './App'
import router from './router'
import CoreuiVue from '@coreui/vue'
import {iconsSet as icons} from './assets/icons/icons.js'
import store from './store'
import Sortable from 'vue-sortable'
import Toasted from 'vue-toasted'
//importing whole set
import "@fortawesome/fontawesome-free/css/all.css"

import CKEditor from "@ckeditor/ckeditor5-vue2"


Vue.config.performance = true
Vue.use(CoreuiVue)
Vue.use(Sortable)
Vue.use(CKEditor)
const toastOptions = {
    duration: 2000
}
Vue.use(Toasted, toastOptions)
Vue.prototype.$log = console.log.bind(console)

new Vue({
    el: '#app',
    router,
    store,
    icons,
    template: '<App/>',
    components: {
        App
    }
})

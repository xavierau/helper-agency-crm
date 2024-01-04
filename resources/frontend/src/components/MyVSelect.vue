<template>
    <v-select :options="options"
              :label="label"
              v-model="inputVal"
              :reduce="reduce"
              :disabled="disabled"
              @input="emitInput"
              @search="fetchOptions">
        <template v-for="(_, name) in $scopedSlots" :slot="name" slot-scope="slotData">
            <slot
                :name="name" v-bind="slotData"/>
        </template>
    </v-select>
</template>

<script>
import vSelect from 'vue-select'
import _ from "lodash"

require('vue-select/dist/vue-select.css')

export default {
    name: "MyVSelect",
    props: {
        reduce: {
            type: Function
        },
        value: {
            default: ''
        },
        disabled: {
            type: Boolean,
            default: false
        },
        options: {
            type: Array,
            default() {
                return []
            }
        },
        label: {
            type: String,
            required: true
        },
        searchFunc: {
            type: Function
        }
    },
    components: {
        vSelect
    },
    computed: {
        inputVal: {
            get() {
                return this.value;
            },
            set(val) {
                this.$emit('input', val);
            }
        }
    },
    methods: {
        emitInput(val) {
            console.log('input in my-v-select', val)
            this.inputVal = val
            this.$emit('input', val)
        },
        fetchOptions(keyword, loading) {
            loading(true)
            this.throttledMethod(this, keyword, loading);
        },
        throttledMethod: _.debounce((vm, keyword, loading) => {
            if (vm.searchFunc) {
                vm.searchFunc(keyword)
                    .then(() => loading(false))
            } else {
                loading(false)
            }

        }, 200)
    }
}
</script>

<style scoped>

</style>

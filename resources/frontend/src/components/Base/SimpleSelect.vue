<template>
    <div class="SimpleSelect form-group" :class="size">
        <label>{{ label }}</label>
        <select name="english"
                class="form-control"
                :multiple="multiple"
                @input="updateSelect">
            <option v-if="showPlaceholder" :value="null" :selected="value===null">
                -- Please Select --
            </option>
            <option v-for="option in options"
                    :key="option.value"
                    :value="option.value"
                    :selected="isSelected(option)">
                {{ option.label }}
            </option>
        </select>
    </div>
</template>

<script>
import {random} from "lodash";

export default {
    name: "SimpleSelect",
    props: {
        label: {
            type: String
        },
        name: {
            type: String,
        },
        options: {
            type: Array,
            default: () => []
        },
        size: {
            type: String,
            default: "col-12 col-md-4"
        },
        multiple: {
            type: Boolean,
        },
        value: {
            type: String,
            default: null
        },
        defaultValue: {
            type: String,
            default: null
        },
    },
    data() {
        return {
            id: random('10000', '99999')
        }
    },
    computed: {
        showPlaceholder() {
            return !this.defaultValue
        }
    },
    methods: {
        isSelected(option) {
            return option.value === this.value
        },
        updateSelect(e) {
            this.$emit('input', e.target.value)
        }
    }
}
</script>

<style scoped>

</style>

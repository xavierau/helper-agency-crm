<template>
    <div :class="size">
        <label :for="id">
            <input :id="id"
                   type="checkbox"
                   :name="name"
                   :checked="value"
                   :value="true"
                   @change="$emit('input', $event.target.checked)"/>
            <slot></slot>
        </label>
    </div>
</template>

<script>
import {random} from "lodash";

export default {
    name: "Checkbox",
    props: {
        click: {
            type: Function
        },
        name: {
            type: String,
        },
        size: {
            type: String,
            default: "col-6 col-md-4 col-lg-3"
        },
        value: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            id: random('10000', '99999')
        }
    }
}
</script>

<style scoped>

</style>

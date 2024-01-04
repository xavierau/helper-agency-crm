<template>
    <div class="form-group" :class="size">
        <label>Available Date</label>
        <input :name="name"
               type="date"
               class="form-control"
               :value="value | formatDatetime('YYYY-MM-DD')"
               @input="$emit('input', $event.target.value)"/>
    </div>
</template>

<script>
import {formatDatetime} from "@/filters/common";

export default {
    name: "AvailableDate",
    filters: {
        formatDatetime
    },
    props: {
        name: {
            type: String,
            default: 'date_of_release'
        },
        value: {
            type: String,
            default: null
        },
        size: {
            type: String,
            default: 'col-12 col-md-6'
        }
    }
}
</script>

<style scoped>

</style>

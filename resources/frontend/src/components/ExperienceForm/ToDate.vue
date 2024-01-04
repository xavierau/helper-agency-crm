<template>
    <div class="form-group" :class="size">
        <label>To Date</label>

        <input :name="name"
               type="date"
               class="form-control"
               autocomplete="true"
               :value="value"
               @input="$emit('input', $event.target.value)"/>
    </div>
</template>

<script>
export default {
    name: "ToDate",
    props: {
        name: {
            type: String,
            default: 'to_date'
        },
        value: {
            type: String,
            default: ''
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

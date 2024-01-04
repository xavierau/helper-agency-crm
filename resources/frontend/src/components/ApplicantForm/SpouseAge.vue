<template>
    <div class="form-group" :class="size">
        <label>Spouse age</label>
        <input :name="name"
               type="number"
               min="0"
               step="1"
               class="form-control"
               :value="value"
               @input="$emit('input', $event.target.value)"/>
    </div>
</template>

<script>
export default {
    name: "SpouseAge",
    props: {
        name: {
            type: String,
            default: 'spouse_age'
        },
        value: {
            type: String,
            default: ''
        },
        size: {
            type: String,
            default: 'col-12 col-md-3'
        }
    }
}
</script>

<style scoped>

</style>

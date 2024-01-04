<template>
    <div class="form-group" :class="size">
        <label>Description</label>
        <textarea :name="name"
               class="form-control"
               autocomplete="true"
               :value="value"
               @input="$emit('input', $event.target.value)"/>
    </div>
</template>

<script>
export default {
    name: "Description",
    props: {
        name: {
            type: String,
            default: 'age_of_elderly'
        },
        value: {
            type: String,
            default: ''
        },
        size: {
            type: String,
            default: 'col-12'
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <div class="form-group" :class="size">
        <label>Age of adults</label>
        <input :name="name"
               class="form-control"
               autocomplete="true"
               :value="value"
               @input="$emit('input', $event.target.value)"/>
    </div>
</template>

<script>
export default {
    name: "AgeOfAdults",
    props: {
        name: {
            type: String,
            default: 'age_of_sons'
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

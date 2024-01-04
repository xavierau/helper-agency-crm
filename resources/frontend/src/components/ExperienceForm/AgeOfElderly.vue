<template>
    <div class="form-group" :class="size">
        <label>Age of elderly</label>
        <input :name="name"
               class="form-control"
               autocomplete="true"
               :value="value"
               @input="$emit('input', $event.target.value)"/>
    </div>
</template>

<script>
export default {
    name: "AgeOfElderly",
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
            default: 'col-12 col-md-6'
        }
    }
}
</script>

<style scoped>

</style>

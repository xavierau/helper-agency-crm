<template>
    <div class="form-group" :class="size">
        <label>Date for birth</label>
        <input :name="name"
               type="date"
               class="form-control"
               :value="value"
               @input="$emit('input', $event.target.value)"/>
    </div>
</template>

<script>
export default {
    name: "ApplicantDateOfBirth",
    props: {
        name: {
            type: String,
            default: 'weight'
        },
        value: {
            type: String,
            default: null
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

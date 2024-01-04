<template>
    <div class="form-group" :class="size">
        <label>Father Age</label>
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
    name: "ApplicantFatherAge",
    props: {
        name: {
            type: String,
            default: 'father_age'
        },
        value: {
            type: Number,
            default: 0
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

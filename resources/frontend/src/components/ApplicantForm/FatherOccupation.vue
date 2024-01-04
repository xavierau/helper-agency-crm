<template>
    <div class="form-group" :class="size">
        <label>Father Occupation</label>
        <input :name="name"
               type="string"
               class="form-control"
               autocomplete="true"
               :value="value"
               @input="$emit('input', $event.target.value)"/>
    </div>
</template>

<script>
export default {
    name: "ApplicantFatherOccupation",
    props: {
        name: {
            type: String,
            default: 'father_occupation'
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

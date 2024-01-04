<template>
    <div class="form-group" :class="size">
        <label>Mother Occupation</label>
        <input :name="name"
               type="string"
               autocomplete="true"
               class="form-control"
               :value="value"
               @input="$emit('input', $event.target.value)"/>
    </div>
</template>

<script>
export default {
    name: "ApplicantMotherOccupation",
    props: {
        name: {
            type: String,
            default: 'mother_occupation'
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

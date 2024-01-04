<template>
    <div class="form-group" :class="size">
        <label>Graduation Year</label>
        <input :name="name"
               type="number"
               min="1900"
               step="2022"
               class="form-control"
               :value="value"
               @input="$emit('input', $event.target.value)"/>
    </div>
</template>

<script>
export default {
    name: "GraduationYear",
    props: {
        name: {
            type: String,
            default: 'graduation_year'
        },
        value: {
            type: Number,
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

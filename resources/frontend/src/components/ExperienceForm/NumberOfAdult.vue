<template>
    <div class="form-group" :class="size">
        <label>Number of adult</label>

        <input :name="name"
               type="number"
               min="0"
               class="form-control"
               autocomplete="true"
               :value="value"
               @input="$emit('input', $event.target.value)"/>
    </div>
</template>

<script>
export default {
    name: "NumberOfAdult",
    props: {
        name: {
            type: String,
            default: 'number_of_adult'
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

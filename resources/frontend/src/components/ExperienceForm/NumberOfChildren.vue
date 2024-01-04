<template>
    <div class="form-group" :class="size">
        <label>Number of children</label>

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
    name: "NumberOfChildren",
    props: {
        name: {
            type: String,
            default: 'number_of_children'
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

<template>
    <div class="form-group" :class="size">
        <label>Number of daughters</label>
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
    name: "NumberOfDaughters",
    props: {
        name: {
            type: String,
            default: 'number_of_daughters'
        },
        value: {
            type: Number,
        },
        size: {
            type: String,
            default: 'col-6 col-md-3'
        }
    }
}
</script>

<style scoped>

</style>

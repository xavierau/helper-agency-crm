<template>
    <div class="form-group" :class="size">
        <label>Number of brothers</label>
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
    name: "NumberOfBrothers",
    props: {
        name: {
            type: String,
            default: 'number_of_brothers'
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

<template>
    <div class="form-group" :class="size">
        <label>House Size</label>

        <input :name="name"
               type="string"
               class="form-control"
               min="0"
               autocomplete="true"
               :value="value"
               @input="$emit('input', $event.target.value)"/>
    </div>
</template>

<script>
export default {
    name: "HouseSize",
    props: {
        name: {
            type: String,
            default: 'house_size'
        },
        value: {
            type: Number,
            default: null
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

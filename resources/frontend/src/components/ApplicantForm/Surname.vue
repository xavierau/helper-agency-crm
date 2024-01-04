<template>
    <div class="form-group" :class="size">
        <label>Surname</label>
        <input :value="value"
               @input="$emit('input', $event.target.value)"
               :name="name"
               autocomplete="true"
               type="text"
               class="form-control"/>
    </div>
</template>

<script>
export default {
    name: "Surname",
    props: {
        name: {
            type: String,
            default: 'surname'
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

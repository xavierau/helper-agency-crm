<template>
    <div class="form-group" :class="size">
        <label>Middle Name</label>
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
    name: "MiddleName",
    props: {
        name: {
            type: String,
            default: 'middle_name'
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

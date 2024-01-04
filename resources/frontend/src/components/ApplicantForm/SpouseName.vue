<template>
    <div class="form-group" :class="size">
        <label>Spouse Name</label>
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
    name: "SpouseName",
    props: {
        name: {
            type: String,
            default: 'spouse_name'
        },
        value: {
            type: String,
            default: ''
        },
        size: {
            type: String,
            default: 'col-12 col-md-4'
        }
    }
}
</script>

<style scoped>

</style>
